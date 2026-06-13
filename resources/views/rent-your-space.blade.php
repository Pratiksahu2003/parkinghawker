@php
    $pageTitle = 'Rent Your Space | List Driveway or Garage | ParkingHawker';
    $pageDesc  = 'Make passive income by listing your empty residential or commercial parking spaces on ParkingHawker. Vetted guest drivers, free software integration, and automatic payouts.';
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
                    ['@type' => 'Question', 'name' => 'How much can I earn listing my space?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Earnings vary by city and location. Hosts in busy office districts like CP Delhi or BKC Mumbai can earn between ₹5,000 to ₹12,000 monthly per spot.']],
                    ['@type' => 'Question', 'name' => 'What if a driver damages my property?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'ParkingHawker provides direct Host Protection Guarantees up to ₹50,000 for any verified property damage caused during a booking.']]
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
                💰 Host Earning Portal
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Turn Empty Spaces Into <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Steady Passive Income
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                List your driveway, garage, parking lot, or vacant space for free. Get booked by verified local commuters and enjoy auto-payouts.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="#form" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    Start Listing Space
                </a>
                <a href="#calculator" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Calculate Earnings
                </a>
            </div>
        </div>
    </section>

    <!-- Earnings Calculator Section (EEAT / Engagement) -->
    <section id="calculator" class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Revenue Estimations</span>
                <h3 class="text-3xl font-extrabold text-white">How Much Can You Earn?</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Earning potential depends on search traffic density and locality. Spaces near shopping districts, office blocks, and transit points enjoy maximum demand.
                </p>
                <div class="space-y-3 pt-2">
                    <div class="flex justify-between items-center text-xs pb-2 border-b border-white/5">
                        <span class="text-neutral-500 font-semibold uppercase">Premium Metro Hubs</span>
                        <span class="text-white font-extrabold">₹8,000 – ₹15,000/mo</span>
                    </div>
                    <div class="flex justify-between items-center text-xs pb-2 border-b border-white/5">
                        <span class="text-neutral-500 font-semibold uppercase">Busy Commercial Lanes</span>
                        <span class="text-white font-extrabold">₹5,000 – ₹8,000/mo</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-neutral-500 font-semibold uppercase">Residential Driveways</span>
                        <span class="text-white font-extrabold">₹2,000 – ₹4,000/mo</span>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-7">
                <div class="glass-panel rounded-3xl p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <h4 class="font-bold text-white text-sm">Host Protection Shield™</h4>
                        <p class="text-neutral-400 text-xs leading-relaxed">Our comprehensive package covers up to ₹50,000 in property protection so you can list with absolute confidence.</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-bold text-white text-sm">Automated Direct Payouts</h4>
                        <p class="text-neutral-400 text-xs leading-relaxed">Payouts are compiled and sent directly to your linked bank account every Sunday without manual request delays.</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-bold text-white text-sm">Vetted Drivers Only</h4>
                        <p class="text-neutral-400 text-xs leading-relaxed">We verify all driver identities and vehicle registrations prior to arrival at your property deck.</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-bold text-white text-sm">Flexible Timings</h4>
                        <p class="text-neutral-400 text-xs leading-relaxed">Set your space availability hours on the fly. Block out days for personal guests anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form Column -->
    <section id="form" class="py-16 max-w-4xl mx-auto px-6">
        <div class="glass-panel rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="space-y-1 text-center">
                <h3 class="text-2xl font-bold text-white">Register Your Parking Space</h3>
                <p class="text-xs text-neutral-400">Complete the initial details and our field agent will contact you for a site inspection audit.</p>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="requirement" value="Host Space Registration">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-neutral-400">Full Name</label>
                        <input type="text" name="name" required placeholder="John Doe"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-neutral-400">Email Address</label>
                        <input type="email" name="email" required placeholder="john@example.com"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-neutral-400">Mobile Phone</label>
                        <input type="text" name="phone" placeholder="+91 XXXXX XXXXX"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-neutral-400">Expected Monthly Rent (₹)</label>
                        <input type="number" name="expected_rent" placeholder="e.g. 5000"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-neutral-400">Space Address / Location</label>
                    <input type="text" name="space_location" required placeholder="Plot, Street, City, State"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-neutral-400">Tell us about your space (Access hours, security, etc.)</label>
                    <textarea name="message" required rows="4" placeholder="e.g. Gated underground garage with 24/7 CCTV access and security guard."
                              class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-neutral-500 text-sm focus:outline-none focus:border-brand-cyan transition-all resize-none"></textarea>
                </div>

                <button type="submit"
                        style="background: linear-gradient(135deg, #06b6d4, #8b5cf6);"
                        class="w-full py-3.5 rounded-xl text-white font-bold text-sm shadow-lg shadow-[#06b6d4]/10 hover:opacity-95 transition-all">
                    Submit Listing Request
                </button>
            </form>
        </div>
    </section>

    <!-- FAQs Accordion (EEAT: Trust) -->
    <section class="py-16 max-w-4xl mx-auto px-6 space-y-8" x-data="{ open: null }">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Got Questions?</h2>
            <h3 class="text-3xl font-bold text-white">Hosting FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Is listing my space really free?', 'a' => 'Yes! Listing is 100% free. ParkingHawker only collects a small commission on completed bookings to cover insurance and processing fees.'],
                ['q' => 'What type of spaces can I list?', 'a' => 'You can list almost any space where a vehicle can park legally: driveways, indoor garages, commercial parking spaces, vacant lots, and corporate decks.'],
                ['q' => 'Who controls pricing for my spot?', 'a' => 'You do! You can set your hourly, daily, and monthly rates. Our dashboard can also suggest dynamic pricing optimization depending on local events and demand.'],
                ['q' => 'How are parking bookings verified?', 'a' => 'Guests receive a digital reservation QR code. If your space features our automated barriers, it will scan to open. Otherwise, guests show their digital pass to your security guard.']
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
