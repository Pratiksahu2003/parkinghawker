<?php

namespace App\Repositories;

class InMemoryBlogRepository implements BlogRepositoryInterface
{
    protected array $articles = [];

    public function __construct()
    {
        $this->articles = [
            'master-ev-charging-station' => [
                'title' => 'Mastering EV Charging Station Etiquette: A Modern Guide',
                'slug' => 'master-ev-charging-station',
                'category' => 'EV Charging',
                'author' => 'Alexander Pierce',
                'author_role' => 'EV Infrastructure Analyst',
                'date' => '2026-06-08',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&q=80&w=800',
                'summary' => 'As electric vehicle adoption skyrockets, charging spot rules are changing. Learn the unspoken guidelines of sharing superchargers in metropolitan decks.',
                'tags' => ['EV', 'Etiquette', 'Smart Parking'],
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">Electric vehicles (EVs) have transitioned from early-adopter novelties to the modern standard of urban transportation. With this rapid growth comes a new challenge: sharing charging infrastructure gracefully.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. Charge and Move</h3>
                    <p class="text-neutral-400 mb-6">The most fundamental rule of EV charging etiquette is simple: once your vehicle has reached its charging limit (usually 80% for fast charging to preserve battery life), move it. Leaving a fully charged car occupying a charger prevents other drivers from accessing vital juice.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">2. Avoid the "ICEing" Trap</h3>
                    <p class="text-neutral-400 mb-6">ICEing refers to Internal Combustion Engine (petrol/diesel) cars parking in designated EV charging spots. For EV drivers, these spots are not just convenient parking; they are fuel stations. Ensure you only park in charging spots if your vehicle is actively plugging in.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">3. Keep Cables Tidy</h3>
                    <p class="text-neutral-400 mb-6">Always wrap charging cables back onto their holsters when finished. Cable clutter is a trip hazard and can lead to expensive damage if run over by heavy vehicles.</p>
                '
            ],
            'urban-mobility-trends' => [
                'title' => 'Top 5 Urban Mobility and Smart Parking Trends for 2026',
                'slug' => 'urban-mobility-trends',
                'category' => 'Smart Parking',
                'author' => 'Sarah Sterling',
                'author_role' => 'Smart Cities Consultant',
                'date' => '2026-05-29',
                'read_time' => '7 min read',
                'image' => 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800',
                'summary' => 'Explore how micro-mobility integrations, AI-powered license scanning, and dynamic green pricing models are redefining how cities breathe and park.',
                'tags' => ['Urban Planning', 'AI', 'Green Tech'],
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">Modern metropolises are facing unprecedented congestion challenges. In response, cities are evolving. Smart parking is no longer just about finding a space; it is about seamless urban orchestration.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. AI License Plate Recognition (LPR)</h3>
                    <p class="text-neutral-400 mb-6">Ticketless parking has evolved. High-definition LPR cameras read license plates upon entry and exit, automatically billing pre-registered users. This eliminates entry-gate queues and enhances security.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">2. Dynamic Green Pricing</h3>
                    <p class="text-neutral-400 mb-6">To spread peak hour demands, smart decks now offer dynamic pricing. Rates drop when parking volumes are low, and green vehicles (EVs and hybrids) receive customized discounts dynamically computed based on occupancy.</p>
                '
            ],
            'stress-free-airport-parking' => [
                'title' => 'Stress-Free Airport Parking: Hacks for Frequent Flyers',
                'slug' => 'stress-free-airport-parking',
                'category' => 'Tips',
                'author' => 'Mark Sterling',
                'author_role' => 'Business Travel Lead',
                'date' => '2026-05-14',
                'read_time' => '4 min read',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&q=80&w=800',
                'summary' => 'Avoid chaotic terminal drop-offs. Learn how off-site premium parking, automated valet services, and digital bookings save time and money.',
                'tags' => ['Travel', 'Airport', 'Hacks'],
                'content' => '
                    <p class="lead text-xl text-neutral-300 mb-6">For frequent flyers, getting to the airport can be the most stressful part of the journey. Let\'s explore some simple tricks to optimize your departure logistics.</p>
                    <h3 class="text-2xl font-bold text-white mt-8 mb-4">1. Book At Least 48 Hours in Advance</h3>
                    <p class="text-neutral-400 mb-6">Pre-booking guarantees your spot and often secures discounts of up to 40% compared to drive-up gate rates. Digital reservation systems also enable express lane access.</p>
                '
            ]
        ];
    }

    public function all(): array
    {
        return array_values($this->articles);
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->articles[$slug] ?? null;
    }

    public function getRelated(array $article, int $limit = 3): array
    {
        $related = [];
        foreach ($this->articles as $slug => $art) {
            if ($slug !== $article['slug'] && $art['category'] === $article['category']) {
                $related[] = $art;
            }
        }

        // Fill remaining spaces if any
        if (count($related) < $limit) {
            foreach ($this->articles as $slug => $art) {
                if ($slug !== $article['slug'] && !in_array($art, $related)) {
                    $related[] = $art;
                }
                if (count($related) >= $limit) {
                    break;
                }
            }
        }

        return array_slice($related, 0, $limit);
    }

    public function search(array $filters): array
    {
        $results = $this->articles;

        if (!empty($filters['query'])) {
            $query = strtolower($filters['query']);
            $results = array_filter($results, function ($art) use ($query) {
                return str_contains(strtolower($art['title']), $query) ||
                    str_contains(strtolower($art['summary']), $query) ||
                    str_contains(strtolower($art['category']), $query);
            });
        }

        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $category = $filters['category'];
            $results = array_filter($results, function ($art) use ($category) {
                return $art['category'] === $category;
            });
        }

        return array_values($results);
    }

    public function getCategories(): array
    {
        $cats = [];
        foreach ($this->articles as $art) {
            $cats[] = $art['category'];
        }
        return array_unique($cats);
    }
}
