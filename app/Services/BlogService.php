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

    public function getArticleById(int $id): ?array
    {
        return $this->blogRepository->findById($id);
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

    public function createArticle(array $data): array
    {
        return $this->blogRepository->create($data);
    }

    public function updateArticle(int $id, array $data): ?array
    {
        return $this->blogRepository->update($id, $data);
    }

    public function deleteArticle(int $id): bool
    {
        return $this->blogRepository->delete($id);
    }
}
