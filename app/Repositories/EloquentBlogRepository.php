<?php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Models\BlogCategory;

class EloquentBlogRepository implements BlogRepositoryInterface
{
    public function all(): array
    {
        return BlogPost::with('category')
            ->published()
            ->orderByDesc('published_at')
            ->get()
            ->map(fn ($post) => $this->formatPost($post))
            ->toArray();
    }

    public function findBySlug(string $slug): ?array
    {
        $post = BlogPost::with('category')->where('slug', $slug)->first();
        if ($post) {
            $post->incrementViews();
            return $this->formatPost($post);
        }
        return null;
    }

    public function findById(int $id): ?array
    {
        $post = BlogPost::with('category')->find($id);
        return $post ? $this->formatPost($post) : null;
    }

    public function getRelated(array $article, int $limit = 3): array
    {
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
    }

    public function search(array $filters): array
    {
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
    }

    public function getCategories(): array
    {
        return BlogCategory::active()
            ->ordered()
            ->pluck('name')
            ->toArray();
    }

    public function create(array $data): array
    {
        $post = BlogPost::create($data);
        $post->load('category');
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
        return $this->formatPost($post);
    }

    public function delete(int $id): bool
    {
        $post = BlogPost::find($id);
        if (!$post) {
            return false;
        }
        return $post->delete();
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
