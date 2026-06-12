<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@parkinghawker.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // 2. Create Categories
        $categoriesData = [
            [
                'name' => 'EV Charging',
                'slug' => 'ev-charging',
                'description' => 'Electric vehicle infrastructure, charging guides, and updates.',
                'color' => '#06b6d4',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Smart Parking',
                'slug' => 'smart-parking',
                'description' => 'IoT, smart sensors, license plate scanning, and city trends.',
                'color' => '#8b5cf6',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Tips',
                'slug' => 'tips',
                'description' => 'Handy parking hacks, airport updates, and travel logistics.',
                'color' => '#ec4899',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Urban Planning',
                'slug' => 'urban-planning',
                'description' => 'Micro-mobility, pedestrianization, and city structural design.',
                'color' => '#f59e0b',
                'is_active' => true,
                'sort_order' => 4,
            ]
        ];

        $categories = [];
        foreach ($categoriesData as $catData) {
            $categories[$catData['name']] = BlogCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );
        }

        // 3. Create Posts
        $postsData = [
            [
                'title' => 'Mastering EV Charging Station Etiquette: A Modern Guide',
                'slug' => 'master-ev-charging-station',
                'category_name' => 'EV Charging',
                'author_name' => 'Alexander Pierce',
                'author_role' => 'EV Infrastructure Analyst',
                'excerpt' => 'As electric vehicle adoption skyrockets, charging spot rules are changing. Learn the unspoken guidelines of sharing superchargers in metropolitan decks.',
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">Electric vehicles (EVs) have transitioned from early-adopter novelties to the modern standard of urban transportation. With this rapid growth comes a new challenge: sharing charging infrastructure gracefully.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. Charge and Move</h3>
                    <p class="text-neutral-400 mb-6">The most fundamental rule of EV charging etiquette is simple: once your vehicle has reached its charging limit (usually 80% for fast charging to preserve battery life), move it. Leaving a fully charged car occupying a charger prevents other drivers from accessing vital juice.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">2. Avoid the "ICEing" Trap</h3>
                    <p class="text-neutral-400 mb-6">ICEing refers to Internal Combustion Engine (petrol/diesel) cars parking in designated EV charging spots. For EV drivers, these spots are not just convenient parking; they are fuel stations. Ensure you only park in charging spots if your vehicle is actively plugging in.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">3. Keep Cables Tidy</h3>
                    <p class="text-neutral-400 mb-6">Always wrap charging cables back onto their holsters when finished. Cable clutter is a trip hazard and can lead to expensive damage if run over by heavy vehicles.</p>
                ',
                'featured_image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&q=80&w=800',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'tags' => ['EV', 'Etiquette', 'Smart Parking'],
                'status' => 'published',
                'is_featured' => true,
                'published_at' => '2026-06-08 10:00:00',
            ],
            [
                'title' => 'Top 5 Urban Mobility and Smart Parking Trends for 2026',
                'slug' => 'urban-mobility-trends',
                'category_name' => 'Smart Parking',
                'author_name' => 'Sarah Sterling',
                'author_role' => 'Smart Cities Consultant',
                'excerpt' => 'Explore how micro-mobility integrations, AI-powered license scanning, and dynamic green pricing models are redefining how cities breathe and park.',
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">Modern metropolises are facing unprecedented congestion challenges. In response, cities are evolving. Smart parking is no longer just about finding a space; it is about seamless urban orchestration.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. AI License Plate Recognition (LPR)</h3>
                    <p class="text-neutral-400 mb-6">Ticketless parking has evolved. High-definition LPR cameras read license plates upon entry and exit, automatically billing pre-registered users. This eliminates entry-gate queues and enhances security.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">2. Dynamic Green Pricing</h3>
                    <p class="text-neutral-400 mb-6">To spread peak hour demands, smart decks now offer dynamic pricing. Rates drop when parking volumes are low, and green vehicles (EVs and hybrids) receive customized discounts dynamically computed based on occupancy.</p>
                ',
                'featured_image' => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
                'youtube_url' => null,
                'tags' => ['Urban Planning', 'AI', 'Green Tech'],
                'status' => 'published',
                'is_featured' => false,
                'published_at' => '2026-05-29 14:00:00',
            ],
            [
                'title' => 'Stress-Free Airport Parking: Hacks for Frequent Flyers',
                'slug' => 'stress-free-airport-parking',
                'category_name' => 'Tips',
                'author_name' => 'Mark Sterling',
                'author_role' => 'Business Travel Lead',
                'excerpt' => 'Avoid chaotic terminal drop-offs. Learn how off-site premium parking, automated valet services, and digital bookings save time and money.',
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">For frequent flyers, getting to the airport can be the most stressful part of the journey. Let\'s explore some simple tricks to optimize your departure logistics.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. Book At Least 48 Hours in Advance</h3>
                    <p class="text-neutral-400 mb-6">Pre-booking guarantees your spot and often secures discounts of up to 40% compared to drive-up gate rates. Digital reservation systems also enable express lane access.</p>
                ',
                'featured_image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&q=80&w=800',
                'youtube_url' => null,
                'tags' => ['Travel', 'Airport', 'Hacks'],
                'status' => 'published',
                'is_featured' => false,
                'published_at' => '2026-05-14 09:30:00',
            ]
        ];

        foreach ($postsData as $pData) {
            $catName = $pData['category_name'];
            unset($pData['category_name']);
            $pData['category_id'] = $categories[$catName]->id;

            BlogPost::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );
        }
    }
}
