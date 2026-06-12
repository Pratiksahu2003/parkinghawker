<?php

namespace App\Repositories;

class InMemoryParkingRepository implements ParkingRepositoryInterface
{
    protected array $parkingSpots = [];

    public function __construct()
    {
        $this->parkingSpots = [
            1 => [
                'id' => 1,
                'name' => 'Silicon Valley Premium Garage',
                'slug' => 'silicon-valley-premium-garage',
                'city' => 'San Francisco',
                'area' => 'SOMA / Tech District',
                'address' => '455 Mission St, San Francisco, CA 94105',
                'price_per_hour' => 12.00,
                'price_per_day' => 75.00,
                'rating' => 4.9,
                'reviews_count' => 184,
                'image' => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
                'latitude' => 37.7897,
                'longitude' => -122.4014,
                'total_spots' => 350,
                'available_spots' => 142,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'covered', // covered, open, rooftop, underground
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'A premier, ultra-modern underground parking facility located in the heart of San Francisco\'s tech district. Features state-of-the-art license plate recognition, 24/7 manned security, clean EV superchargers, and premium detailing services.',
                'reviews' => [
                    ['user' => 'Sarah K.', 'rating' => 5, 'date' => '2026-06-01', 'comment' => 'Cleanest garage I have ever seen. Extremely quick valet and convenient EV charging!'],
                    ['user' => 'Michael T.', 'rating' => 5, 'date' => '2026-05-24', 'comment' => 'Safe, secure, and the smooth booking on this platform made checking in a breeze.'],
                    ['user' => 'Elena R.', 'rating' => 4.5, 'date' => '2026-05-18', 'comment' => 'Slightly premium pricing, but absolutely worth the peace of mind. Highly recommended.'],
                ],
                'rules' => [
                    'No tailgating upon entry or exit.',
                    'Keep parking voucher or digital pass ready.',
                    'EV spots are strictly for charging vehicles.',
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Broadway Express Garage',
                'slug' => 'broadway-express-garage',
                'city' => 'New York',
                'area' => 'Times Square / Theatre District',
                'address' => '220 W 42nd St, New York, NY 10036',
                'price_per_hour' => 18.00,
                'price_per_day' => 110.00,
                'rating' => 4.7,
                'reviews_count' => 295,
                'image' => 'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=800',
                'latitude' => 40.7563,
                'longitude' => -73.9870,
                'total_spots' => 500,
                'available_spots' => 84,
                'vehicle_types' => ['car', 'suv', 'motorcycle'],
                'parking_type' => 'underground',
                'amenities' => [
                    'ev_charging' => false,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => false,
                    'wheelchair' => true,
                    'tailored_help' => false,
                ],
                'description' => 'Perfectly situated underground garage beneath the Broadway neon lights. Features lightning-fast automated parking ramps, VIP valet service, and comprehensive round-the-clock surveillance.',
                'reviews' => [
                    ['user' => 'John D.', 'rating' => 5, 'date' => '2026-06-10', 'comment' => 'Location is unmatched. Right in Times Square and the valet service was stellar.'],
                    ['user' => 'Jessica L.', 'rating' => 4, 'date' => '2026-06-05', 'comment' => 'Tight spaces but typical for NYC. Staff were super helpful and professional.'],
                ],
                'rules' => [
                    'Speed limit strictly 5mph.',
                    'Lock your vehicle and do not leave valuables visible.',
                    'Valet keys must be handed directly to uniformed personnel.'
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Neon Heights Smart Valet',
                'slug' => 'neon-heights-smart-valet',
                'city' => 'Los Angeles',
                'area' => 'West Hollywood',
                'address' => '8430 Sunset Blvd, West Hollywood, CA 90069',
                'price_per_hour' => 15.00,
                'price_per_day' => 90.00,
                'rating' => 4.8,
                'reviews_count' => 112,
                'image' => 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&q=80&w=800',
                'latitude' => 34.0980,
                'longitude' => -118.3734,
                'total_spots' => 200,
                'available_spots' => 18,
                'vehicle_types' => ['car', 'suv', 'ev'],
                'parking_type' => 'rooftop',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => false,
                    'tailored_help' => true,
                ],
                'description' => 'A stylish rooftop valet lot offering panoramic views of Sunset Boulevard. Includes VIP luxury car wash, dynamic LED space indicators, and level-3 EV rapid chargers.',
                'reviews' => [
                    ['user' => 'Chris P.', 'rating' => 5, 'date' => '2026-06-08', 'comment' => 'Unbelievable valet service. They even cleaned my windshield. Very premium experience.'],
                    ['user' => 'Amanda S.', 'rating' => 4, 'date' => '2026-05-30', 'comment' => 'Amazing views and very secure. Just book in advance since slots fill up extremely fast!'],
                ],
                'rules' => [
                    'Reservations strictly verified at the gate.',
                    'Oversized vehicles may be subject to additional fees.',
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Cloud Nine Smart Deck',
                'slug' => 'cloud-nine-smart-deck',
                'city' => 'Chicago',
                'area' => 'The Loop',
                'address' => '111 S Wacker Dr, Chicago, IL 60606',
                'price_per_hour' => 10.00,
                'price_per_day' => 60.00,
                'rating' => 4.6,
                'reviews_count' => 156,
                'image' => 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800',
                'latitude' => 41.8799,
                'longitude' => -87.6366,
                'total_spots' => 400,
                'available_spots' => 210,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'open',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => false,
                    'security_cctv' => true,
                    'wash' => false,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'An ultra-modern multi-level parking deck featuring automated license plate scanner entry, real-time parking spot indicators, dynamic green pricing models, and fast EV chargers.',
                'reviews' => [
                    ['user' => 'David W.', 'rating' => 4, 'date' => '2026-06-11', 'comment' => 'Easy entry, simple process, clean stalls.'],
                    ['user' => 'Sophia M.', 'rating' => 5, 'date' => '2026-06-03', 'comment' => 'Cheap pricing for Chicago Loop and very simple self-parking. I always use this deck.'],
                ],
                'rules' => [
                    'Observe one-way directional indicators.',
                    'Keep to designated lane markings.',
                ]
            ],
            5 => [
                'id' => 5,
                'name' => 'Marina Bay Premium Garage',
                'slug' => 'marina-bay-premium-garage',
                'city' => 'San Francisco',
                'area' => 'Marina District',
                'address' => '2350 Marina Blvd, San Francisco, CA 94123',
                'price_per_hour' => 14.00,
                'price_per_day' => 85.00,
                'rating' => 4.9,
                'reviews_count' => 98,
                'image' => 'https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&q=80&w=800',
                'latitude' => 37.8049,
                'longitude' => -122.4419,
                'total_spots' => 150,
                'available_spots' => 65,
                'vehicle_types' => ['car', 'suv', 'ev'],
                'parking_type' => 'covered',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'Exquisite waterfront parking garage serving San Francisco\'s Marina district. Provides high-security access controls, dedicated EV parking with automated charging notification, and car care services.',
                'reviews' => [
                    ['user' => 'Arthur B.', 'rating' => 5, 'date' => '2026-06-07', 'comment' => 'Stunning garage right by the water. Exceptional attention to detail by the security staff.'],
                ],
                'rules' => [
                    'Valet operations close at 11:30 PM.',
                    'Vehicles remaining overnight must be registered.'
                ]
            ],
            6 => [
                'id' => 6,
                'name' => 'Gotham Plaza Underground',
                'slug' => 'gotham-plaza-underground',
                'city' => 'New York',
                'area' => 'Brooklyn / DUMBO',
                'address' => '55 Water St, Brooklyn, NY 11201',
                'price_per_hour' => 11.00,
                'price_per_day' => 70.00,
                'rating' => 4.5,
                'reviews_count' => 142,
                'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=800',
                'latitude' => 40.7032,
                'longitude' => -73.9904,
                'total_spots' => 300,
                'available_spots' => 125,
                'vehicle_types' => ['car', 'suv', 'motorcycle'],
                'parking_type' => 'underground',
                'amenities' => [
                    'ev_charging' => false,
                    'valet' => false,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => true,
                    'tailored_help' => false,
                ],
                'description' => 'Located in the historic DUMBO neighborhood, Gotham Plaza Underground is a clean, spacious facility offering seamless keyless entry, license plate scanning, and competitive daily rates.',
                'reviews' => [
                    ['user' => 'Kate H.', 'rating' => 4.5, 'date' => '2026-06-02', 'comment' => 'Spacious spots which is rare in Brooklyn! High quality cameras everywhere, felt very safe.'],
                ],
                'rules' => [
                    'License plates must be clean and visible for automatic entry.',
                    'No long-term storage of materials inside cars.'
                ]
            ]
        ];
    }

    public function all(): array
    {
        return $this->parkingSpots;
    }

    public function find($id): ?array
    {
        return $this->parkingSpots[$id] ?? null;
    }

    public function search(array $filters): array
    {
        $results = $this->parkingSpots;

        // Filter by City
        if (!empty($filters['city'])) {
            $cityQuery = strtolower($filters['city']);
            $results = array_filter($results, function ($spot) use ($cityQuery) {
                return str_contains(strtolower($spot['city']), $cityQuery) || str_contains(strtolower($spot['area']), $cityQuery);
            });
        }

        // Filter by Parking Type
        if (!empty($filters['parking_type']) && $filters['parking_type'] !== 'all') {
            $type = $filters['parking_type'];
            $results = array_filter($results, function ($spot) use ($type) {
                return $spot['parking_type'] === $type;
            });
        }

        // Filter by Vehicle Type
        if (!empty($filters['vehicle_type']) && $filters['vehicle_type'] !== 'all') {
            $vehicle = $filters['vehicle_type'];
            $results = array_filter($results, function ($spot) use ($vehicle) {
                return in_array($vehicle, $spot['vehicle_types']);
            });
        }

        // Filter by EV Charging
        if (!empty($filters['ev_charging']) && $filters['ev_charging'] === 'yes') {
            $results = array_filter($results, function ($spot) {
                return $spot['amenities']['ev_charging'] ?? false;
            });
        }

        // Filter by Valet
        if (!empty($filters['valet']) && $filters['valet'] === 'yes') {
            $results = array_filter($results, function ($spot) {
                return $spot['amenities']['valet'] ?? false;
            });
        }

        // Filter by Security
        if (!empty($filters['security']) && $filters['security'] === 'yes') {
            $results = array_filter($results, function ($spot) {
                return $spot['amenities']['security_cctv'] ?? false;
            });
        }

        // Sort Results
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_low':
                    uasort($results, function ($a, $b) {
                        return $a['price_per_hour'] <=> $b['price_per_hour'];
                    });
                    break;
                case 'price_high':
                    uasort($results, function ($a, $b) {
                        return $b['price_per_hour'] <=> $a['price_per_hour'];
                    });
                    break;
                case 'rating':
                    uasort($results, function ($a, $b) {
                        return $b['rating'] <=> $a['rating'];
                    });
                    break;
                case 'spots':
                    uasort($results, function ($a, $b) {
                        return $b['available_spots'] <=> $a['available_spots'];
                    });
                    break;
            }
        }

        return array_values($results);
    }

    public function getUniqueLocations(): array
    {
        $locations = [];
        foreach ($this->parkingSpots as $spot) {
            $locations[] = $spot['city'] . ', ' . $spot['area'];
        }
        return array_unique($locations);
    }
}
