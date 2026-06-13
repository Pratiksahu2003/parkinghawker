<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['query', 'category']);
        $articles = $this->blogService->searchArticles($filters);
        $categories = \Illuminate\Support\Facades\Cache::remember('blog_categories_array', 3600, function () {
            return \App\Models\BlogCategory::active()->ordered()->get()->toArray();
        });

        return view('blog.index', compact('articles', 'categories', 'filters'));
    }

    public function category($categorySlug)
    {
        $category = \Illuminate\Support\Facades\Cache::remember("blog_category_slug_{$categorySlug}", 3600, function () use ($categorySlug) {
            $cat = \App\Models\BlogCategory::active()->where('slug', $categorySlug)->first();
            return $cat ? $cat->toArray() : null;
        });
        
        if (!$category) {
            abort(404, 'Category not found');
        }

        $filters = ['category' => $category['name']];
        $articles = $this->blogService->searchArticles($filters);
        $categories = \Illuminate\Support\Facades\Cache::remember('blog_categories_array', 3600, function () {
            return \App\Models\BlogCategory::active()->ordered()->get()->toArray();
        });
        $activeCategory = $category['name'];

        return view('blog.index', compact('articles', 'categories', 'filters', 'activeCategory'));
    }

    public function show($slug)
    {
        $article = $this->blogService->getArticleBySlug($slug);
        if (!$article) {
            abort(404, 'Article not found');
        }

        $related = $this->blogService->getRelatedArticles($article);

        return view('blog.show', compact('article', 'related'));
    }
}
