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
        $categories = $this->blogService->getCategories();

        return view('blog.index', compact('articles', 'categories', 'filters'));
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
