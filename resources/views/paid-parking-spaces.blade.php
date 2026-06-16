@php
    $pageTitle = 'Secure Paid Parking Spaces & Garages | ParkingHawker';
    $pageDesc  = 'Find premium paid parking spaces with 24/7 CCTV surveillance, automated license plate recognition gates, and Level-3 EV superchargers. Book now.';
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
                    ['@type' => 'Question', 'name' => 'What security features are standard in paid parking structures?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'All paid garages on ParkingHawker undergo strict vetting, requiring 24/7 CCTV cameras, well-lit spaces, physical guard patrols, and automated access boom gates.']],
                    ['@type' => 'Question', 'name' => 'How does license plate recognition gate access work?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'LPR cameras read your license plate upon arrival. The gate opens automatically if a valid pre-booked parking ticket matches in our database.']]
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
                🛡️ Verified Smart Decks
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Secure Premium <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Paid Parking Garages
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Compare rates, ratings, and choose commercial-grade parking garages offering state-of-the-art security, EV charging, and automated vehicle access.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="/find-parking" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    Find Secure Garages
                </a>
                <a href="/contact" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Inquire Corporate Parking
                </a>
            </div>
        </div>
    </section>

    <!-- Value Strip (EEAT) -->
    <div class="bg-white/[0.02] border-y border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-black text-white">24/7 CCTV</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Full Coverage Monitoring</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-cyan">Smart Gates</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Automated Plate Recognition</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-purple">Inspected Lots</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Every Lot Vetted On-Ground</p>
            </div>
            <div>
                <p class="text-2xl font-black text-white">Guaranteed Spot</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">No Searching on Arrival</p>
            </div>
        </div>
    </div>

    <!-- Paid Mid Ad Banner -->
    <div class="max-w-7xl mx-auto px-6">
        <x-ad-slot slot="paid_mid_banner" class="my-8" />
    </div>

    <!-- Features -->
    <section class="py-16 max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Security Vetting</h2>
            <h3 class="text-3xl font-bold text-white">State-Of-The-Art Paid Facilities</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🛡️', 'title' => 'CCTV & Guarded Access', 'desc' => 'High-resolution security cameras and on-site guards monitor vehicles constantly, delivering high safety ratings.'],
                ['icon' => '⚡', 'title' => 'EV Charging Bays', 'desc' => 'Dedicated Level-2 and Level-3 charging slots to top up your battery while parked, viewable live on the map.'],
                ['icon' => '💳', 'title' => 'Seamless Digital Checkout', 'desc' => 'Pre-pay online. Enjoy hassle-free entry and exit without queuing for cash payments at exit toll gates.']
            ] as $feat)
            <div class="glass-panel rounded-3xl p-6 space-y-3 border border-white/5">
                <span class="text-3xl block">{{ $feat['icon'] }}</span>
                <h4 class="text-lg font-bold text-white">{{ $feat['title'] }}</h4>
                <p class="text-neutral-400 text-xs leading-relaxed">{{ $feat['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- EEAT Authoritative Section: Shield Program -->
    <section class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Guaranteed Trust</span>
                <h3 class="text-3xl font-extrabold text-white">ParkingHawker Shield™ Program</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Our platform guarantees safety compliance. In the rare event of on-duty damage, we initiate our direct insurance claims channel within 24 hours.
                </p>
                <div class="space-y-3 text-xs text-neutral-400">
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Complete video verification audit before listing lots.</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>RBI-compliant Razorpay encryption for secure checkout.</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6">
                <div class="glass-panel rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-white text-md">Verified Driver Review</h4>
                    <p class="italic text-neutral-300 text-xs leading-relaxed">
                        "I regularly park my luxury sedan at the ParkingHawker verified garage in CP. Excellent security, well-lit spaces, and automated access works perfectly every single time."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary text-xs">M</div>
                        <div>
                            <h5 class="text-xs font-bold text-white">Manish Malhotra</h5>
                            <p class="text-[9px] text-neutral-500">Premium Commuter</p>
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
            <h3 class="text-3xl font-bold text-white">Paid Parking FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'What security features are standard in paid parking structures?', 'a' => 'All paid garages on ParkingHawker undergo strict vetting, requiring 24/7 CCTV cameras, well-lit spaces, physical guard patrols, and automated access boom gates.'],
                ['q' => 'How does license plate recognition gate access work?', 'a' => 'LPR cameras read your license plate upon arrival. The gate opens automatically if a valid pre-booked parking ticket matches in our database.'],
                ['q' => 'Can I reserve a paid parking spot overnight?', 'a' => 'Yes. Select facilities offer overnight and 24/7 multi-day parking slots. Check the specific lot rules in the search listing prior to booking.'],
                ['q' => 'What forms of payments are accepted?', 'a' => 'We support secure online payment via Credit/Debit Cards, UPI, Netbanking, and popular digital wallets.']
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

    <!-- Paid Bottom Ad Banner -->
    <div class="max-w-7xl mx-auto px-6 pb-12">
        <x-ad-slot slot="paid_bottom_banner" class="my-8" />
    </div>
</x-public-layout>
