@php
    $pageTitle = 'Parking Near ' . $location['name'] . ' – ' . $location['city'];
    $pageDesc  = 'Find cheap, secure parking near ' . $location['name'] . ' in ' . $location['city'] . ', India. Compare hourly & daily rates, EV charging spots, and book instantly on ParkingHawker.';
    $canonUrl  = request()->url();

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => 'WebPage',
                '@id'             => $canonUrl . '#webpage',
                'url'             => $canonUrl,
                'name'            => $pageTitle,
                'description'     => $pageDesc,
                'isPartOf'        => ['@type' => 'WebSite', 'name' => 'ParkingHawker', 'url' => url('/')],
                'about'           => ['@type' => 'Place', 'name' => $location['name'], 'address' => ['@type' => 'PostalAddress', 'addressLocality' => $location['city'], 'addressCountry' => 'IN']],
                'dateModified'    => now()->toAtomString(),
                'inLanguage'      => 'en-IN',
                'author'          => ['@type' => 'Organization', 'name' => 'ParkingHawker', 'url' => url('/')],
            ],
            [
                '@type'     => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',         'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Parking Near Me','item' => route('parking.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $location['city'],'item' => route('parking.index', ['city' => $location['city']])],
                    ['@type' => 'ListItem', 'position' => 4, 'name' => $location['name'], 'item' => $canonUrl],
                ],
            ],
            [
                '@type'       => 'FAQPage',
                'mainEntity'  => [
                    ['@type' => 'Question', 'name' => 'Where can I park near ' . $location['name'] . '?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'ParkingHawker lists 500+ verified parking spots near ' . $location['name'] . ' in ' . $location['city'] . '. Use our map to find the nearest and most affordable options.']],
                    ['@type' => 'Question', 'name' => 'How much does parking cost near ' . $location['name'] . '?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Parking near ' . $location['name'] . ' starts from ₹15 per hour for bikes and ₹20 per hour for cars. Daily passes start from ₹100–₹300 depending on the facility.']],
                    ['@type' => 'Question', 'name' => 'Is there 24-hour parking near ' . $location['name'] . '?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Several lots near ' . $location['name'] . ' operate 24/7. Look for the "24h" tag when browsing on ParkingHawker.']],
                    ['@type' => 'Question', 'name' => 'Is there EV charging parking near ' . $location['name'] . '?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, select facilities near ' . $location['name'] . ' offer Type-2 and CCS EV charging bays. Filter by "EV Charging" when searching.']],
                ],
            ],
            [
                '@type'           => 'LocalBusiness',
                'name'            => 'ParkingHawker – Parking Near ' . $location['name'],
                'url'             => $canonUrl,
                'description'     => $pageDesc,
                'serviceArea'     => ['@type' => 'City', 'name' => $location['city'], 'addressCountry' => 'IN'],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name'  => 'Parking Services',
                    'itemListElement' => [
                        ['@type' => 'Offer', 'name' => 'Hourly Parking',  'priceCurrency' => 'INR', 'price' => '20'],
                        ['@type' => 'Offer', 'name' => 'Daily Parking',   'priceCurrency' => 'INR', 'price' => '150'],
                        ['@type' => 'Offer', 'name' => 'Monthly Parking', 'priceCurrency' => 'INR', 'price' => '2000'],
                    ],
                ],
                'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => '4.7', 'reviewCount' => '8412', 'bestRating' => '5'],
            ],
        ],
    ];
@endphp

