@php
    $pageTitle = 'Monthly Parking Subscriptions & Commuter Passes | ParkingHawker';
    $pageDesc  = 'Save up to 40% on daily parking rates. Book guaranteed monthly parking passes in New Delhi, Mumbai, Bengaluru, and Pune. 24/7 access and key cards.';
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
                    ['@type' => 'Question', 'name' => 'How much does a monthly parking pass cost?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Monthly parking subscriptions start at ₹1,500 for weekday-only commuter passes, up to ₹4,500 for EV-charging enabled premium slots.']],
                    ['@type' => 'Question', 'name' => 'Can I cancel my monthly parking subscription?',
                     'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, our monthly passes offer flexible, month-to-month contracts. You can cancel at any time via your dashboard with no cancellation fee.']]
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
                🎫 Commuter Subscriptions
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-none">
                Dedicated Monthly <br>
                <span class="bg-gradient-to-r from-brand-cyan to-brand-purple bg-clip-text text-transparent">
                    Parking Commuter Passes
                </span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                Save up to 40% compared to daily drive-up parking rates. Lock in your dedicated space with 24/7 unlimited access key cards.
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="#packages" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-lg shadow-brand-cyan/20 hover:opacity-95 transition-all">
                    View Subscription Plans
                </a>
                <a href="/contact" class="px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                    Enquire corporate passes
                </a>
            </div>
        </div>
    </section>

    <!-- Value Stats (EEAT) -->
    <div class="bg-white/[0.02] border-y border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-black text-white">40% Savings</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">vs Daily Drive-Up Fees</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-cyan">Guaranteed Spot</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Even on Peak Weekdays</p>
            </div>
            <div>
                <p class="text-2xl font-black text-brand-purple">No Lock-in</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">Flexible Month-to-Month</p>
            </div>
            <div>
                <p class="text-2xl font-black text-white">24/7 Entry</p>
                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-1">RFID Key Card Access</p>
            </div>
        </div>
    </div>

    <!-- Package Grid -->
    <section id="packages" class="py-16 max-w-7xl mx-auto px-6 space-y-12">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Flexible Pricing</h2>
            <h3 class="text-3xl font-bold text-white">Commuter Monthly Passes</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['title' => 'Weekday Commuter', 'price' => '₹1,500/mo', 'desc' => 'Perfect for regular office goers. Valid Monday to Friday (8:00 AM – 7:00 PM) with unlimited daily check-ins.'],
                ['title' => '24/7 Unlimited Access', 'price' => '₹3,000/mo', 'desc' => 'Dedicated premium parking space in our smart multi-level decks with 24/7 RFID key card entry.'],
                ['title' => 'EV Dedicated Plus', 'price' => '₹4,500/mo', 'desc' => 'Dedicated space equipped with Level-2 smart charging, free monthly charging credit, and overnight backup security.']
            ] as $plan)
            <div class="glass-panel rounded-3xl p-6 space-y-4 flex flex-col justify-between border border-white/5">
                <div class="space-y-2">
                    <h4 class="text-lg font-bold text-white">{{ $plan['title'] }}</h4>
                    <div class="text-3xl font-black text-brand-cyan">{{ $plan['price'] }}</div>
                    <p class="text-neutral-400 text-xs leading-relaxed">{{ $plan['desc'] }}</p>
                </div>
                <a href="/contact" class="block w-full py-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-center text-xs font-bold text-neutral-300 hover:text-white transition-all">
                    Get Pass Now
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Detailed Value Propositions (Local Focus / EEAT) -->
    <section class="py-12 bg-white/[0.01] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold text-brand-purple uppercase tracking-widest">Why Commuters Choose Us</span>
                <h3 class="text-3xl font-extrabold text-white">The Smart Parking Subscription Advantage</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Say goodbye to searching for parking every morning. With ParkingHawker's subscription, your license plate is added to our smart automated gates, giving you ticketless access.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-neutral-400">
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Multi-lot roam access options</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Zero payment queue delays</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Priority support helpline</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-brand-cyan">✓</span>
                        <span>Pre-inspection damage insurance</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6">
                <div class="glass-panel rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-white text-md">Commuter Review Spotlight</h4>
                    <div class="space-y-4">
                        <p class="italic text-neutral-300 text-xs leading-relaxed">
                            "Booking the 24/7 Unlimited Pass near my clinic in CP Delhi has saved me so much hassle. I no longer worry about street parking fines or finding space during rush hour."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary text-xs">Dr</div>
                            <div>
                                <h5 class="text-xs font-bold text-white">Dr. Kavita Nair</h5>
                                <p class="text-[9px] text-neutral-500">Connaught Place pass holder since 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Accordion (EEAT: Trust) -->
    <section class="py-16 max-w-4xl mx-auto px-6 space-y-8" x-data="{ open: null }">
        <div class="text-center space-y-2">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Got Questions?</h2>
            <h3 class="text-3xl font-bold text-white">Subscription FAQs</h3>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'How do I activate my monthly pass?', 'a' => 'Once you complete your payment, your vehicle\'s license plate is registered on our smart gate system. Our dynamic camera barrier will recognize your vehicle and open automatically upon entry.'],
                ['q' => 'Can I change my registered vehicle details?', 'a' => 'Yes, you can update your vehicle\'s registration number up to twice a month through your dashboard without any extra cost.'],
                ['q' => 'Are monthly spots guaranteed?', 'a' => 'Yes! We cap the number of monthly passes for each garage below capacity to guarantee that a dedicated space is always open for pass holders.'],
                ['q' => 'What is the refund policy for monthly parking?', 'a' => 'You can cancel your month-to-month subscription anytime before the next billing cycle. We do not offer refunds for partial unused monthly periods.']
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
