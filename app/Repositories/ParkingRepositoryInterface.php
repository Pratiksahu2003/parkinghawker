<?php

namespace App\Repositories;

interface ParkingRepositoryInterface
{
    /**
     * Get all parking locations.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find a parking location by ID.
     *
     * @param string|int $id
     * @return array|null
     */
    public function find($id): ?array;

    /**
     * Search and filter parking locations.
     *
     * @param array $filters
     * @return array
     */
    public function search(array $filters): array;

    /**
     * Get unique locations (cities/areas) for search suggestions.
     *
     * @return array
     */
    public function getUniqueLocations(): array;
}