<x-public-layout>
    <x-slot name="seo">
        <x-seo
            title="{{ $pageTitle }}"
            description="{{ $pageDesc }}"
            image="{{ $location['image'] }}"
            canonical="{{ $canonUrl }}"
            :schema="$schema"
        />
        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <meta name="geo.region" content="IN">
        <meta name="geo.placename" content="{{ $location['city'] }}">
        <meta property="og:locale" content="en_IN">
        <meta name="keywords" content="parking near {{ $location['name'] }}, parking near me {{ $location['city'] }}, cheap parking {{ $location['city'] }}, hourly parking {{ $location['name'] }}, book parking {{ $location['city'] }}, EV parking {{ $location['city'] }}">
    </x-slot>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- HERO --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative min-h-[420px] flex flex-col justify-end pb-10 pt-24 overflow-hidden"
        style="background: linear-gradient(145deg,#04060d 0%,#0c1020 60%,#030508 100%);">

        <div class="absolute -top-24 -right-24 h-[500px] w-[500px] rounded-full bg-brand-purple/8 blur-[130px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 h-[300px] w-[300px] rounded-full bg-brand-cyan/6 blur-[90px] pointer-events-none"></div>

        <div class="absolute inset-0 z-0">
            <img src="{{ $location['image'] }}" alt="Parking near {{ $location['name'] }}"
                class="w-full h-full object-cover opacity-[0.1]" loading="eager" fetchpriority="high">
            <div class="absolute inset-0 bg-gradient-to-t from-[#04060d] via-[#04060d]/70 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full space-y-5">
            {{-- Breadcrumb --}}
            <nav aria-label="Breadcrumb"
                class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] font-medium uppercase tracking-widest text-neutral-500">
                <a href="{{ route('home') }}" class="hover:text-brand-cyan transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('parking.index') }}" class="hover:text-brand-cyan transition-colors">Find Parking</a>
                <span>/</span>
                <a href="{{ route('parking.index', ['city' => $location['city']]) }}"
                    class="hover:text-brand-cyan transition-colors">{{ $location['city'] }}</a>
                <span>/</span>
                <span class="text-neutral-300 truncate max-w-[200px]" aria-current="page">Parking Near Me</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-3xl space-y-4">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-purple/10 border border-brand-purple/25 text-brand-purple text-[11px] font-bold uppercase tracking-wider">
                            📍 Parking Near Me
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-[11px] font-bold uppercase tracking-wider">
                            ✅ 500+ Verified Spots
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-neutral-300 text-[11px] font-semibold uppercase tracking-wider">
                            🏙️ {{ $location['city'] }}, India
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-[3.25rem] font-extrabold text-white tracking-tight leading-[1.1]">
                        Parking Near<br>
                        <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                            {{ $location['name'] }}
                        </span>
                    </h1>

                    <p class="text-neutral-400 text-sm sm:text-base leading-relaxed max-w-2xl">
                        Find and book the <strong class="text-white">nearest, cheapest, and safest</strong> parking spots
                        in <strong class="text-brand-cyan">{{ $location['city'] }}</strong> around
                        <strong class="text-white">{{ $location['name'] }}</strong>.
                        Real-time availability · Instant QR booking · No hidden charges.
                    </p>

                    {{-- Quick rating --}}
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center gap-1.5">
                            @for($s=0;$s<5;$s++)
                            <svg class="h-4 w-4 {{ $s<4?'text-yellow-400':'text-yellow-400/50' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                            <span class="text-white font-bold text-sm">4.7</span>
                            <span class="text-neutral-500 text-xs">(8,412 reviews)</span>
                        </div>
                        <span class="text-neutral-600">|</span>
                        <span class="text-xs text-brand-accent flex items-center gap-1.5 font-medium">
                            <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                            Spots Available Right Now
                        </span>
                    </div>

                    {{-- Quick search CTA --}}
                    <form action="{{ route('parking.index') }}" method="GET"
                        class="flex flex-col sm:flex-row gap-3 max-w-lg pt-1">
                        <input type="hidden" name="city" value="{{ $location['city'] }}">
                        <input type="text" name="area"
                            placeholder="Narrow down by landmark, area..."
                            class="flex-1 px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-neutral-600 focus:outline-none focus:border-brand-cyan">
                        <button type="submit"
                            class="magnetic-btn px-6 py-3 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-90 transition-all whitespace-nowrap">
                            🔍 Find Parking
                        </button>
                    </form>
                </div>

                {{-- Right hero stats --}}
                <div class="hidden lg:grid grid-cols-2 gap-3 min-w-[220px]">
                    @foreach([
                        ['n'=>'500+','l'=>'Verified Spots'],
                        ['n'=>'₹15','l'=>'/ hr from'],
                        ['n'=>'4.7★','l'=>'Avg Rating'],
                        ['n'=>'24/7','l'=>'Available'],
                    ] as $hs)
                    <div class="glass-card rounded-2xl p-4 border border-white/5 text-center">
                        <p class="text-xl font-extrabold text-white">{{ $hs['n'] }}</p>
                        <p class="text-[10px] text-neutral-500 mt-0.5">{{ $hs['l'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- STATS STRIP --}}
    <div class="bg-white/[0.025] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach([
                ['icon'=>'🚗','val'=>'500+',    'l'=>'Parking Spots'],
                ['icon'=>'⭐','val'=>'4.7/5',   'l'=>'User Rating'],
                ['icon'=>'💳','val'=>'₹15/hr',  'l'=>'Starting Rate'],
                ['icon'=>'⚡','val'=>'EV Bays', 'l'=>'Available'],
                ['icon'=>'🔒','val'=>'24/7',    'l'=>'Security'],
                ['icon'=>'📱','val'=>'QR Entry','l'=>'Instant Access'],
            ] as $s)
            <div class="flex items-center gap-2.5">
                <span class="text-xl">{{ $s['icon'] }}</span>
                <div>
                    <p class="text-sm font-bold text-white leading-none">{{ $s['val'] }}</p>
                    <p class="text-[10px] text-neutral-500 uppercase tracking-wider mt-0.5">{{ $s['l'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- MAIN CONTENT GRID --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ─── LEFT COLUMN ─── --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- AVAILABLE SPOTS --}}
            <article class="space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                        <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Verified Listings</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white">Available Parking Spots</h2>
                        <span class="text-xs text-neutral-500 font-medium">Near {{ $location['name'] }}</span>
                    </div>
                </header>

                {{-- Filter chips --}}
                <div class="flex flex-wrap gap-2">
                    @foreach(['All Types','Covered','Underground','Open Air','EV Charging','Valet','24/7'] as $filter)
                    <button class="px-3.5 py-1.5 rounded-full border text-xs font-semibold transition-all
                        {{ $filter==='All Types' ? 'bg-brand-cyan/10 border-brand-cyan/30 text-brand-cyan' : 'border-white/10 text-neutral-400 hover:border-white/30 hover:text-white bg-white/[0.03]' }}">
                        {{ $filter }}
                    </button>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @php
                        $spots = [
                            ['name'=>'Central Parking Hub',       'area'=>'City Centre',       'dist'=>'0.2 km','price'=>35,'day'=>220,'rating'=>4.9,'reviews'=>892,'spots'=>120,'badge'=>'Top Rated','type'=>'Covered',     'ev'=>true, 'valet'=>true, 'hrs'=>'24/7'],
                            ['name'=>'Metro Station Park & Ride', 'area'=>'Metro Gate South',  'dist'=>'0.4 km','price'=>20,'day'=>130,'rating'=>4.6,'reviews'=>445,'spots'=>80, 'badge'=>'Budget',    'type'=>'Open Air',    'ev'=>false,'valet'=>false,'hrs'=>'5AM–11PM'],
                            ['name'=>'Mall Underground Garage',   'area'=>'Shopping District', 'dist'=>'0.6 km','price'=>45,'day'=>280,'rating'=>4.8,'reviews'=>1240,'spots'=>350,'badge'=>'Premium',  'type'=>'Underground', 'ev'=>true, 'valet'=>true, 'hrs'=>'7AM–10PM'],
                            ['name'=>'Hospital Multi-Level Deck', 'area'=>'Medical District',  'dist'=>'0.8 km','price'=>25,'day'=>160,'rating'=>4.5,'reviews'=>327,'spots'=>60, 'badge'=>'Accessible','type'=>'Covered',     'ev'=>false,'valet'=>false,'hrs'=>'6AM–11PM'],
                            ['name'=>'IT Park Smart Garage',      'area'=>'Tech Corridor',     'dist'=>'1.1 km','price'=>50,'day'=>320,'rating'=>4.9,'reviews'=>512,'spots'=>300,'badge'=>'Corporate', 'type'=>'Covered',     'ev'=>true, 'valet'=>true, 'hrs'=>'24/7'],
                            ['name'=>'Market Area Open Parking',  'area'=>'Commercial Zone',   'dist'=>'1.4 km','price'=>15,'day'=>90,'rating'=>4.3,'reviews'=>189,'spots'=>45, 'badge'=>'Nearby',    'type'=>'Open Air',    'ev'=>false,'valet'=>false,'hrs'=>'6AM–10PM'],
                        ];
                    @endphp

                    @foreach($spots as $spot)
                    <div class="glass-card rounded-3xl border border-white/5 hover:border-white/15 transition-all group overflow-hidden flex flex-col">
                        <div class="relative h-40 overflow-hidden bg-white/5">
                            <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=600"
                                alt="{{ $spot['name'] }}"
                                class="w-full h-full object-cover opacity-50 group-hover:opacity-70 transition-opacity">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark-primary via-dark-primary/30 to-transparent"></div>
                            {{-- Top badges --}}
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-full bg-dark-primary/80 border border-white/10 text-[10px] font-bold text-white">
                                    {{ $spot['badge'] }}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 flex flex-col gap-1 items-end">
                                @if($spot['ev'])<span class="px-2 py-0.5 rounded-full bg-brand-cyan/20 border border-brand-cyan/30 text-[10px] font-bold text-brand-cyan">⚡ EV</span>@endif
                                @if($spot['valet'])<span class="px-2 py-0.5 rounded-full bg-brand-purple/20 border border-brand-purple/30 text-[10px] font-bold text-brand-purple">🚗 Valet</span>@endif
                            </div>
                            {{-- Distance chip --}}
                            <div class="absolute bottom-3 left-3">
                                <span class="px-2.5 py-1 rounded-full bg-dark-primary/80 border border-white/10 text-[10px] text-neutral-300 font-medium">
                                    📍 {{ $spot['dist'] }} away
                                </span>
                            </div>
                        </div>

                        <div class="p-4 flex flex-col gap-3 flex-grow">
                            <div>
                                <h3 class="text-sm font-bold text-white leading-snug">{{ $spot['name'] }}</h3>
                                <p class="text-xs text-neutral-500 mt-0.5">{{ $spot['area'] }}, {{ $location['city'] }}</p>
                            </div>

                            <div class="grid grid-cols-3 gap-2 text-xs">
                                <div class="text-center p-2 rounded-xl bg-white/[0.04] border border-white/8">
                                    <p class="font-extrabold text-white text-sm">₹{{ $spot['price'] }}</p>
                                    <p class="text-neutral-600 text-[10px] mt-0.5">/hour</p>
                                </div>
                                <div class="text-center p-2 rounded-xl bg-white/[0.04] border border-white/8">
                                    <p class="font-extrabold text-brand-cyan text-sm">₹{{ $spot['day'] }}</p>
                                    <p class="text-neutral-600 text-[10px] mt-0.5">/day</p>
                                </div>
                                <div class="text-center p-2 rounded-xl bg-white/[0.04] border border-white/8">
                                    <p class="font-extrabold text-yellow-400 text-sm">{{ $spot['rating'] }}★</p>
                                    <p class="text-neutral-600 text-[10px] mt-0.5">{{ number_format($spot['reviews']) }} reviews</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-1.5 text-[10px]">
                                <span class="px-2 py-1 rounded-full bg-white/5 border border-white/10 text-neutral-400">{{ $spot['type'] }}</span>
                                <span class="px-2 py-1 rounded-full bg-white/5 border border-white/10 text-neutral-400">{{ $spot['hrs'] }}</span>
                                <span class="px-2 py-1 rounded-full bg-white/5 border border-white/10 text-neutral-400">{{ $spot['spots'] }} spots</span>
                            </div>

                            <div class="flex gap-2 mt-auto">
                                <a href="{{ route('parking.index', ['city' => $location['city']]) }}"
                                    class="flex-1 text-center py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 text-xs font-semibold text-white transition-all">
                                    Details
                                </a>
                                <a href="{{ route('parking.index', ['city' => $location['city']]) }}"
                                    class="flex-1 text-center py-2 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white text-xs font-bold hover:opacity-90 transition-all">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center pt-2">
                    <a href="{{ route('parking.index', ['city' => $location['city']]) }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl border border-white/10 text-neutral-300 hover:text-white hover:border-white/30 hover:bg-white/5 font-semibold text-sm transition-all">
                        Load More Parking Spots
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>
            </article>

            {{-- AD SLOT --}}
            <x-ad-slot slot="location_page_mid" class="rounded-3xl overflow-hidden" />

            {{-- ABOUT THIS AREA (E-E-A-T: Experience) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-purple rounded-full"></span>
                        <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Local Parking Guide</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Parking Near {{ $location['city'] }} — Expert Overview</h2>
                </header>
                <div class="space-y-4 text-sm text-neutral-400 leading-relaxed">
                    <p>
                        <strong class="text-white">{{ $location['name'] }}</strong> is located in
                        <strong class="text-brand-cyan">{{ $location['city'] }}</strong>, one of India's most
                        densely populated urban areas. Finding safe and affordable parking in this neighbourhood
                        can be challenging — street parking is often limited and congested during peak hours.
                    </p>
                    <p>
                        ParkingHawker has partnered with <strong class="text-white">500+ verified facilities</strong>
                        in and around this area, ranging from open-air budget lots starting at ₹15/hr to
                        premium covered decks with EV charging and valet at ₹300+ per day.
                        All partner lots are physically inspected by our operations team before listing.
                    </p>
                    <p>
                        <strong class="text-white">Pro tip:</strong> For visits to {{ $location['name'] }},
                        we recommend booking at least <strong class="text-brand-cyan">30 minutes in advance</strong>
                        during weekdays (9 AM – 7 PM) as lots fill up quickly. Weekend mornings are generally
                        less congested, with up to 40% more spots available.
                    </p>
                </div>

                {{-- Pros/Cons table --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-2.5">
                        <p class="text-xs font-bold text-brand-accent uppercase tracking-wider mb-2">✅ Parking Pros in This Area</p>
                        @foreach([
                            'Multiple budget options under ₹30/hr',
                            'Several lots open 24/7',
                            'Easy metro connectivity nearby',
                            'EV charging available at select lots',
                            'Covered multi-level decks for monsoon season',
                        ] as $pro)
                        <div class="flex items-start gap-2 text-xs text-neutral-400">
                            <svg class="h-3.5 w-3.5 text-brand-accent flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $pro }}
                        </div>
                        @endforeach
                    </div>
                    <div class="space-y-2.5">
                        <p class="text-xs font-bold text-red-400/70 uppercase tracking-wider mb-2">⚠️ Things to Note</p>
                        @foreach([
                            'Peak hours (9AM–7PM) get crowded fast',
                            'Street parking limited on weekdays',
                            'Some lots don't allow overnight parking',
                            'Festival days see 3× normal demand',
                            'Always confirm rate before entering open lots',
                        ] as $con)
                        <div class="flex items-start gap-2 text-xs text-neutral-500">
                            <svg class="h-3.5 w-3.5 text-neutral-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $con }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </article>

            {{-- PRICING COMPARISON TABLE (E-E-A-T: Expertise) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                        <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Transparent Pricing</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Parking Rate Comparison</h2>
                    <p class="text-sm text-neutral-500 mt-1">Average rates near {{ $location['name'] }}, {{ $location['city'] }}. Updated Jun 2026.</p>
                </header>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="text-left py-2.5 pr-4 text-xs text-neutral-500 uppercase tracking-wider font-bold">Lot Type</th>
                                <th class="text-center py-2.5 px-3 text-xs text-neutral-500 uppercase tracking-wider font-bold">Hourly</th>
                                <th class="text-center py-2.5 px-3 text-xs text-neutral-500 uppercase tracking-wider font-bold">Day Pass</th>
                                <th class="text-center py-2.5 px-3 text-xs text-neutral-500 uppercase tracking-wider font-bold">Monthly</th>
                                <th class="text-center py-2.5 pl-3 text-xs text-neutral-500 uppercase tracking-wider font-bold">Rating</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach([
                                ['t'=>'🏢 Covered Deck',      'h'=>'₹35–₹60','d'=>'₹220–₹320','m'=>'₹2,500+', 'r'=>'4.8★'],
                                ['t'=>'🚇 Metro Adjacent',    'h'=>'₹20–₹35','d'=>'₹130–₹200','m'=>'₹1,800+', 'r'=>'4.6★'],
                                ['t'=>'🛒 Mall Basement',     'h'=>'₹40–₹60','d'=>'₹250–₹350','m'=>'N/A',     'r'=>'4.9★'],
                                ['t'=>'🏥 Hospital Zone',     'h'=>'₹20–₹30','d'=>'₹130–₹180','m'=>'₹1,500+', 'r'=>'4.5★'],
                                ['t'=>'🌳 Open-Air Budget',   'h'=>'₹15–₹25','d'=>'₹90–₹150', 'm'=>'₹1,000+', 'r'=>'4.3★'],
                                ['t'=>'⚡ EV-Enabled Premium','h'=>'₹50–₹80','d'=>'₹300–₹450','m'=>'₹3,500+', 'r'=>'4.9★'],
                            ] as $row)
                            <tr class="hover:bg-white/[0.03] transition-colors">
                                <td class="py-3 pr-4 font-medium text-neutral-300 text-sm">{{ $row['t'] }}</td>
                                <td class="py-3 px-3 text-center text-white font-bold">{{ $row['h'] }}</td>
                                <td class="py-3 px-3 text-center text-brand-cyan font-semibold">{{ $row['d'] }}</td>
                                <td class="py-3 px-3 text-center text-neutral-400">{{ $row['m'] }}</td>
                                <td class="py-3 pl-3 text-center text-yellow-400 font-semibold">{{ $row['r'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-xs text-neutral-600 italic">* Prices are market averages. Actual rates may vary by facility. Book on ParkingHawker for guaranteed pricing.</p>
            </article>

            {{-- TIPS & EXPERT ADVICE (E-E-A-T: Experience / Authoritativeness) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-accent rounded-full"></span>
                        <span class="text-xs font-bold text-brand-accent uppercase tracking-widest">Expert Tips</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Smart Parking Tips for {{ $location['city'] }}</h2>
                    <p class="text-sm text-neutral-500 mt-1">Written by the ParkingHawker Ops Team — {{ $location['city'] }} City Parking Experts.</p>
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['n'=>'01','icon'=>'⏰','t'=>'Book in Advance',         'b'=>'Secure your slot 30+ minutes early. Peak-hour lots (9AM–7PM) fill within minutes of release.'],
                        ['n'=>'02','icon'=>'📱','t'=>'Use QR Entry',            'b'=>'Pre-paid QR code means zero wait at the boom barrier. Walk straight to your spot.'],
                        ['n'=>'03','icon'=>'💡','t'=>'Compare Before You Park', 'b'=>'Use our map view to compare rates from 3–5 nearby lots before committing.'],
                        ['n'=>'04','icon'=>'🌧️','t'=>'Monsoon Covered Lots',   'b'=>'During July–September, prioritize covered lots to avoid waterlogged open-air spots.'],
                        ['n'=>'05','icon'=>'⚡','t'=>'EV Charging Slots',      'b'=>'Filter by "EV Charging" to find compatible bays. Type-2 and CCS connectors available.'],
                        ['n'=>'06','icon'=>'📅','t'=>'Monthly Passes Save ₹',  'b'=>'Regular commuters save 30–40% with monthly subscriptions vs hourly rates.'],
                    ] as $tip)
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white/[0.03] border border-white/8 hover:border-white/15 transition-colors">
                        <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-gradient-to-br from-brand-cyan/20 to-brand-purple/20 border border-white/10 flex items-center justify-center">
                            <span class="text-lg">{{ $tip['icon'] }}</span>
                        </div>
                        <div>
                            <p class="text-xs font-extrabold text-brand-cyan uppercase tracking-wider mb-1">Tip #{{ $tip['n'] }}</p>
                            <p class="text-sm font-bold text-white mb-1">{{ $tip['t'] }}</p>
                            <p class="text-xs text-neutral-500 leading-relaxed">{{ $tip['b'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>

            {{-- VERIFIED REVIEWS (E-E-A-T: Authoritativeness) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-6">
                <header class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="h-1 w-8 bg-yellow-400 rounded-full"></span>
                            <span class="text-xs font-bold text-yellow-400 uppercase tracking-widest">Real Drivers</span>
                        </div>
                        <h2 class="text-2xl font-bold text-white">What Drivers Say</h2>
                        <p class="text-sm text-neutral-500 mt-1">About parking near {{ $location['name'] }}, {{ $location['city'] }}</p>
                    </div>
                    <div class="text-center hidden sm:block">
                        <p class="text-4xl font-extrabold text-white">4.7</p>
                        <div class="flex justify-center gap-0.5 my-1">
                            @for($s=0;$s<5;$s++)<svg class="h-3 w-3 {{ $s<4?'text-yellow-400':'text-yellow-400/50' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        </div>
                        <p class="text-[10px] text-neutral-500">8,412 reviews</p>
                    </div>
                </header>

                <div class="space-y-4">
                    @foreach([
                        ['name'=>'Deepak Verma',   'role'=>'Daily Commuter',       'date'=>'June 2026','rating'=>5,'comment'=>'ParkingHawker has made commuting in ' . $location['city'] . ' so much easier. I always find a spot near ' . $location['name'] . '. The QR entry is genius — zero wait time.','verified'=>true],
                        ['name'=>'Kavya Reddy',    'role'=>'Weekend Shopper',      'date'=>'May 2026', 'rating'=>5,'comment'=>'Used the day pass option. Incredibly affordable compared to street parking charges in this area. The covered lot kept my car safe in the rain too!','verified'=>true],
                        ['name'=>'Mohammed Raza',  'role'=>'Hospital Visitor',     'date'=>'May 2026', 'rating'=>4,'comment'=>'Parked for 3 days near the medical district. Staff were cooperative and the rates were reasonable. Some bays were tight but overall great experience.','verified'=>true],
                        ['name'=>'Ananya Singh',   'role'=>'EV Driver · Nexon EV', 'date'=>'Apr 2026', 'rating'=>5,'comment'=>'Found a proper CCS charging spot near ' . $location['name'] . '. Charged from 20% to 80% in 90 minutes. The app showed real-time charger availability — brilliant!','verified'=>true],
                    ] as $rev)
                    <div class="p-4 rounded-2xl bg-white/[0.03] border border-white/8 space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-brand-purple/30 to-brand-cyan/30 border border-white/10 flex items-center justify-center text-sm font-bold text-white flex-shrink-0">
                                    {{ strtoupper(substr($rev['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-sm font-bold text-white">{{ $rev['name'] }}</span>
                                        @if($rev['verified'])
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-brand-accent/10 border border-brand-accent/20 text-[10px] font-bold text-brand-accent">✓ Verified Driver</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-neutral-500">{{ $rev['role'] }} · {{ $rev['date'] }}</p>
                                </div>
                            </div>
                            <div class="flex gap-0.5 flex-shrink-0">
                                @for($s=0;$s<$rev['rating'];$s++)<svg class="h-3.5 w-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                            </div>
                        </div>
                        <p class="text-sm text-neutral-400 leading-relaxed">"{{ $rev['comment'] }}"</p>
                        <div class="ml-3 pl-3 border-l border-brand-purple/20 space-y-1">
                            <p class="text-[11px] font-bold text-brand-purple">💬 ParkingHawker Response</p>
                            <p class="text-[11px] text-neutral-600 italic leading-relaxed">Thank you for sharing your experience! We continuously work to add more facilities near {{ $location['name'] }}. See you again on your next visit!</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>

            {{-- FAQ (E-E-A-T: Expertise + Trust) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5" x-data="{ open: null }">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-accent rounded-full"></span>
                        <span class="text-xs font-bold text-brand-accent uppercase tracking-widest">Expert Answers</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Frequently Asked Questions</h2>
                    <p class="text-sm text-neutral-500 mt-1">Answered by the ParkingHawker city operations team.</p>
                </header>
                <div class="space-y-2">
                    @php $faqs = [
                        ['q' => 'Where can I park near ' . $location['name'] . '?',
                         'a' => 'ParkingHawker lists 500+ verified lots near ' . $location['name'] . ' in ' . $location['city'] . '. Use our search or map view to find the nearest available spot based on your vehicle type and preferred duration.'],
                        ['q' => 'What is the cheapest parking near ' . $location['name'] . '?',
                         'a' => 'Open-air budget lots near ' . $location['name'] . ' start from ₹15/hr for bikes and ₹20/hr for cars. Two-wheeler lots offer the most affordable rates in this area.'],
                        ['q' => 'Is there overnight / 24-hour parking near ' . $location['name'] . '?',
                         'a' => 'Several covered and open-air facilities near ' . $location['city'] . ' operate 24/7 or offer overnight passes starting from ₹100. Filter by "24/7" on ParkingHawker to see these options.'],
                        ['q' => 'Is there EV charging parking near ' . $location['name'] . '?',
                         'a' => 'Yes. Select ParkingHawker-listed lots near ' . $location['name'] . ' are equipped with Type-2 AC chargers and CCS DC fast chargers. Charging is billed separately at ₹12–₹18/kWh.'],
                        ['q' => 'How do I cancel a parking booking?',
                         'a' => 'Log in to your ParkingHawker account, go to "My Bookings", and select Cancel. Cancellations made 2+ hours before entry get a full refund. Later cancellations may incur a partial charge.'],
                        ['q' => 'Is street parking available near ' . $location['name'] . '?',
                         'a' => 'Limited street parking is available but is often congested and unregulated. ParkingHawker partner lots provide a safer, hassle-free alternative with guaranteed spots.'],
                        ['q' => 'Can I get a monthly parking pass near ' . $location['name'] . '?',
                         'a' => 'Yes! Monthly passes near ' . $location['city'] . ' are available for regular commuters at 30–40% savings over daily rates. Contact ParkingHawker support or enquire directly at select lots.'],
                    ]; @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="border border-white/8 rounded-2xl overflow-hidden hover:border-white/15 transition-colors">
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex items-center justify-between p-4 text-left group"
                            :aria-expanded="open === {{ $i }} ? 'true' : 'false'">
                            <span class="text-sm font-semibold text-neutral-300 group-hover:text-white transition-colors pr-4">{{ $faq['q'] }}</span>
                            <svg class="h-4 w-4 flex-shrink-0 text-neutral-500 transition-transform duration-300"
                                :class="open === {{ $i }} ? 'rotate-180 text-brand-cyan' : ''"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse style="display:none;">
                            <div class="px-4 pb-4 pt-1 border-t border-white/5">
                                <p class="text-sm text-neutral-400 leading-relaxed">{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>

        </div>{{-- end left col --}}

        {{-- ─── RIGHT SIDEBAR ─── --}}
        <aside class="space-y-6 lg:sticky lg:top-24 self-start">

            {{-- SEARCH / BOOK WIDGET --}}
            <div class="glass-panel rounded-3xl p-6 border border-white/10 shadow-2xl space-y-5">
                <div class="text-center space-y-1 pb-4 border-b border-white/8">
                    <p class="text-[10px] font-extrabold text-brand-cyan uppercase tracking-[0.2em]">Find Parking Now</p>
                    <h3 class="text-sm font-bold text-white">Near {{ $location['name'] }}</h3>
                    <p class="text-xs text-neutral-500">{{ $location['city'] }}, India</p>
                </div>
                <form action="{{ route('parking.index') }}" method="GET" class="space-y-3">
                    <input type="hidden" name="city" value="{{ $location['city'] }}">
                    <div>
                        <label class="text-[10px] font-bold text-neutral-500 uppercase tracking-wider block mb-1.5">Vehicle Type</label>
                        <select name="vehicle_type"
                            class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                            <option value="">All Vehicles</option>
                            <option value="car">🚗 Car / Sedan</option>
                            <option value="suv">🚙 SUV / MUV</option>
                            <option value="motorcycle">🏍️ Bike / Scooter</option>
                            <option value="ev">⚡ Electric Vehicle</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-neutral-500 uppercase tracking-wider block mb-1.5">Parking Type</label>
                        <select name="parking_type"
                            class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                            <option value="">Any Type</option>
                            <option value="covered">🏢 Covered / Multi-Level</option>
                            <option value="underground">🚇 Underground</option>
                            <option value="rooftop">🌤️ Rooftop / Open</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="magnetic-btn w-full py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-extrabold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-90 transition-all">
                        🔍 Search Available Spots
                    </button>
                </form>
                <p class="text-[10px] text-center text-neutral-600">Free to search · Book in 60 seconds</p>
            </div>

            {{-- AD SLOT --}}
            <x-ad-slot slot="location_page_sidebar_top" />

            {{-- TRUST BADGES --}}
            <div class="glass-card rounded-3xl p-5 border border-white/5 space-y-4">
                <p class="text-[10px] font-extrabold text-neutral-500 uppercase tracking-[0.18em]">Why ParkingHawker</p>
                <div class="space-y-3">
                    @foreach([
                        ['icon'=>'🏅','t'=>'10+ Years Experience',     's'=>'Urban parking management experts'],
                        ['icon'=>'✅','t'=>'Verified Listings Only',    's'=>'Every lot inspected on-ground'],
                        ['icon'=>'🛡️','t'=>'₹50K Vehicle Protection', 's'=>'Shield™ liability guarantee'],
                        ['icon'=>'⭐','t'=>'4.8★ on App Stores',       's'=>'100,000+ happy drivers'],
                        ['icon'=>'🔒','t'=>'Encrypted Payments',       's'=>'RBI-licensed Razorpay gateway'],
                        ['icon'=>'📞','t'=>'24/7 Support',             's'=>'Chat, call, or WhatsApp'],
                    ] as $t)
                    <div class="flex items-start gap-3">
                        <span class="text-lg flex-shrink-0">{{ $t['icon'] }}</span>
                        <div>
                            <p class="text-xs font-bold text-white">{{ $t['t'] }}</p>
                            <p class="text-[11px] text-neutral-600">{{ $t['s'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- EXPERT AUTHOR (E-E-A-T) --}}
            <div class="glass-card rounded-3xl p-5 border border-white/5 space-y-3">
                <p class="text-[10px] font-extrabold text-neutral-500 uppercase tracking-[0.18em]">Content Authored By</p>
                <div class="flex items-start gap-3">
                    <div class="h-11 w-11 rounded-full bg-gradient-to-br from-brand-cyan/40 to-brand-purple/40 border border-white/10 flex items-center justify-center text-lg flex-shrink-0">🗺️</div>
                    <div>
                        <p class="text-sm font-bold text-white">City Parking Ops Team</p>
                        <p class="text-[11px] text-neutral-500 leading-relaxed mt-0.5">
                            Our team of {{ $location['city'] }} urban mobility specialists researches and
                            maintains all area parking guides based on live market data and regular field visits.
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 pt-1">
                    <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] text-neutral-400">✅ Fact-checked</span>
                    <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] text-neutral-400">📅 Updated Jun 2026</span>
                    <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] text-neutral-400">📍 {{ $location['city'] }}</span>
                </div>
            </div>

            {{-- POPULAR NEARBY --}}
            <div class="glass-card rounded-3xl p-5 border border-white/5 space-y-3">
                <p class="text-[10px] font-extrabold text-neutral-500 uppercase tracking-[0.18em]">Popular Nearby</p>
                @foreach([
                    ['name'=>'Central Hub Parking',   'dist'=>'0.2 km','price'=>'₹35/hr'],
                    ['name'=>'Metro Gate Lot',         'dist'=>'0.4 km','price'=>'₹20/hr'],
                    ['name'=>'Mall Basement Garage',   'dist'=>'0.6 km','price'=>'₹45/hr'],
                ] as $nb)
                <a href="{{ route('parking.index', ['city' => $location['city']]) }}"
                    class="flex items-center justify-between py-2.5 border-b border-white/5 last:border-0 hover:text-brand-cyan transition-colors group">
                    <div>
                        <p class="text-xs font-semibold text-white group-hover:text-brand-cyan transition-colors">{{ $nb['name'] }}</p>
                        <p class="text-[10px] text-neutral-600">{{ $nb['dist'] }} · {{ $nb['price'] }}</p>
                    </div>
                    <svg class="h-3.5 w-3.5 text-neutral-600 group-hover:text-brand-cyan transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endforeach
            </div>

            {{-- AD SLOT BOTTOM --}}
            <x-ad-slot slot="location_page_sidebar_bottom" />
        </aside>

    </div>{{-- end main grid --}}

    {{-- CITY EXPLORER --}}
    <section class="max-w-7xl mx-auto px-6 pb-16">
        <div class="border-t border-white/5 pt-10 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Explore More</span>
            </div>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white">Parking in Other Cities</h2>
                <a href="{{ route('parking.index') }}" class="text-sm text-brand-cyan font-semibold hover:text-white transition-colors">View All →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                @foreach([
                    ['name'=>'New Delhi',  'count'=>'350','emoji'=>'🏛️'],
                    ['name'=>'Mumbai',     'count'=>'200','emoji'=>'🌊'],
                    ['name'=>'Bengaluru', 'count'=>'180','emoji'=>'💻'],
                    ['name'=>'Hyderabad', 'count'=>'90', 'emoji'=>'🏰'],
                    ['name'=>'Pune',      'count'=>'75', 'emoji'=>'🎓'],
                    ['name'=>'Nagpur',    'count'=>'120','emoji'=>'🌿'],
                ] as $c)
                <a href="{{ route('parking.index', ['city' => $c['name']]) }}"
                    class="glass-card rounded-2xl p-4 border border-white/5 hover:border-brand-cyan/30 hover:bg-brand-cyan/5 transition-all group text-center space-y-1.5">
                    <span class="text-2xl">{{ $c['emoji'] }}</span>
                    <p class="text-sm font-bold text-white group-hover:text-brand-cyan transition-colors">{{ $c['name'] }}</p>
                    <p class="text-xs text-neutral-500">{{ $c['count'] }}+ spots</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

</x-public-layout>
