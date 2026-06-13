@php
    $pageTitle = 'Premium Valet Parking Services & Event Valet | ParkingHawker';
    $pageDesc  = 'Hire certified valet parking services for commercial decks, corporate events, and weddings in India. Fully insured drivers, digital ticketless key management, and 24/7 support.';
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
                'dateModified'    => now()->toAtomString(),
                'inLanguage'      => 'en-IN',
            ],
            [
                '@type' => 'Service',
                'name' => 'Premium Valet Parking Services',
                'provider' => [
                    '@type' => 'LocalBusiness',
                    'name' => 'ParkingHawker',
                    'image' => asset('logo/logo.png'),
                    'telephone' => '+91-99999-99999',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => '12th Floor, Smart Tech Tower, Connaught Place',
                        'addressLocality' => 'New Delhi',
                        'addressRegion' => 'Delhi',
                        'postalCode' => '110001',
                        'addressCountry' => 'IN'
                    ]
                ],
                'serviceType' => 'Valet Parking',
                'areaServed' => ['New Delhi', 'Mumbai', 'Bengaluru', 'Pune', 'Hyderabad'],
                'offers' => [
                    '@type' => 'Offer',
                    'priceCurrency' => 'INR',
                    'price' => '1500',
                    'description' => 'Daily / Event Valet Parking Contract'
                ]
            ],
            [
                '@type'       => 'FAQPage',
                'mainEntity'  => [
                    ['@type' => 'Question', 'name' => 'Is your valet service fully insured?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, ParkingHawker provides comprehensive commercial liability insurance up to ₹1,00,000 per vehicle covering transit and garage storage.']],
                    ['@type' => 'Question', 'name' => 'How does ticketless valet key return work?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Drivers receive a secure SMS web link upon vehicle drop-off. When ready to exit, a single tap requests the car back, showing live driver location.']],
                    ['@type' => 'Question', 'name' => 'Do you provide valet parking for private home weddings?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, we specialize in high-capacity private residential gatherings and weddings, managing complete traffic coordination and key security.']]
                ]
            ]
        ]
    ];
@endphp

<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="{{ $pageTitle }}" 
            description="{{ $pageDesc }}"
            canonical="{{ $canonUrl }}"
            :schema="$schema"
        />
        <meta name="robots" content="index, follow">
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-16 text-center space-y-4 overflow-hidden"
             style="background: linear-gradient(145deg, #04060d 0%, #0c1020 60%, #030508 100%);">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(6,182,212,0.06)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-4xl mx-auto px-6 relative z-10 space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/25 text-brand-cyan text-xs font-bold uppercase tracking-wider">
                💼 Commercial & Event Valet
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Premium Insured <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Valet Parking Logistics
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Seamless digital valet workflows for luxury venues, hotels, private weddings, and corporate summits across major Indian hubs.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="/contact" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    Get Free Quotation
                </a>
                <a href="#details" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Explore Features
                </a>
            </div>
        </div>
    </section>

    <!-- Trust Indicator Strip (EEAT) -->
    <div class="bg-white/[0.02] border-y border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-black text-white">100%</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Insured & Bonded Valets</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-cyan">15 Min</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Average Wait Time Reduction</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-purple">5,000+</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Events Serviced Annually</p>
            </div>
            <div>
                <p class="text-2xl font-black text-white">4.8 ★</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Client Satisfaction Score</p>
            </div>
        </div>
    </div>

    <!-- Core Features Grid -->
    <section id="details" class="py-16 max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Operational Excellence</h2>
            <h3 class="text-3xl font-bold text-white">Vetted Hospitality Infrastructure</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🤵', 'title' => 'Background Vetted Drivers', 'desc' => 'Every driver undergoes dynamic RTO validation, reference audits, and strict driving capability tests.'],
                ['icon' => '🛡️', 'title' => '₹1L Complete Protection', 'desc' => 'Every valet ticket is backed by our comprehensive garage liability policy covering dents and transit incidents.'],
                ['icon' => '📱', 'title' => 'Ticketless QR Returns', 'desc' => 'Drivers tap an SMS link to recall their car, preventing lobby queues and key verification delays.']
            ] as $feat)
            <div class="glass-panel rounded-3xl p-6 space-y-3 relative overflow-hidden border border-white/5">
                <span class="text-3xl block">{{ $feat['icon'] }}</span>
                <h4 class="text-lg font-bold text-white">{{ $feat['title'] }}</h4>
                <p class="text-neutral-400 text-xs leading-relaxed">{{ $feat['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- EEAT Authoritative Section -->
    <section class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Expert Leadership</span>
                <h3 class="text-3xl font-extrabold text-white">Managed by Transit Industry Experts</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Our valet divisions are supervised directly by hospitality coordinators with 15+ years of experience managing luxury vehicle portfolios for 5-star chains and diplomatic summits.
                </p>
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary">VS</div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Vikram Sen</h4>
                        <p class="text-xs text-neutral-500">Director of Hospitality Operations · Ex-Taj Hotels</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7">
                <div class="glass-panel rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-white text-md">Safety Protocols & Compliance Checks</h4>
                    <div class="space-y-3">
                        @foreach([
                            ['label' => 'Dynamic Key Cabinet Lockers', 'detail' => 'All keys stored in digital access cabinets monitored by CCTV.'],
                            ['label' => 'Real-Time Car Video Audits', 'detail' => 'Pre-existing scratches recorded on our host app before parking.'],
                            ['label' => 'Strict Breathalyzer Checks', 'detail' => 'Random daily audits for on-ground valets to ensure zero-tolerance.']
                        ] as $proto)
                        <div class="flex items-start gap-3 text-xs">
                            <span class="text-brand-cyan">✓</span>
                            <div>
                                <h5 class="font-bold text-neutral-200">{{ $proto['label'] }}</h5>
                                <p class="text-neutral-500 mt-0.5">{{ $proto['detail'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion (EEAT: Trust) -->
    <section class="py-16 max-w-4xl mx-auto px-6 space-y-8" x-data="{ open: null }">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Got Questions?</h2>
            <h3 class="text-3xl font-bold text-white">Valet Service FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Is your valet service fully insured?', 'a' => 'Yes, ParkingHawker provides comprehensive commercial liability insurance up to ₹1,00,000 per vehicle covering transit and garage storage.'],
                ['q' => 'How does ticketless valet key return work?', 'a' => 'Drivers receive a secure SMS web link upon vehicle drop-off. When ready to exit, a single tap requests the car back, showing live driver location.'],
                ['q' => 'Do you provide valet parking for private home weddings?', 'a' => 'Yes, we specialize in high-capacity private residential gatherings and weddings, managing complete traffic coordination and key security.'],
                ['q' => 'What happens if a vehicle gets damaged while with a valet?', 'a' => 'Our pre-parking inspection captures images of the car. In the rare event of on-duty damage, we initiate our direct insurance claims channel within 24 hours.']
            ] as $i => $faq)
            <div class="border border-white/8 rounded-2xl overflow-hidden hover:border-white/15 transition-colors">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                    class="w-full flex items-center justify-between p-4 text-left group">
                    <span class="text-sm font-semibold text-neutral-300 group-hover:text-white transition-colors pr-4">{{ $faq['q'] }}</span>
                    <svg class="h-4 w-4 flex-shrink-0 text-neutral-500 transition-transform duration-300"
                        :class="open === {{ $i }} ? 'rotate-180 text-brand-cyan' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open === {{ $i }}" class="px-4 pb-4 pt-1 border-t border-white/5 text-xs text-neutral-400 leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </section>

</x-public-layout>
