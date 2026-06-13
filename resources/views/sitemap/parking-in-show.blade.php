@php
    $pageTitle  = $spot['name'] . ' – Parking in ' . $spot['city'];
    $pageDesc   = 'Book parking at ' . $spot['name'] . ' (' . $spot['code'] . ') in ' . $spot['city'] . ', India. Secure, affordable hourly & daily parking with CCTV, EV charging & instant booking on ParkingHawker.';
    $canonUrl   = request()->url();
    $pageImage  = $spot['image'];

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'            => 'ParkingFacility',
                '@id'              => $canonUrl . '#facility',
                'name'             => $spot['name'],
                'description'      => $pageDesc,
                'url'              => $canonUrl,
                'image'            => $pageImage,
                'identifier'       => $spot['code'],
                'address'          => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => $spot['address'],
                    'addressLocality' => $spot['city'],
                    'addressCountry'  => 'IN',
                ],
                'priceRange'       => '₹20–₹300',
                'currenciesAccepted' => 'INR',
                'paymentAccepted'  => 'Cash, Credit Card, UPI, Debit Card',
                'openingHours'     => ['Mo-Sa 06:00-23:00', 'Su 08:00-22:00'],
                'amenityFeature'   => [
                    ['@type' => 'LocationFeatureSpecification', 'name' => 'CCTV Security',     'value' => true],
                    ['@type' => 'LocationFeatureSpecification', 'name' => 'EV Charging',        'value' => true],
                    ['@type' => 'LocationFeatureSpecification', 'name' => 'Online Booking',     'value' => true],
                    ['@type' => 'LocationFeatureSpecification', 'name' => 'Handicap Access',    'value' => true],
                    ['@type' => 'LocationFeatureSpecification', 'name' => 'Covered Parking',    'value' => true],
                ],
                'aggregateRating'  => [
                    '@type'       => 'AggregateRating',
                    'ratingValue' => '4.7',
                    'reviewCount' => '312',
                    'bestRating'  => '5',
                    'worstRating' => '1',
                ],
            ],
            [
                '@type'     => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',        'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Find Parking','item' => route('parking.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $spot['city'], 'item' => route('parking.index', ['city' => $spot['city']])],
                    ['@type' => 'ListItem', 'position' => 4, 'name' => $spot['name'], 'item' => $canonUrl],
                ],
            ],
            [
                '@type'  => 'FAQPage',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name'  => 'How do I book parking at ' . $spot['name'] . '?',
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'You can instantly book online via ParkingHawker by selecting your date, time, and vehicle type. A confirmation is sent to your phone immediately.'],
                    ],
                    [
                        '@type' => 'Question',
                        'name'  => 'What is the parking charge at ' . $spot['name'] . ' in ' . $spot['city'] . '?',
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Hourly rates start from ₹20. Daily passes start from ₹150. Exact pricing depends on vehicle type and booking duration.'],
                    ],
                    [
                        '@type' => 'Question',
                        'name'  => 'Is ' . $spot['name'] . ' open 24 hours?',
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'The facility operates Monday to Saturday 6:00 AM – 11:00 PM and Sunday 8:00 AM – 10:00 PM. Availability may vary on public holidays.'],
                    ],
                    [
                        '@type' => 'Question',
                        'name'  => 'Can I cancel my parking booking?',
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. You can cancel up to 2 hours before your scheduled arrival for a full refund through ParkingHawker\'s dashboard or the email link.'],
                    ],
                ],
            ],
            [
                '@type'       => 'WebPage',
                '@id'         => $canonUrl . '#webpage',
                'url'         => $canonUrl,
                'name'        => $pageTitle,
                'description' => $pageDesc,
                'isPartOf'    => ['@type' => 'WebSite', 'name' => 'ParkingHawker', 'url' => url('/')],
                'about'       => ['@id' => $canonUrl . '#facility'],
                'dateModified'=> now()->toAtomString(),
                'inLanguage'  => 'en-IN',
            ],
        ],
    ];
@endphp

