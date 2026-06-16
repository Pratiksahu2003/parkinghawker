@php
    $pageTitle = 'Free Public Parking Directory & Street Guidelines | ParkingHawker';
    $pageDesc  = 'Find free public parking spots, municipality street-side parking zones, and park-and-ride facilities near you. Check towing rules and hours.';
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
                '@type' => 'FAQPage',
                'mainEntity'  => [
                    ['@type' => 'Question', 'name' => 'How can I check if street parking is free and legal?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Always locate local municipality signboards. Look for white-on-blue P signs indicating free parking hours and towing warning lines.']],
                    ['@type' => 'Question', 'name' => 'Are park-and-ride metro lots free?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Some terminal station structures offer discounted or free public parking during commute hours with valid smart card metro swipes.']]
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
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.06)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-4xl mx-auto px-6 relative z-10 space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/25 text-brand-cyan text-xs font-bold uppercase tracking-wider">
                🗺️ Public Street Guides
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Free & Public <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Parking Street Guides
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Locate street-side public zones, municipality parking plots, and retail free parking spots in active cities. Avoid fines and towing.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="#rules" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    View Street Rules
                </a>
                <a href="/find-parking" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Explore Paid Garages
                </a>
            </div>
        </div>
    </section>

    <!-- Street Rules Cards -->
    <section id="rules" class="py-16 max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Smart Commuting</h2>
            <h3 class="text-3xl font-bold text-white">How to Safely Use Free Parking</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🚦', 'title' => 'Check Signboards & Markings', 'desc' => 'Inspect nearby lamp posts and pavements. Look for yellow warning stripes or municipality signs indicating towing times.'],
                ['icon' => '🚇', 'title' => 'Park & Ride Terminal Lots', 'desc' => 'Utilize terminal station structures offering free or heavily discounted parking for metro ticket holders.'],
                ['icon' => '🛒', 'title' => 'Retail & Shopping Perks', 'desc' => 'Take advantage of complimentary parking offered by mall complexes and shopping centers with store bills.']
            ] as $rule)
            <div class="glass-panel rounded-3xl p-6 space-y-3 border border-white/5">
                <span class="text-3xl block">{{ $rule['icon'] }}</span>
                <h4 class="text-lg font-bold text-white">{{ $rule['title'] }}</h4>
                <p class="text-neutral-400 text-xs leading-relaxed">{{ $rule['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Free Mid Ad Banner -->
    <div class="max-w-7xl mx-auto px-6">
        <x-ad-slot slot="free_mid_banner" class="my-8" />
    </div>

    <!-- EEAT Authoritative Section: Compliance Checklist -->
    <section class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Towing Prevention</span>
                <h3 class="text-3xl font-extrabold text-white">Legal Pavement Compliance Checklist</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Our city ops team updates street regulations weekly. Always ensure your vehicle meets these municipality guidelines before leaving it unattended.
                </p>
                <div class="space-y-3 text-xs text-neutral-400">
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Never park within 10 meters of an active street junction.</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Keep the vehicle aligned parallel to the curb, close to the edge.</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Check for local market "no parking" calendar schedules.</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6">
                <div class="glass-panel rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-white text-md">Verified User Tip</h4>
                    <p class="italic text-neutral-300 text-xs leading-relaxed">
                        "Finding free spots is tough, but using the local metro terminal station park & ride is very easy. The gates are covered and security is decent if you have a transit card."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary text-xs">S</div>
                        <div>
                            <h5 class="text-xs font-bold text-white">Siddharth Sen</h5>
                            <p class="text-[9px] text-neutral-500">Regular Transit Commuter</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Accordion -->
    <section class="py-16 max-w-4xl mx-auto px-6 space-y-8" x-data="{ open: null }">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Got Questions?</h2>
            <h3 class="text-3xl font-bold text-white">Public Parking FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'How can I check if street parking is free and legal?', 'a' => 'Always locate local municipality signboards. Look for white-on-blue P signs indicating free parking hours and towing warning lines.'],
                ['q' => 'Are park-and-ride metro lots free?', 'a' => 'Some terminal station structures offer discounted or free public parking during commute hours with valid smart card metro swipes.'],
                ['q' => 'What happens if my car gets towed from a public street?', 'a' => 'You must locate the nearest traffic police chowki or ward station to pay the fine. ParkingHawker is not liable for vehicle security or towing in public zones.'],
                ['q' => 'Is there any time limit on free parking zones?', 'a' => 'Yes, most municipal street slots limit free parking to a maximum of 2 hours during day hours (8:00 AM – 8:00 PM) to ensure rotation.']
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

    <!-- Free Bottom Ad Banner -->
    <div class="max-w-7xl mx-auto px-6 pb-12">
        <x-ad-slot slot="free_bottom_banner" class="my-8" />
    </div>
</x-public-layout>
