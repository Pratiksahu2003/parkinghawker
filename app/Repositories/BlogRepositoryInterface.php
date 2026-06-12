<?php

namespace App\Repositories;

interface BlogRepositoryInterface
{
    /**
     * Get all blog articles.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find a blog article by slug.
     *
     * @param string $slug
     * @return array|null
     */
    public function findBySlug(string $slug): ?array;

    /**
     * Get related blog articles.
     *
     * @param array $article
     * @param int $limit
     * @return array
     */
    public function getRelated(array $article, int $limit = 3): array;

    /**
     * Search and filter blog articles.
     *
     * @param array $filters
     * @return array
     */
    public function search(array $filters): array;

    /**
     * Get unique categories.
     *
     * @return array
     */
    public function getCategories(): array;
}
