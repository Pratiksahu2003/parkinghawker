<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with('category');

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', "%{$search}%")
                  ->orWhere('excerpt', 'ilike', "%{$search}%");
            });
        }

        $posts = $query->orderByDesc('created_at')->paginate(15);
        $categories = BlogCategory::ordered()->get();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        // Process tags from comma-separated string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug
        $baseSlug = $validated['slug'];
        $counter = 1;
        while (BlogPost::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug . '-' . $counter++;
        }

        // Auto-set published_at if publishing without a date
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        // Process tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['is_featured'] = $request->has('is_featured');

        // Update slug if title changed
        if ($post->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        // Auto-set published_at if publishing without a date
        if ($validated['status'] === 'published' && empty($validated['published_at']) && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(int $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
