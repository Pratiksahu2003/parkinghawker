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
                'address' => '455 Mission St, San Francisco, CA 94105, USA',
                'price_per_hour' => 12.00,
                'price_per_day' => 75.00,
                'currency_symbol' => '$',
                'currency_code' => 'USD',
                'ev_fee' => 15.00,
                'wash_fee' => 30.00,
                'rating' => 4.9,
                'reviews_count' => 184,
                'image' => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
                'latitude' => 37.7897,
                'longitude' => -122.4014,
                'total_spots' => 350,
                'available_spots' => 142,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'covered',
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
                'address' => '220 W 42nd St, New York, NY 10036, USA',
                'price_per_hour' => 18.00,
                'price_per_day' => 110.00,
                'currency_symbol' => '$',
                'currency_code' => 'USD',
                'ev_fee' => 20.00,
                'wash_fee' => 40.00,
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
                ],
                'rules' => [
                    'Speed limit strictly 5mph.',
                    'Lock your vehicle and do not leave valuables visible.',
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Westminster Royal Deck',
                'slug' => 'westminster-royal-deck',
                'city' => 'London',
                'area' => 'Westminster / Victoria',
                'address' => '21 Great Smith St, Westminster, London SW1P 3DJ, UK',
                'price_per_hour' => 9.50,
                'price_per_day' => 60.00,
                'currency_symbol' => '£',
                'currency_code' => 'GBP',
                'ev_fee' => 12.00,
                'wash_fee' => 25.00,
                'rating' => 4.9,
                'reviews_count' => 176,
                'image' => 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&q=80&w=800',
                'latitude' => 51.4988,
                'longitude' => -0.1299,
                'total_spots' => 250,
                'available_spots' => 92,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'covered',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'Sophisticated parking deck serving central London and Westminster. Equipped with modern license scanners, fast electric vehicle bays, and direct access to Westminster Abbey attractions.',
                'reviews' => [
                    ['user' => 'William H.', 'rating' => 5, 'date' => '2026-06-02', 'comment' => 'Superb automated check-in, very secure and clean. Perfectly positioned for meetings.'],
                ],
                'rules' => [
                    'Check-in via license plate or QR code scan.',
                    'Congestion charge zone guidelines apply nearby.',
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Shibuya Auto-Vault Lift',
                'slug' => 'shibuya-auto-vault-lift',
                'city' => 'Tokyo',
                'area' => 'Shibuya Crossing',
                'address' => '2-2-1 Dogenzaka, Shibuya City, Tokyo 150-0043, Japan',
                'price_per_hour' => 850.00,
                'price_per_day' => 5500.00,
                'currency_symbol' => '¥',
                'currency_code' => 'JPY',
                'ev_fee' => 1500.00,
                'wash_fee' => 3000.00,
                'rating' => 4.9,
                'reviews_count' => 312,
                'image' => 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800',
                'latitude' => 35.6595,
                'longitude' => 139.7005,
                'total_spots' => 180,
                'available_spots' => 45,
                'vehicle_types' => ['car', 'ev'],
                'parking_type' => 'underground',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => false,
                    'security_cctv' => true,
                    'wash' => false,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'A state-of-the-art robotic lift system that parks your car automatically in our underground vertical vault. Supports standard EVs and features high-efficiency Japanese security controls.',
                'reviews' => [
                    ['user' => 'Kenji S.', 'rating' => 5, 'date' => '2026-06-07', 'comment' => 'Watching the robotic elevator handle the car is like science fiction. Fast and completely secure.'],
                ],
                'rules' => [
                    'Fold side mirrors before entering the auto-elevator.',
                    'Ensure all passengers exit the vehicle prior to lift activation.',
                ]
            ],
            5 => [
                'id' => 5,
                'name' => 'Sydney Harbour Bridge Deck',
                'slug' => 'sydney-harbour-bridge-deck',
                'city' => 'Sydney',
                'area' => 'The Rocks',
                'address' => '111 Cumberland St, The Rocks, NSW 2000, Australia',
                'price_per_hour' => 11.50,
                'price_per_day' => 70.00,
                'currency_symbol' => 'A$',
                'currency_code' => 'AUD',
                'ev_fee' => 18.00,
                'wash_fee' => 35.00,
                'rating' => 4.8,
                'reviews_count' => 140,
                'image' => 'https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&q=80&w=800',
                'latitude' => -33.8587,
                'longitude' => 151.2058,
                'total_spots' => 300,
                'available_spots' => 112,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'rooftop',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => true,
                    'tailored_help' => false,
                ],
                'description' => 'Panoramic rooftop garage offering stunning views of the Harbour Bridge and Opera House. Features premium self-parking, high-speed charging poles, and VIP detailing services.',
                'reviews' => [
                    ['user' => 'Oliver G.', 'rating' => 5, 'date' => '2026-06-09', 'comment' => 'Unbelievable view for a parking lot! Automated gates worked flawlessly.'],
                ],
                'rules' => [
                    'Observe rooftop speed limits and wind advisories.',
                    'Display valid reservation pass at dashboard.',
                ]
            ],
            6 => [
                'id' => 6,
                'name' => 'Eiffel Tower Smart Valet',
                'slug' => 'eiffel-tower-smart-valet',
                'city' => 'Paris',
                'area' => 'Champ de Mars',
                'address' => '2 Avenue de la Bourdonnais, 75007 Paris, France',
                'price_per_hour' => 8.00,
                'price_per_day' => 50.00,
                'currency_symbol' => '€',
                'currency_code' => 'EUR',
                'ev_fee' => 10.00,
                'wash_fee' => 25.00,
                'rating' => 4.7,
                'reviews_count' => 220,
                'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=800',
                'latitude' => 48.8584,
                'longitude' => 2.2945,
                'total_spots' => 400,
                'available_spots' => 160,
                'vehicle_types' => ['car', 'ev', 'motorcycle'],
                'parking_type' => 'underground',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => true,
                    'security_cctv' => true,
                    'wash' => true,
                    'wheelchair' => false,
                    'tailored_help' => true,
                ],
                'description' => 'Premium underground parking just steps from the Eiffel Tower. Features dynamic LED space indicators, multilingual 24/7 security attendants, and premium hand-wash detailing.',
                'reviews' => [
                    ['user' => 'Marc L.', 'rating' => 5, 'date' => '2026-06-04', 'comment' => 'Safe, clean, and right next to the Eiffel Tower. Booking online saved me so much hassle.'],
                ],
                'rules' => [
                    'LPG (Liquid Petroleum Gas) vehicles are strictly prohibited.',
                    'Maximum height limit is 1.90m.',
                ]
            ],
            7 => [
                'id' => 7,
                'name' => 'Berlin Mitte Smart Deck',
                'slug' => 'berlin-mitte-smart-deck',
                'city' => 'Berlin',
                'area' => 'Mitte / Alexanderplatz',
                'address' => 'Alexanderstraße 3, 10178 Berlin, Germany',
                'price_per_hour' => 6.50,
                'price_per_day' => 40.00,
                'currency_symbol' => '€',
                'currency_code' => 'EUR',
                'ev_fee' => 10.00,
                'wash_fee' => 20.00,
                'rating' => 4.6,
                'reviews_count' => 118,
                'image' => 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800',
                'latitude' => 52.5219,
                'longitude' => 13.4132,
                'total_spots' => 350,
                'available_spots' => 210,
                'vehicle_types' => ['car', 'suv', 'ev', 'motorcycle'],
                'parking_type' => 'covered',
                'amenities' => [
                    'ev_charging' => true,
                    'valet' => false,
                    'security_cctv' => true,
                    'wash' => false,
                    'wheelchair' => true,
                    'tailored_help' => true,
                ],
                'description' => 'Modern parking garage in Berlin Mitte. Features automated parking spot guidance, ticketless scan-in, high-speed charging poles, and carbon-neutral green electricity supply.',
                'reviews' => [
                    ['user' => 'Lukas K.', 'rating' => 5, 'date' => '2026-06-03', 'comment' => 'Super fast, easy transaction, and clean facilities. Right in Mitte.'],
                ],
                'rules' => [
                    'Observe green vehicle parking regulations.',
                    'Maximum speed limit 10 km/h.',
                ]
            ],
            8 => [
                'id' => 8,
                'name' => 'Marina Bay Sands Sky-Deck',
                'slug' => 'marina-bay-sands-sky-deck',
                'city' => 'Singapore',
                'area' => 'Marina Bay',
                'address' => '10 Bayfront Ave, Singapore 018956',
                'price_per_hour' => 9.00,
                'price_per_day' => 60.00,
                'currency_symbol' => 'S$',
                'currency_code' => 'SGD',
                'ev_fee' => 15.00,
                'wash_fee' => 30.00,
                'rating' => 4.9,
                'reviews_count' => 280,
                'image' => 'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=800',
                'latitude' => 1.2847,
                'longitude' => 103.8610,
                'total_spots' => 600,
                'available_spots' => 312,
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
                'description' => 'Elite covered parking facility serving the Marina Bay Sands resort. Offers high-speed level-3 EV chargers, premium automated license key gates, and 24/7 security monitoring.',
                'reviews' => [
                    ['user' => 'Tan L.', 'rating' => 5, 'date' => '2026-06-05', 'comment' => 'World-class facility, extremely secure and convenient.'],
                ],
                'rules' => [
                    'Strictly park in your designated lot.',
                    'Keep parking barcode or license plate details clean.',
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
