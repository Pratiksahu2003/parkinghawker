<?php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Cache;

class EloquentBlogRepository implements BlogRepositoryInterface
{
    public function all(): array
    {
        return Cache::remember('blog_posts_all', 3600, function () {
            return BlogPost::with('category')
                ->published()
                ->orderByDesc('published_at')
                ->get()
                ->map(fn ($post) => $this->formatPost($post))
                ->toArray();
        });
    }

    public function findBySlug(string $slug): ?array
    {
        $post = Cache::remember("blog_post_slug_{$slug}", 3600, function () use ($slug) {
            $p = BlogPost::with('category')->where('slug', $slug)->first();
            return $p ? $this->formatPost($p) : null;
        });

        if ($post) {
            BlogPost::where('id', $post['id'])->increment('views_count');
            $post['views_count']++;
        }

        return $post;
    }

    public function findById(int $id): ?array
    {
        return Cache::remember("blog_post_id_{$id}", 3600, function () use ($id) {
            $post = BlogPost::with('category')->find($id);
            return $post ? $this->formatPost($post) : null;
        });
    }

    public function getRelated(array $article, int $limit = 3): array
    {
        $cacheKey = "blog_related_" . md5($article['slug'] . '_' . $limit);
        return Cache::remember($cacheKey, 3600, function () use ($article, $limit) {
            return BlogPost::with('category')
                ->published()
                ->where('slug', '!=', $article['slug'])
                ->where('category_id', function ($q) use ($article) {
                    $q->select('id')
                      ->from('blog_categories')
                      ->where('name', $article['category'])
                      ->limit(1);
                })
                ->orderByDesc('published_at')
                ->limit($limit)
                ->get()
                ->map(fn ($post) => $this->formatPost($post))
                ->toArray();
        });
    }

    public function search(array $filters): array
    {
        $cacheKey = "blog_search_" . md5(serialize($filters));
        return Cache::remember($cacheKey, 300, function () use ($filters) {
            $query = BlogPost::with('category')->published();

            if (!empty($filters['query'])) {
                $search = $filters['query'];
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ilike', "%{$search}%")
                      ->orWhere('excerpt', 'ilike', "%{$search}%")
                      ->orWhereHas('category', function ($cq) use ($search) {
                          $cq->where('name', 'ilike', "%{$search}%");
                      });
                });
            }

            if (!empty($filters['category']) && $filters['category'] !== 'all') {
                $query->whereHas('category', function ($q) use ($filters) {
                    $q->where('name', $filters['category']);
                });
            }

            return $query->orderByDesc('published_at')
                ->get()
                ->map(fn ($post) => $this->formatPost($post))
                ->toArray();
        });
    }

    public function getCategories(): array
    {
        return Cache::remember('blog_categories', 3600, function () {
            return BlogCategory::active()
                ->ordered()
                ->pluck('name')
                ->toArray();
        });
    }

    public function create(array $data): array
    {
        $post = BlogPost::create($data);
        $post->load('category');
        $this->clearCache();
        return $this->formatPost($post);
    }

    public function update(int $id, array $data): ?array
    {
        $post = BlogPost::find($id);
        if (!$post) {
            return null;
        }
        $post->update($data);
        $post->load('category');
        $this->clearCache();
        return $this->formatPost($post);
    }

    public function delete(int $id): bool
    {
        $post = BlogPost::find($id);
        if (!$post) {
            return false;
        }
        $deleted = $post->delete();
        if ($deleted) {
            $this->clearCache();
        }
        return $deleted;
    }

    protected function clearCache(): void
    {
        Cache::flush();
    }

    /**
     * Format a BlogPost model into the array structure expected by views.
     */
    protected function formatPost(BlogPost $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'category' => $post->category?->name ?? 'Uncategorized',
            'category_id' => $post->category_id,
            'category_color' => $post->category?->color ?? '#06b6d4',
            'author' => $post->author_name,
            'author_role' => $post->author_role,
            'date' => $post->published_at?->format('Y-m-d') ?? $post->created_at->format('Y-m-d'),
            'read_time' => $post->read_time ?? '1 min read',
            'image' => $post->featured_image,
            'youtube_url' => $post->youtube_url,
            'youtube_embed_url' => $post->youtube_embed_url,
            'summary' => $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 160),
            'tags' => $post->tags ?? [],
            'content' => $post->content,
            'status' => $post->status,
            'is_featured' => $post->is_featured,
            'published_at' => $post->published_at?->toIso8601String(),
            'views_count' => $post->views_count,
            'meta_title' => $post->meta_title,
            'meta_description' => $post->meta_description,
        ];
    }
}
