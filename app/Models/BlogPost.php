<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'author_name',
        'author_role',
        'excerpt',
        'content',
        'featured_image',
        'youtube_url',
        'tags',
        'read_time',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'views_count' => 'integer',
        ];
    }

    /**
     * Auto-generate slug and read_time when creating/updating.
     */
    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if (empty($post->read_time)) {
                $post->read_time = self::calculateReadTime($post->content);
            }
        });

        static::updating(function (BlogPost $post) {
            if ($post->isDirty('content')) {
                $post->read_time = self::calculateReadTime($post->content);
            }
        });
    }

    /**
     * Calculate read time from content word count.
     */
    public static function calculateReadTime(?string $content): string
    {
        if (!$content) {
            return '1 min read';
        }
        $wordCount = str_word_count(strip_tags($content));
        $minutes = max(1, (int) ceil($wordCount / 200));
        return $minutes . ' min read';
    }

    /**
     * Convert YouTube watch URL to embed URL.
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (!$this->youtube_url) {
            return null;
        }

        $url = $this->youtube_url;

        // Handle youtu.be short URLs
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Handle youtube.com/watch?v= URLs
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Already an embed URL
        if (str_contains($url, '/embed/')) {
            return $url;
        }

        return null;
    }

    // ── Scopes ──────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where(function ($q) {
                         $q->whereNull('published_at')
                           ->orWhere('published_at', '<=', now());
                     });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // ── Relationships ───────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Increment the view counter.
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