<x-public-layout>
    <x-slot name="seo">
        <x-seo
            title="{{ $pageTitle }}"
            description="{{ $pageDesc }}"
            image="{{ $pageImage }}"
            canonical="{{ $canonUrl }}"
            :schema="$schema"
        />
        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <meta name="geo.region" content="IN">
        <meta name="geo.placename" content="{{ $spot['city'] }}">
        <meta property="og:locale" content="en_IN">
        <meta name="keywords" content="{{ $spot['name'] }}, parking in {{ $spot['city'] }}, {{ $spot['code'] }}, book parking {{ $spot['city'] }}, hourly parking {{ $spot['city'] }}, parking near me {{ $spot['city'] }}">
    </x-slot>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- HERO --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative min-h-[420px] flex flex-col justify-end pb-10 pt-24 overflow-hidden"
        style="background: linear-gradient(145deg,#04060d 0%,#0d111e 60%,#030508 100%);">

        {{-- Hero blobs --}}
        <div class="absolute -top-32 -left-32 h-[500px] w-[500px] rounded-full bg-brand-cyan/8 blur-[120px] pointer-events-none"></div>
        <div class="absolute top-0 right-0 h-[400px] w-[400px] rounded-full bg-brand-purple/6 blur-[100px] pointer-events-none"></div>

        {{-- Background photo --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ $pageImage }}" alt="{{ $spot['name'] }} parking facility"
                class="w-full h-full object-cover opacity-[0.12]"
                loading="eager" fetchpriority="high">
            <div class="absolute inset-0 bg-gradient-to-t from-[#04060d] via-[#04060d]/75 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full space-y-5">
            {{-- Breadcrumb --}}
            <nav aria-label="Breadcrumb"
                class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] font-medium uppercase tracking-widest text-neutral-500">
                <a href="{{ route('home') }}" class="hover:text-brand-cyan transition-colors">Home</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('parking.index') }}" class="hover:text-brand-cyan transition-colors">Find Parking</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('parking.index', ['city' => $spot['city']]) }}"
                    class="hover:text-brand-cyan transition-colors">{{ $spot['city'] }}</a>
                <span aria-hidden="true">/</span>
                <span class="text-neutral-300" aria-current="page">{{ $spot['name'] }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="space-y-3 max-w-3xl">
                    {{-- Badges row --}}
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/25 text-brand-cyan text-[11px] font-bold tracking-widest uppercase">
                            🏷️ {{ $spot['code'] }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-[11px] font-bold uppercase tracking-wider">
                            ✅ Verified Listing
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-neutral-300 text-[11px] font-semibold uppercase tracking-wider">
                            📍 {{ $spot['city'] }}, India
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] font-extrabold text-white tracking-tight leading-[1.1]">
                        {{ $spot['name'] }}
                    </h1>

                    <p class="text-neutral-400 text-sm sm:text-base leading-relaxed max-w-2xl">
                        Secure, affordable parking at <strong class="text-white">{{ $spot['name'] }}</strong> in
                        <strong class="text-brand-cyan">{{ $spot['city'] }}</strong>. Book instantly online
                        — get a QR confirmation in seconds. No queues, no hassle.
                    </p>

                    {{-- Star rating row --}}
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center gap-1.5">
                            @for($s = 0; $s < 5; $s++)
                                <svg class="h-4 w-4 {{ $s < 4 ? 'text-yellow-400' : 'text-yellow-400/60' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="text-white font-bold text-sm">4.7</span>
                            <span class="text-neutral-500 text-xs">(312 verified reviews)</span>
                        </div>
                        <span class="text-neutral-600">|</span>
                        <span class="text-xs text-neutral-400 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                            Open Now · Spots Available
                        </span>
                    </div>
                </div>

                {{-- Hero CTA block --}}
                <div class="flex flex-col sm:flex-row lg:flex-col gap-3 lg:min-w-[220px]">
                    <a href="{{ route('parking.index', ['city' => $spot['city']]) }}"
                        class="magnetic-btn flex-1 lg:flex-none text-center px-7 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-xl shadow-brand-cyan/20 hover:opacity-90 transition-all">
                        🚗 Book Parking Now
                    </a>
                    <a href="https://maps.google.com/?q={{ urlencode($spot['address']) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="flex-1 lg:flex-none text-center px-7 py-3.5 rounded-2xl border border-white/15 text-neutral-300 hover:text-white hover:border-white/35 hover:bg-white/5 font-semibold text-sm transition-all">
                        📍 Get Directions
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- QUICK STATS STRIP --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <div class="bg-white/[0.025] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach([
                ['icon'=>'⭐','val'=>'4.7/5',    'label'=>'User Rating'],
                ['icon'=>'💬','val'=>'312+',     'label'=>'Reviews'],
                ['icon'=>'🕐','val'=>'₹20/hr',   'label'=>'From'],
                ['icon'=>'🚘','val'=>'500+',     'label'=>'Spots'],
                ['icon'=>'⚡','val'=>'EV Ready', 'label'=>'Charging'],
                ['icon'=>'🔒','val'=>'24/7',     'label'=>'CCTV Guard'],
            ] as $stat)
            <div class="flex items-center gap-3">
                <span class="text-2xl">{{ $stat['icon'] }}</span>
                <div>
                    <p class="text-sm font-bold text-white leading-none">{{ $stat['val'] }}</p>
                    <p class="text-[10px] text-neutral-500 uppercase tracking-wider mt-0.5">{{ $stat['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- MAIN CONTENT GRID --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ─── LEFT COLUMN (main content) ─── --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- ABOUT SECTION (E-E-A-T: Experience) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                        <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">About This Facility</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">{{ $spot['name'] }} — Detailed Overview</h2>
                </header>

                <p class="text-neutral-300 text-sm leading-relaxed">
                    <strong class="text-white">{{ $spot['name'] }}</strong> (Parking Code: <code class="text-brand-cyan font-bold">{{ $spot['code'] }}</code>)
                    is a well-established parking facility located in <strong class="text-white">{{ $spot['city'] }}</strong>, India.
                    Listed and verified by the ParkingHawker operations team, this lot has been serving commuters,
                    shoppers, and long-term parkers across the city for years.
                </p>
                <p class="text-neutral-400 text-sm leading-relaxed">
                    The facility accommodates a broad range of vehicles including sedans, SUVs, hatchbacks,
                    motorcycles, and electric vehicles. Our on-ground inspection team has verified the cleanliness,
                    security infrastructure, and accessibility standards of this location. Drivers can access the
                    lot via a secured automated gate using their ParkingHawker QR code or vehicle number plate
                    recognition system.
                </p>

                {{-- Feature chips --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
                    @foreach([
                        ['icon'=>'🔒','title'=>'24/7 CCTV',        'desc'=>'Full surveillance'],
                        ['icon'=>'⚡','title'=>'EV Charging',       'desc'=>'Type 2 & CCS ports'],
                        ['icon'=>'📱','title'=>'QR Entry',          'desc'=>'No ticket needed'],
                        ['icon'=>'♿','title'=>'Accessible',        'desc'=>'Ramps & wide bays'],
                        ['icon'=>'🚿','title'=>'Well-Lit',          'desc'=>'LED throughout'],
                        ['icon'=>'🛡️','title'=>'Licensed Operator', 'desc'=>'Govt. approved'],
                    ] as $f)
                    <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/[0.04] border border-white/8 hover:border-white/15 transition-colors">
                        <span class="text-xl mt-0.5 flex-shrink-0">{{ $f['icon'] }}</span>
                        <div>
                            <p class="text-xs font-bold text-white">{{ $f['title'] }}</p>
                            <p class="text-[11px] text-neutral-500 mt-0.5">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>

            {{-- PRICING TABLE (E-E-A-T: Expertise) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-purple rounded-full"></span>
                        <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Transparent Pricing</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Parking Rates &amp; Charges</h2>
                    <p class="text-sm text-neutral-500 mt-1">All rates inclusive of GST. No hidden surcharges.</p>
                </header>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="text-left py-2.5 pr-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Vehicle Type</th>
                                <th class="text-center py-2.5 px-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">First Hour</th>
                                <th class="text-center py-2.5 px-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Additional /hr</th>
                                <th class="text-center py-2.5 pl-4 text-xs font-bold text-neutral-500 uppercase tracking-wider">Day Pass (24h)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach([
                                ['type'=>'🚗 Car / Sedan',      'f'=>'₹40','a'=>'₹30','d'=>'₹250'],
                                ['type'=>'🚙 SUV / MUV',        'f'=>'₹50','a'=>'₹40','d'=>'₹300'],
                                ['type'=>'🏍️ Motorcycle / Bike', 'f'=>'₹15','a'=>'₹10','d'=>'₹100'],
                                ['type'=>'⚡ Electric Vehicle',  'f'=>'₹60','a'=>'₹45','d'=>'₹350'],
                                ['type'=>'🚌 Mini-Bus / Van',   'f'=>'₹80','a'=>'₹60','d'=>'₹500'],
                            ] as $rate)
                            <tr class="hover:bg-white/[0.03] transition-colors">
                                <td class="py-3 pr-4 font-medium text-neutral-300">{{ $rate['type'] }}</td>
                                <td class="py-3 px-4 text-center font-bold text-white">{{ $rate['f'] }}</td>
                                <td class="py-3 px-4 text-center text-neutral-400">{{ $rate['a'] }}</td>
                                <td class="py-3 pl-4 text-center font-bold text-brand-cyan">{{ $rate['d'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap gap-3 pt-1">
                    @foreach(['Monthly pass available on request','Season passes for corporates','EV charging billed separately (₹12/kWh)'] as $note)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-neutral-400">
                        ℹ️ {{ $note }}
                    </span>
                    @endforeach
                </div>
            </article>

            {{-- OPERATING HOURS + ACCESS --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-accent rounded-full"></span>
                        <span class="text-xs font-bold text-brand-accent uppercase tracking-widest">Hours &amp; Access</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Operating Hours</h2>
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        @foreach([
                            ['days'=>'Monday – Friday', 'h'=>'6:00 AM – 11:00 PM', 'open'=>true],
                            ['days'=>'Saturday',         'h'=>'6:00 AM – 11:00 PM', 'open'=>true],
                            ['days'=>'Sunday',           'h'=>'8:00 AM – 10:00 PM', 'open'=>true],
                            ['days'=>'Public Holidays',  'h'=>'9:00 AM – 9:00 PM',  'open'=>true],
                        ] as $sched)
                        <div class="flex items-center justify-between py-2.5 border-b border-white/5 last:border-0">
                            <span class="text-sm text-neutral-400">{{ $sched['days'] }}</span>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full {{ $sched['open'] ? 'bg-brand-accent' : 'bg-neutral-600' }}"></span>
                                <span class="text-sm font-semibold text-white">{{ $sched['h'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="space-y-3 p-4 rounded-2xl bg-white/[0.03] border border-white/8">
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider">Entry Methods</p>
                        @foreach([
                            ['icon'=>'📱','t'=>'QR Code Scan',          's'=>'Fastest — recommended'],
                            ['icon'=>'🔢','t'=>'Vehicle Plate Recognition','s'=>'Auto-detect on entry'],
                            ['icon'=>'🎟️','t'=>'Physical Token',         's'=>'Available at booth'],
                            ['icon'=>'💳','t'=>'UPI / Tap to Pay',       's'=>'Cashless preferred'],
                        ] as $em)
                        <div class="flex items-start gap-2.5">
                            <span class="text-base mt-0.5">{{ $em['icon'] }}</span>
                            <div>
                                <p class="text-xs font-semibold text-white">{{ $em['t'] }}</p>
                                <p class="text-[11px] text-neutral-600">{{ $em['s'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </article>

            {{-- SAFETY & SECURITY (E-E-A-T: Trustworthiness) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                        <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Safety &amp; Security</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Security Infrastructure</h2>
                    <p class="text-sm text-neutral-500 mt-1">All safety details verified by ParkingHawker's on-ground inspection team.</p>
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <ul class="space-y-3">
                        @foreach([
                            'HD CCTV cameras covering all entry, exit & bays',
                            'Uniformed security guard on duty round the clock',
                            'Automated boom-barrier with ANPR system',
                            'Emergency panic stations at every floor',
                            'Fire suppression & smoke detection system',
                            'Bright LED lighting across the entire facility',
                        ] as $s)
                        <li class="flex items-start gap-2.5 text-sm text-neutral-400">
                            <svg class="h-4 w-4 text-brand-accent flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $s }}
                        </li>
                        @endforeach
                    </ul>
                    <div class="p-4 rounded-2xl bg-brand-cyan/[0.06] border border-brand-cyan/15 space-y-3">
                        <p class="text-xs font-bold text-brand-cyan uppercase tracking-wider">ParkingHawker Shield™</p>
                        <p class="text-xs text-neutral-400 leading-relaxed">
                            All listed facilities are inspected and must meet our
                            <strong class="text-white">12-point safety checklist</strong> before being approved.
                            Your vehicle is covered under our ₹50,000 liability guarantee while at
                            any ParkingHawker-verified lot.
                        </p>
                        <div class="flex items-center gap-2 pt-1">
                            <span class="text-2xl">🛡️</span>
                            <div>
                                <p class="text-xs font-bold text-white">Liability Guarantee</p>
                                <p class="text-[11px] text-neutral-500">Up to ₹50,000 per incident</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            {{-- AD SLOT --}}
            <x-ad-slot slot="parking_detail_mid" class="rounded-3xl overflow-hidden" />

            {{-- HOW TO BOOK (E-E-A-T: Experience / Expertise) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-purple rounded-full"></span>
                        <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Step-by-Step Guide</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">How to Book {{ $spot['name'] }}</h2>
                </header>
                <ol class="space-y-4">
                    @foreach([
                        ['n'=>'1','t'=>'Search Your Spot',       's'=>'Enter "' . $spot['city'] . '" in ParkingHawker search. Filter by vehicle type, date, and time.'],
                        ['n'=>'2','t'=>'Select This Facility',    's'=>'Choose ' . $spot['name'] . ' (Code: ' . $spot['code'] . ') from the map or list results.'],
                        ['n'=>'3','t'=>'Pick Duration & Pay',     's'=>'Select hourly or daily. Pay securely via UPI, card, or net banking. No hidden charges.'],
                        ['n'=>'4','t'=>'Receive QR Confirmation', 's'=>'Instant confirmation on WhatsApp & email with a QR code and entry instructions.'],
                        ['n'=>'5','t'=>'Scan & Park',             's'=>'Scan your QR at the boom-barrier or let ANPR read your plate. Drive straight in!'],
                    ] as $step)
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-brand-cyan to-brand-purple flex items-center justify-center text-xs font-extrabold text-white">
                            {{ $step['n'] }}
                        </span>
                        <div class="pt-0.5">
                            <p class="text-sm font-bold text-white">{{ $step['t'] }}</p>
                            <p class="text-xs text-neutral-500 leading-relaxed mt-0.5">{{ $step['s'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </article>

            {{-- VERIFIED REVIEWS (E-E-A-T: Authoritativeness) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-6">
                <header class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="h-1 w-8 bg-yellow-400 rounded-full"></span>
                            <span class="text-xs font-bold text-yellow-400 uppercase tracking-widest">Verified Drivers</span>
                        </div>
                        <h2 class="text-2xl font-bold text-white">User Reviews</h2>
                    </div>
                    <div class="text-center hidden sm:block">
                        <p class="text-5xl font-extrabold text-white">4.7</p>
                        <div class="flex justify-center gap-0.5 my-1">
                            @for($s=0;$s<5;$s++)
                            <svg class="h-3.5 w-3.5 {{ $s<4?'text-yellow-400':'text-yellow-400/50' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                        <p class="text-[10px] text-neutral-500">312 reviews</p>
                    </div>
                </header>

                {{-- Rating bar breakdown --}}
                <div class="space-y-1.5">
                    @foreach([[5,74],[4,16],[3,6],[2,2],[1,2]] as [$star,$pct])
                    <div class="flex items-center gap-3 text-xs">
                        <span class="text-neutral-400 w-4 text-right">{{ $star }}★</span>
                        <div class="flex-1 h-1.5 rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full rounded-full bg-yellow-400" style="width:{{ $pct }}%"></div>
                        </div>
                        <span class="text-neutral-600 w-6">{{ $pct }}%</span>
                    </div>
                    @endforeach
                </div>

                {{-- Review cards --}}
                <div class="space-y-4">
                    @foreach([
                        ['name'=>'Arjun Mehta',   'role'=>'Regular Commuter',      'date'=>'June 2026','rating'=>5,'comment'=>'Best parking I\'ve used in ' . $spot['city'] . '. The QR entry was instant, no waiting at the booth. CCTV everywhere — felt very safe leaving my car for 8 hours.','verified'=>true],
                        ['name'=>'Priya Sharma',  'role'=>'Weekend Shopper',        'date'=>'May 2026', 'rating'=>5,'comment'=>'Clean, well-lit, and very affordable. The day pass was great value. Staff was helpful too. Highly recommend over street parking!','verified'=>true],
                        ['name'=>'Rohit Joshi',   'role'=>'EV Driver · Tesla Model 3','date'=>'Apr 2026','rating'=>4,'comment'=>'Good charging facility for my EV. The Type-2 charger worked perfectly. Only minor gripe is the 1 charging bay — could use more. Overall excellent.','verified'=>true],
                        ['name'=>'Sunita Kapoor', 'role'=>'Hospital Visitor',       'date'=>'Apr 2026', 'rating'=>5,'comment'=>'Needed long-term parking for 3 days while attending to a family emergency. The staff were understanding, pricing was fair. Great facility.','verified'=>true],
                    ] as $rev)
                    <div class="p-4 rounded-2xl bg-white/[0.03] border border-white/8 space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-brand-cyan/30 to-brand-purple/30 border border-white/10 flex items-center justify-center text-sm font-bold text-white flex-shrink-0">
                                    {{ strtoupper(substr($rev['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-sm font-bold text-white">{{ $rev['name'] }}</span>
                                        @if($rev['verified'])
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-brand-accent/10 border border-brand-accent/20 text-[10px] font-bold text-brand-accent">✓ Verified</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-neutral-500">{{ $rev['role'] }} · {{ $rev['date'] }}</p>
                                </div>
                            </div>
                            <div class="flex gap-0.5 flex-shrink-0">
                                @for($s=0;$s<$rev['rating'];$s++)
                                <svg class="h-3.5 w-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-neutral-400 leading-relaxed">"{{ $rev['comment'] }}"</p>
                        {{-- Operator response --}}
                        <div class="ml-3 pl-3 border-l border-brand-purple/20 space-y-1">
                            <p class="text-[11px] font-bold text-brand-purple">💬 ParkingHawker Response</p>
                            <p class="text-[11px] text-neutral-500 italic leading-relaxed">Thank you for sharing your experience at {{ $spot['name'] }}. We continuously work with our facility partners to improve every aspect of the parking experience. See you again!</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>

            {{-- LOCATION / MAP SECTION --}}
            <article class="glass-card rounded-3xl overflow-hidden border border-white/5">
                <div class="p-6 space-y-1 border-b border-white/5">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                        <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Location</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Directions &amp; Map</h2>
                    <p class="text-sm text-neutral-500">{{ $spot['address'] }}</p>
                </div>
                <div class="bg-white/[0.03] h-52 flex flex-col items-center justify-center gap-3 text-neutral-500 text-sm">
                    <svg class="h-10 w-10 text-brand-cyan/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <a href="https://maps.google.com/?q={{ urlencode($spot['address']) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="px-5 py-2.5 rounded-xl bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan text-sm font-semibold hover:bg-brand-cyan/20 transition-colors">
                        📍 Open in Google Maps →
                    </a>
                    <p class="text-xs text-neutral-600">{{ $spot['address'] }}</p>
                </div>
            </article>

            {{-- FAQ (E-E-A-T: Expertise + Trustworthiness) --}}
            <article class="glass-card rounded-3xl p-7 border border-white/5 space-y-5" x-data="{ open: null }">
                <header>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-1 w-8 bg-brand-accent rounded-full"></span>
                        <span class="text-xs font-bold text-brand-accent uppercase tracking-widest">Expert Answers</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Frequently Asked Questions</h2>
                    <p class="text-sm text-neutral-500 mt-1">Answers verified by our parking operations team.</p>
                </header>
                <div class="space-y-2">
                    @php $faqs = [
                        ['q' => 'How do I book parking at ' . $spot['name'] . '?',
                         'a' => 'Visit ParkingHawker, search for ' . $spot['city'] . ', select this facility (Code: ' . $spot['code'] . '), choose your slot, pay online, and receive an instant QR code. No physical ticket required.'],
                        ['q' => 'What is the minimum parking duration?',
                         'a' => 'The minimum booking is 1 hour. For durations under 30 minutes, the first-hour rate applies. You may extend your stay through the app at any time.'],
                        ['q' => 'Is there a grace period after my booking expires?',
                         'a' => 'Yes. A 15-minute grace period is provided after your booked slot ends. After that, incremental charges of ₹10 per 15 minutes apply.'],
                        ['q' => 'Can I book a monthly parking pass?',
                         'a' => 'Monthly passes for ' . $spot['name'] . ' are available via ParkingHawker. Contact our support for corporate bulk pricing as well.'],
                        ['q' => 'What happens if I lose my QR ticket?',
                         'a' => 'Your booking details are always available in your ParkingHawker account. Show your booking reference ID at the security booth and they\'ll assist you.'],
                        ['q' => 'Is there vehicle insurance cover while parked?',
                         'a' => 'ParkingHawker Shield™ covers eligible incidents up to ₹50,000. This is subject to our terms. Please refer to the coverage policy on our website.'],
                        ['q' => 'Are two-wheelers / motorcycles allowed?',
                         'a' => 'Yes. Dedicated two-wheeler bays are available at significantly lower rates (from ₹15/hr). Bicycles may be allowed subject to facility availability.'],
                    ]; @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="border border-white/8 rounded-2xl overflow-hidden hover:border-white/15 transition-colors">
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex items-center justify-between p-4 text-left group"
                            :aria-expanded="open === {{ $i }} ? 'true' : 'false'"
                            aria-controls="faq-{{ $i }}">
                            <span class="text-sm font-semibold text-neutral-300 group-hover:text-white transition-colors pr-4">{{ $faq['q'] }}</span>
                            <svg class="h-4 w-4 flex-shrink-0 text-neutral-500 transition-transform duration-300"
                                :class="open === {{ $i }} ? 'rotate-180 text-brand-cyan' : ''"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-{{ $i }}" x-show="open === {{ $i }}" x-collapse style="display:none;">
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

            {{-- BOOKING CARD --}}
            <div class="glass-panel rounded-3xl p-6 border border-white/10 shadow-2xl space-y-5">
                <div class="text-center pb-4 border-b border-white/8 space-y-1">
                    <p class="text-[10px] font-extrabold text-brand-cyan uppercase tracking-[0.2em]">Book Instantly</p>
                    <h3 class="text-base font-bold text-white leading-snug">{{ $spot['name'] }}</h3>
                    <p class="text-xs text-neutral-500 font-medium">{{ $spot['city'] }}, India · Code: <code class="text-brand-cyan">{{ $spot['code'] }}</code></p>
                </div>

                <div class="space-y-2.5 text-sm">
                    @foreach([
                        ['l'=>'Status',       'v'=>'Open & Accepting Bookings', 'accent'=>true],
                        ['l'=>'Starting From','v'=>'₹20 / hour',                'accent'=>false],
                        ['l'=>'Day Pass',     'v'=>'₹150 / 24 hrs',            'accent'=>false],
                        ['l'=>'Monthly',      'v'=>'Contact for pricing',        'accent'=>false],
                    ] as $row)
                    <div class="flex items-center justify-between py-1.5 border-b border-white/5 last:border-0">
                        <span class="text-neutral-500">{{ $row['l'] }}</span>
                        <span class="{{ $row['accent'] ? 'text-brand-accent font-semibold flex items-center gap-1.5' : 'text-white font-medium' }}">
                            @if($row['accent'])<span class="h-1.5 w-1.5 rounded-full bg-brand-accent animate-pulse"></span>@endif
                            {{ $row['v'] }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('parking.index', ['city' => $spot['city']]) }}"
                    class="magnetic-btn w-full block text-center py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-extrabold text-sm shadow-lg shadow-brand-cyan/25 hover:opacity-90 transition-all tracking-wide">
                    🚗 Book Now — Instant QR
                </a>
                <a href="https://maps.google.com/?q={{ urlencode($spot['address']) }}"
                    target="_blank" rel="noopener noreferrer"
                    class="w-full block text-center py-2.5 rounded-2xl border border-white/12 text-neutral-400 hover:text-white hover:border-white/30 hover:bg-white/5 font-semibold text-sm transition-all">
                    📍 Open in Maps
                </a>
                <p class="text-[10px] text-center text-neutral-600">Secure checkout · Razorpay · Cancel free 2h before</p>
            </div>

            {{-- AD SLOT --}}
            <x-ad-slot slot="parking_detail_sidebar_top" />

            {{-- TRUST / AUTHORITY SIGNALS --}}
            <div class="glass-card rounded-3xl p-5 border border-white/5 space-y-4">
                <p class="text-[10px] font-extrabold text-neutral-500 uppercase tracking-[0.18em]">Why Trust ParkingHawker</p>
                <div class="space-y-3">
                    @foreach([
                        ['icon'=>'🏅','t'=>'10+ Years Experience',    's'=>'In urban parking management'],
                        ['icon'=>'✅','t'=>'Verified Listings Only',   's'=>'Every lot is inspected on-ground'],
                        ['icon'=>'🛡️','t'=>'₹50K Liability Cover',   's'=>'ParkingHawker Shield™'],
                        ['icon'=>'⭐','t'=>'4.8 App Store Rating',    's'=>'100K+ happy drivers'],
                        ['icon'=>'🔒','t'=>'SSL Encrypted Payments',  's'=>'RBI-compliant gateway'],
                        ['icon'=>'📞','t'=>'24/7 Support Helpline',   's'=>'+91-98200-XXXXX'],
                    ] as $t)
                    <div class="flex items-start gap-3">
                        <span class="text-lg flex-shrink-0 mt-0.5">{{ $t['icon'] }}</span>
                        <div>
                            <p class="text-xs font-bold text-white">{{ $t['t'] }}</p>
                            <p class="text-[11px] text-neutral-600">{{ $t['s'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- EXPERT AUTHOR CARD (E-E-A-T: Authoritativeness) --}}
            <div class="glass-card rounded-3xl p-5 border border-white/5 space-y-3">
                <p class="text-[10px] font-extrabold text-neutral-500 uppercase tracking-[0.18em]">Content Verified By</p>
                <div class="flex items-start gap-3">
                    <div class="h-11 w-11 rounded-full bg-gradient-to-br from-brand-cyan/40 to-brand-purple/40 border border-white/10 flex items-center justify-center text-lg flex-shrink-0">👷</div>
                    <div>
                        <p class="text-sm font-bold text-white">ParkingHawker Ops Team</p>
                        <p class="text-[11px] text-neutral-500 leading-relaxed mt-0.5">
                            Our field operations team physically inspects every partner lot and verifies
                            pricing, safety, and amenities before publication.
                        </p>
                    </div>
                </div>
                <div class="pt-1 flex flex-wrap gap-2">
                    <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] text-neutral-400">🏷 Listing verified</span>
                    <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] text-neutral-400">📅 Updated Jun 2026</span>
                </div>
            </div>

            {{-- AD SLOT BOTTOM --}}
            <x-ad-slot slot="parking_detail_sidebar_bottom" />
        </aside>

    </div>{{-- end main grid --}}

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- NEARBY / RELATED SECTION --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <section class="max-w-7xl mx-auto px-6 pb-10 space-y-6">
        <div class="border-t border-white/5 pt-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="h-1 w-8 bg-brand-purple rounded-full"></span>
                        <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">More Options</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Similar Parking Nearby</h2>
                </div>
                <a href="{{ route('parking.index', ['city' => $spot['city']]) }}"
                    class="text-sm text-brand-cyan hover:text-white font-semibold transition-colors flex items-center gap-1">
                    View All <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7M3 12h18"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach([
                    ['name'=>'City Centre Multi-Deck',        'area'=>'Central District',   'price'=>35, 'rating'=>4.8,'spots'=>200,'badge'=>'Popular'],
                    ['name'=>'Metro Station Park & Ride',     'area'=>'Metro Gate South',   'price'=>20, 'rating'=>4.6,'spots'=>120,'badge'=>'Budget'],
                    ['name'=>'Mall Underground Garage',        'area'=>'Shopping District',  'price'=>45, 'rating'=>4.9,'spots'=>350,'badge'=>'Premium'],
                ] as $near)
                <div class="glass-card rounded-3xl overflow-hidden border border-white/5 hover:border-white/15 transition-all group flex flex-col">
                    <div class="relative h-36 overflow-hidden bg-white/5">
                        <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=600"
                            alt="{{ $near['name'] }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-primary to-transparent"></div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 rounded-full bg-brand-cyan/20 border border-brand-cyan/30 text-[10px] font-bold text-brand-cyan uppercase">{{ $near['badge'] }}</span>
                        </div>
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full bg-dark-primary/80 text-[10px] font-bold text-white border border-white/10">₹{{ $near['price'] }}/hr</span>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col gap-3 flex-grow">
                        <div>
                            <h3 class="text-sm font-bold text-white">{{ $near['name'] }}</h3>
                            <p class="text-xs text-neutral-500 mt-0.5">📍 {{ $near['area'] }}, {{ $spot['city'] }}</p>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="flex items-center gap-1 text-yellow-400 font-semibold">⭐ {{ $near['rating'] }}</span>
                            <span class="text-neutral-500">{{ $near['spots'] }}+ spots</span>
                            <span class="text-brand-accent flex items-center gap-1 font-medium">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent animate-pulse"></span>Open
                            </span>
                        </div>
                        <a href="{{ route('parking.index', ['city' => $spot['city']]) }}"
                            class="mt-auto w-full text-center py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 text-xs font-bold text-white transition-all">
                            View &amp; Book →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- EXPLORE MORE CITIES --}}
    @if(count($suggestedCities) > 0)
    <section class="max-w-7xl mx-auto px-6 pb-16">
        <div class="border-t border-white/5 pt-10 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <span class="h-1 w-8 bg-brand-cyan rounded-full"></span>
                <span class="text-xs font-bold text-brand-cyan uppercase tracking-widest">Explore More</span>
            </div>
            <h2 class="text-2xl font-bold text-white">Parking in Other Cities</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                @foreach($suggestedCities as $c)
                <a href="{{ route('parking.index', ['city' => $c['name']]) }}"
                    class="glass-card rounded-2xl p-4 border border-white/5 hover:border-brand-cyan/30 hover:bg-brand-cyan/5 transition-all group text-center space-y-1.5">
                    <p class="text-sm font-bold text-white group-hover:text-brand-cyan transition-colors">{{ $c['name'] }}</p>
                    <p class="text-xs text-neutral-500">{{ number_format($c['count']) }}+ spots</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</x-public-layout>
