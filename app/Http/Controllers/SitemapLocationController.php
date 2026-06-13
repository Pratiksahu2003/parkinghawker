<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapLocationController extends Controller
{
    /**
     * Handle /parking-near-me/{location-slug}.html
     * These are the location-level pages listed in sitemap-locations.xml.
     * The slug encodes a full address / area name.
     */
    public function show(string $locationSlug)
    {
        // Strip trailing .html if captured in slug
        $locationSlug = preg_replace('/\.html$/', '', $locationSlug);

        // Parse a human-readable location name from the slug
        $locationName = $this->formatLocationName($locationSlug);

        // Detect city from slug (best-effort: last city-like token before -india)
        $city = $this->detectCity($locationSlug);

        // Static parking spot cards for this location (for SEO content + CTA)
        $nearbySpots = $this->getNearbySpots($city);

        $location = [
            'slug'  => $locationSlug,
            'name'  => $locationName,
            'city'  => $city,
            'image' => 'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=1200',
        ];

        return view('sitemap.parking-near-me-show', compact('location', 'nearbySpots'));
    }

    /**
     * Convert a URL slug like "aali-village-ali-new-delhi-delhi-india"
     * into a readable name like "Aali Village Ali, New Delhi, Delhi, India"
     */
    protected function formatLocationName(string $slug): string
    {
        // Replace hyphens with spaces and title-case each word
        $words = array_map('ucfirst', explode('-', $slug));
        $name = implode(' ', $words);
        // Clean up common number-only artifacts from address slugs
        return $name;
    }

    /**
     * Best-effort city detection from slug.
     * We scan known cities in the slug tokens.
     */
    protected function detectCity(string $slug): string
    {
        $knownCities = [
            'new-delhi'    => 'New Delhi',
            'delhi'        => 'Delhi',
            'nagpur'       => 'Nagpur',
            'mumbai'       => 'Mumbai',
            'bengaluru'    => 'Bengaluru',
            'bangalore'    => 'Bengaluru',
            'hyderabad'    => 'Hyderabad',
            'pune'         => 'Pune',
            'kolkata'      => 'Kolkata',
            'chennai'      => 'Chennai',
            'gurugram'     => 'Gurugram',
            'gurgaon'      => 'Gurugram',
            'noida'        => 'Noida',
            'faridabad'    => 'Faridabad',
            'ghaziabad'    => 'Ghaziabad',
            'chandigarh'   => 'Chandigarh',
            'jaipur'       => 'Jaipur',
            'lucknow'      => 'Lucknow',
            'ahmedabad'    => 'Ahmedabad',
            'surat'        => 'Surat',
            'indore'       => 'Indore',
            'bhopal'       => 'Bhopal',
            'patna'        => 'Patna',
            'ranchi'       => 'Ranchi',
            'coimbatore'   => 'Coimbatore',
            'kochi'        => 'Kochi',
            'visakhapatnam'=> 'Visakhapatnam',
        ];

        // Check new-delhi first (two-word city)
        if (str_contains($slug, 'new-delhi')) {
            return 'New Delhi';
        }

        foreach ($knownCities as $key => $cityName) {
            if (str_contains($slug, $key)) {
                return $cityName;
            }
        }

        return 'India';
    }

    /**
     * Return a set of nearby parking spots for display on the location page.
     */
    protected function getNearbySpots(string $city): array
    {
        $allSpots = [
            ['name' => 'Central Parking Hub',       'area' => 'City Centre',        'price' => 30, 'rating' => 4.8, 'spots' => 120],
            ['name' => 'Metro Station Parking',      'area' => 'Metro Gate',         'price' => 20, 'rating' => 4.6, 'spots' => 80],
            ['name' => 'Mall Parking Complex',       'area' => 'Shopping District',  'price' => 40, 'rating' => 4.7, 'spots' => 200],
            ['name' => 'Hospital Parking Zone',      'area' => 'Medical District',   'price' => 25, 'rating' => 4.5, 'spots' => 60],
            ['name' => 'Market Area Parking',        'area' => 'Commercial Zone',    'price' => 15, 'rating' => 4.4, 'spots' => 45],
            ['name' => 'IT Park Parking',            'area' => 'Tech Corridor',      'price' => 50, 'rating' => 4.9, 'spots' => 300],
        ];

        return array_map(function ($spot) use ($city) {
            $spot['city'] = $city;
            $spot['image'] = 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=600';
            return $spot;
        }, array_slice($allSpots, 0, 4));
    }
}
