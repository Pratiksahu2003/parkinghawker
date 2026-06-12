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
                'name' => 'Mumbai Nariman Point Garage',
                'slug' => 'mumbai-nariman-point-garage',
                'city' => 'Mumbai',
                'area' => 'Nariman Point',
                'address' => 'Plot No. 12, Maker Chambers VI, Nariman Point, Mumbai, Maharashtra 400021, India',
                'price_per_hour' => 150.00,
                'price_per_day' => 1000.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 150.00,
                'wash_fee' => 300.00,
                'rating' => 4.9,
                'reviews_count' => 184,
                'image' => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
                'latitude' => 18.9256,
                'longitude' => 72.8242,
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
                'description' => 'A premier, ultra-modern underground parking facility located in the heart of Mumbai\'s business district. Features state-of-the-art license plate recognition, 24/7 manned security, clean EV superchargers, and premium detailing services.',
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
                'name' => 'Delhi Connaught Place Deck',
                'slug' => 'delhi-connaught-place-deck',
                'city' => 'New Delhi',
                'area' => 'Connaught Place',
                'address' => 'Block E, Connaught Place, New Delhi, Delhi 110001, India',
                'price_per_hour' => 100.00,
                'price_per_day' => 700.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 100.00,
                'wash_fee' => 200.00,
                'rating' => 4.7,
                'reviews_count' => 295,
                'image' => 'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=800',
                'latitude' => 28.6304,
                'longitude' => 77.2177,
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
                'description' => 'Perfectly situated parking deck beneath the iconic Connaught Place circle. Features lightning-fast automated parking ramps, VIP valet service, and comprehensive round-the-clock surveillance.',
                'reviews' => [
                    ['user' => 'John D.', 'rating' => 5, 'date' => '2026-06-10', 'comment' => 'Location is unmatched. Right in Connaught Place and the valet service was stellar.'],
                ],
                'rules' => [
                    'Speed limit strictly 5mph.',
                    'Lock your vehicle and do not leave valuables visible.',
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Bangalore Indiranagar Smart Lot',
                'slug' => 'bangalore-indiranagar-smart-lot',
                'city' => 'Bengaluru',
                'area' => 'Indiranagar',
                'address' => '100 Feet Rd, Indiranagar, Bengaluru, Karnataka 560038, India',
                'price_per_hour' => 80.00,
                'price_per_day' => 600.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 100.00,
                'wash_fee' => 200.00,
                'rating' => 4.9,
                'reviews_count' => 176,
                'image' => 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&q=80&w=800',
                'latitude' => 12.9719,
                'longitude' => 77.6412,
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
                'description' => 'Sophisticated parking lot serving central Bengaluru and Indiranagar. Equipped with modern license scanners, fast electric vehicle bays, and direct access to major restaurants and retail spaces.',
                'reviews' => [
                    ['user' => 'William H.', 'rating' => 5, 'date' => '2026-06-02', 'comment' => 'Superb automated check-in, very secure and clean. Perfectly positioned for meetings.'],
                ],
                'rules' => [
                    'Check-in via license plate or QR code scan.',
                    'Follow standard city traffic guidelines apply nearby.',
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Pune Koregaon Park Auto-Vault',
                'slug' => 'pune-koregaon-park-auto-vault',
                'city' => 'Pune',
                'area' => 'Koregaon Park',
                'address' => 'Lane 5, Koregaon Park, Pune, Maharashtra 411001, India',
                'price_per_hour' => 60.00,
                'price_per_day' => 450.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 80.00,
                'wash_fee' => 150.00,
                'rating' => 4.9,
                'reviews_count' => 312,
                'image' => 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800',
                'latitude' => 18.5362,
                'longitude' => 73.8940,
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
                'description' => 'A state-of-the-art robotic lift system that parks your car automatically in our underground vertical vault. Supports standard EVs and features high-efficiency modern security controls.',
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
                'name' => 'Chennai T-Nagar Multi-Level',
                'slug' => 'chennai-t-nagar-multi-level',
                'city' => 'Chennai',
                'area' => 'T. Nagar',
                'address' => 'Usman Rd, T. Nagar, Chennai, Tamil Nadu 600017, India',
                'price_per_hour' => 70.00,
                'price_per_day' => 500.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 90.00,
                'wash_fee' => 180.00,
                'rating' => 4.8,
                'reviews_count' => 140,
                'image' => 'https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&q=80&w=800',
                'latitude' => 13.0405,
                'longitude' => 80.2337,
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
                'description' => 'Panoramic multi-level garage offering convenient parking in Chennai\'s shopping hub. Features premium self-parking, high-speed charging poles, and VIP detailing services.',
                'reviews' => [
                    ['user' => 'Oliver G.', 'rating' => 5, 'date' => '2026-06-09', 'comment' => 'Unbelievable view from the deck! Automated gates worked flawlessly.'],
                ],
                'rules' => [
                    'Observe speed limits and wind advisories.',
                    'Display valid reservation pass at dashboard.',
                ]
            ],
            6 => [
                'id' => 6,
                'name' => 'Kolkata Salt Lake Sector V Smart Garage',
                'slug' => 'kolkata-salt-lake-sector-v-smart-garage',
                'city' => 'Kolkata',
                'area' => 'Salt Lake Sector V',
                'address' => 'Sector V, Salt Lake City, Kolkata, West Bengal 700091, India',
                'price_per_hour' => 50.00,
                'price_per_day' => 400.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 70.00,
                'wash_fee' => 150.00,
                'rating' => 4.7,
                'reviews_count' => 220,
                'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=800',
                'latitude' => 22.5726,
                'longitude' => 88.4339,
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
                'description' => 'Premium parking just steps from Salt Lake Sector V tech hub. Features dynamic LED space indicators, multilingual 24/7 security attendants, and premium hand-wash detailing.',
                'reviews' => [
                    ['user' => 'Marc L.', 'rating' => 5, 'date' => '2026-06-04', 'comment' => 'Safe, clean, and right next to Sector V offices. Booking online saved me so much hassle.'],
                ],
                'rules' => [
                    'LPG (Liquid Petroleum Gas) vehicles are strictly prohibited.',
                    'Maximum height limit is 1.90m.',
                ]
            ],
            7 => [
                'id' => 7,
                'name' => 'Hyderabad HITEC City Smart Deck',
                'slug' => 'hyderabad-hitec-city-smart-deck',
                'city' => 'Hyderabad',
                'area' => 'HITEC City',
                'address' => 'Hitech City Rd, HITEC City, Hyderabad, Telangana 500081, India',
                'price_per_hour' => 90.00,
                'price_per_day' => 650.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 110.00,
                'wash_fee' => 220.00,
                'rating' => 4.6,
                'reviews_count' => 118,
                'image' => 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800',
                'latitude' => 17.4483,
                'longitude' => 78.3741,
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
                'description' => 'Modern parking garage in Hyderabad\'s IT hub. Features automated parking spot guidance, ticketless scan-in, high-speed charging poles, and carbon-neutral green electricity supply.',
                'reviews' => [
                    ['user' => 'Lukas K.', 'rating' => 5, 'date' => '2026-06-03', 'comment' => 'Super fast, easy transaction, and clean facilities. Right in Hitech City.'],
                ],
                'rules' => [
                    'Observe green vehicle parking regulations.',
                    'Maximum speed limit 10 km/h.',
                ]
            ],
            8 => [
                'id' => 8,
                'name' => 'Gurgaon Cyber City Sky-Deck',
                'slug' => 'gurgaon-cyber-city-sky-deck',
                'city' => 'Gurugram',
                'area' => 'Cyber City',
                'address' => 'DLF Cyber City, Gurugram, Haryana 122002, India',
                'price_per_hour' => 120.00,
                'price_per_day' => 800.00,
                'currency_symbol' => '₹',
                'currency_code' => 'INR',
                'ev_fee' => 130.00,
                'wash_fee' => 250.00,
                'rating' => 4.9,
                'reviews_count' => 280,
                'image' => 'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=800',
                'latitude' => 28.4950,
                'longitude' => 77.0898,
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
                'description' => 'Elite covered parking facility serving the Gurugram Cyber City corporate hub. Offers high-speed level-3 EV chargers, premium automated license key gates, and 24/7 security monitoring.',
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
