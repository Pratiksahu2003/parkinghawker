<?php

namespace App\Repositories;

interface BlogRepositoryInterface
{
    /**
     * Get all blog articles.
     */
    public function all(): array;

    /**
     * Find a blog article by slug.
     */
    public function findBySlug(string $slug): ?array;

    /**
     * Find a blog article by ID.
     */
    public function findById(int $id): ?array;

    /**
     * Get related blog articles.
     */
    public function getRelated(array $article, int $limit = 3): array;

    /**
     * Search and filter blog articles.
     */
    public function search(array $filters): array;

    /**
     * Get unique categories.
     */
    public function getCategories(): array;

    /**
     * Create a new blog article.
     */
    public function create(array $data): array;

    /**
     * Update an existing blog article.
     */
    public function update(int $id, array $data): ?array;

    /**
     * Delete a blog article.
     */
    public function delete(int $id): bool;
}
