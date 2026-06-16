@php
    $pageTitle = 'Event Parking Spaces & Venue Parking | ParkingHawker';
    $pageDesc  = 'Reserve guaranteed parking spots near stadiums, theaters, concert halls, and wedding banquet zones in major cities. Beat the rush with fast lane entry.';
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
                    ['@type' => 'Question', 'name' => 'Can I reserve parking for stadium concerts in advance?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, ParkingHawker allows event parking reservations up to 30 days in advance, securing your spot near the main gates.']],
                    ['@type' => 'Question', 'name' => 'Do you offer group parking bookings for corporate seminars?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, corporate coordinators can book multiple spots or reserve entire levels for seminars and banquets through our corporate contact line.']]
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
                🏟️ Arena & Concert Parking
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Reserved Venue & <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Event Parking Decks
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Skip the gate lines. Book pre-authorized event parking slots near major sports stadiums, music arenas, banquet halls, and convention centers.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="/find-parking" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    Find Event Parking
                </a>
                <a href="/contact" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Inquire Mass Banquet Parking
                </a>
            </div>
        </div>
    </section>

    <!-- Value Stats (EEAT) -->
    <div class="bg-white/[0.02] border-y border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-black text-white">Guaranteed Spot</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Even during sold-out games</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-cyan">Fast Lane</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Express QR Entry/Exit</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-purple">Close to Gates</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Within 5-10 Min Walk</p>
            </div>
            <div>
                <p class="text-2xl font-black text-white">24/7 Security</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">CCTV Guarded Garages</p>
            </div>
        </div>
    </div>

    <!-- Event Mid Ad Banner -->
    <div class="max-w-7xl mx-auto px-6">
        <x-ad-slot slot="event_mid_banner" class="my-8" />
    </div>

    <!-- Venue Categories Grid -->
    <section class="py-16 max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Comprehensive Coverage</h2>
            <h3 class="text-3xl font-bold text-white">Bespoke Venue Solutions</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🏟️', 'title' => 'Stadiums & Sports Arenas', 'desc' => 'Guaranteed premium slots within walking distance of major stadiums. Avoid parking blockades and congestion.'],
                ['icon' => '🎭', 'title' => 'Theaters & Concert Halls', 'desc' => 'Reserved spaces in multi-level indoor structures adjacent to top downtown theater districts.'],
                ['icon' => '💍', 'title' => 'Banquets & Weddings', 'desc' => 'Organize priority guest slots or valet teams for marriage gardens, corporate seminars, and gala dinners.']
            ] as $venue)
            <div class="glass-panel rounded-3xl p-6 space-y-3 border border-white/5">
                <span class="text-3xl block">{{ $venue['icon'] }}</span>
                <h4 class="text-lg font-bold text-white">{{ $venue['title'] }}</h4>
                <p class="text-neutral-400 text-xs leading-relaxed">{{ $venue['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- EEAT Authoritative Advisory -->
    <section class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Venue Advisory</span>
                <h3 class="text-3xl font-extrabold text-white">How to Navigate Event Congestion</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Our stadium coordinators recommend arriving at least 45 minutes before the gates open. During major matches, police cordons might change routing.
                </p>
                <div class="space-y-3 text-xs text-neutral-400">
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Pre-paid reservation pass works even if streets are barricaded.</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Show digital pass to municipal inspectors for direct deck access.</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6">
                <div class="glass-panel rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-white text-md">Verified Event Attendee Review</h4>
                    <p class="italic text-neutral-300 text-xs leading-relaxed">
                        "Booked event parking near the stadium for a concert. Had an express queue lane entrance. My car was safe under surveillance while we enjoyed the show. Highly recommend!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary text-xs">A</div>
                        <div>
                            <h5 class="text-xs font-bold text-white">Anirudh Gupta</h5>
                            <p class="text-[9px] text-neutral-500">Concert Attendee</p>
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
            <h3 class="text-3xl font-bold text-white">Event Parking FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Can I reserve parking for stadium concerts in advance?', 'a' => 'Yes, ParkingHawker allows event parking reservations up to 30 days in advance, securing your spot near the main gates.'],
                ['q' => 'What if the event gets postponed or cancelled?', 'a' => 'If the venue cancels or reschedules the event, we automatically refund your reservation fee in full or carry it over to the new date.'],
                ['q' => 'Are EV charging slots available on event days?', 'a' => 'Yes, select partner garages near major venues feature EV charging ports, though they fill up fast. Reserve specifically by selecting "EV Charging" when searching.'],
                ['q' => 'Do you offer group parking bookings for corporate seminars?', 'a' => 'Yes, corporate coordinators can book multiple spots or reserve entire levels for seminars and banquets through our corporate contact line.']
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

    <!-- Event Bottom Ad Banner -->
    <div class="max-w-7xl mx-auto px-6 pb-12">
        <x-ad-slot slot="event_bottom_banner" class="my-8" />
    </div>
</x-public-layout>
