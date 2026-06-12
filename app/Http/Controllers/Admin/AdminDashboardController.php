<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => BlogPost::count(),
            'published' => BlogPost::where('status', 'published')->count(),
            'drafts' => BlogPost::where('status', 'draft')->count(),
            'archived' => BlogPost::where('status', 'archived')->count(),
            'total_views' => BlogPost::sum('views_count'),
            'total_categories' => BlogCategory::count(),
            'featured' => BlogPost::where('is_featured', true)->count(),
        ];

        $recentPosts = BlogPost::with('category')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $topPosts = BlogPost::with('category')
            ->orderByDesc('views_count')
            ->limit(5)
            ->get();

        $categories = BlogCategory::withCount('posts')
            ->ordered()
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'topPosts', 'categories'));
    }
}
