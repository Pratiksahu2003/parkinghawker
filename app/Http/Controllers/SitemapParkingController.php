<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapParkingController extends Controller
{
    /**
     * Handle /parking-in/{code}/{city}/{slug}.html
     * These are the individual parking spot pages listed in sitemap-parkings.xml.
     * The URL encodes the parking code (e.g. DEL0171), city (e.g. New-Delhi),
     * and a human-readable slug for the spot name.
     */
    public function show(string $code, string $city, string $slug)
    {
        // Derive a human-readable name from the slug (remove trailing .html if any)
        $slug = preg_replace('/\.html$/', '', $slug);
        $spotName = ucwords(str_replace(['-', '_'], ' ', $slug));
        // Remove trailing word "parking" duplicate if present at end for cleaner title
        $spotName = preg_replace('/\s+parking\s*$/i', '', $spotName);

        // City display name: replace hyphens with spaces
        $cityName = str_replace('-', ' ', $city);

        // Build parking data from the URL parameters (no database needed — static SEO page)
        $spot = [
            'code'      => strtoupper($code),
            'city'      => $cityName,
            'slug'      => $slug,
            'name'      => $spotName . ' Parking',
            'address'   => $spotName . ', ' . $cityName . ', India',
            'image'     => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
        ];

        // Suggest nearby spots (all parking-in links in the same city for SEO interlink)
        $suggestedCities = $this->getSuggestedCities();

        return view('sitemap.parking-in-show', compact('spot', 'suggestedCities'));
    }

    /**
     * A small static list of city-level pages to suggest in the "Explore More" section.
     */
    protected function getSuggestedCities(): array
    {
        return [
            ['name' => 'New Delhi',  'slug' => 'New-Delhi',   'count' => 350],
            ['name' => 'Nagpur',     'slug' => 'Nagpur',      'count' => 120],
            ['name' => 'Mumbai',     'slug' => 'Mumbai',      'count' => 200],
            ['name' => 'Bengaluru',  'slug' => 'Bengaluru',   'count' => 180],
            ['name' => 'Hyderabad',  'slug' => 'Hyderabad',   'count' => 90],
            ['name' => 'Pune',       'slug' => 'Pune',        'count' => 75],
        ];
    }
}
