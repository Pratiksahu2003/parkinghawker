<?php

namespace App\Services;

use App\Repositories\BlogRepositoryInterface;

class BlogService
{
    protected BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getAllArticles(): array
    {
        return $this->blogRepository->all();
    }

    public function getArticleBySlug(string $slug): ?array
    {
        return $this->blogRepository->findBySlug($slug);
    }

    public function getRelatedArticles(array $article, int $limit = 3): array
    {
        return $this->blogRepository->getRelated($article, $limit);
    }

    public function searchArticles(array $filters): array
    {
        return $this->blogRepository->search($filters);
    }

    public function getCategories(): array
    {
        return $this->blogRepository->getCategories();
    }
}
