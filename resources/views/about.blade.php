<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="About Us" 
            description="Learn how ParkingHawker is leveraging AI technology, license recognition, and level-3 EV supercharging to redefine urban mobility and secure smart garages."
        />
    </x-slot>

    <!-- Hero Header -->
    <section class="relative py-20 text-center space-y-6 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-4">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Our Purpose</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                Pioneering Intelligent <br>
                <span class="text-gradient-cyan-purple">Urban Space Parking</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                We design premium digital access points that bridge physical infrastructure with advanced automation.
            </p>
        </div>
    </section>

    <!-- Core Values: Mission & Vision -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="glass-panel rounded-3xl p-8 space-y-4 relative overflow-hidden">
                <span class="text-3xl">🎯</span>
                <h3 class="text-xl font-bold text-white">Our Mission</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    To eliminate the stress of parking navigation globally by replacing slow legacy ticketing gates with smart ticketless recognition systems and convenient reserving workflows.
                </p>
            </div>
            <div class="glass-panel rounded-3xl p-8 space-y-4 relative overflow-hidden">
                <span class="text-3xl">👁️</span>
                <h3 class="text-xl font-bold text-white">Our Vision</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    To build a zero-friction transit grid where every electric vehicle charges automatically upon entering secure multi-level garages, integrated seamlessly with municipal grids.
                </p>
            </div>
        </div>
    </section>

    <!-- Timeline / Milestones -->
    <section class="py-20 bg-dark-secondary relative">
        <div class="max-w-4xl mx-auto px-6 space-y-16">
            <div class="text-center space-y-2">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Company Journey</h2>
                <h3 class="text-2xl sm:text-3xl font-bold text-white">Milestones & Growth</h3>
            </div>

            <!-- Vertical Timeline Layout -->
            <div class="relative border-l border-white/5 pl-8 ml-4 space-y-12">
                <!-- Node 1 -->
                <div class="relative">
                    <span class="absolute -left-12 top-1.5 h-8 w-8 rounded-full bg-brand-cyan border-4 border-dark-primary flex items-center justify-center text-[10px] text-dark-primary font-bold">2026</span>
                    <div class="space-y-1.5">
                        <h4 class="text-md font-bold text-white">Next-Gen AI Launch</h4>
                        <p class="text-sm text-neutral-400">Deployed dynamic green pricing algorithms and automated charger waitlist notifications across BKC (Bandra Kurla Complex) decks.</p>
                    </div>
                </div>

                <!-- Node 2 -->
                <div class="relative">
                    <span class="absolute -left-12 top-1.5 h-8 w-8 rounded-full bg-brand-purple border-4 border-dark-primary flex items-center justify-center text-[10px] text-dark-primary font-bold">2025</span>
                    <div class="space-y-1.5">
                        <h4 class="text-md font-bold text-white">National Capital Expansion</h4>
                        <p class="text-sm text-neutral-400">Broke ground in New Delhi Connaught Place, scaling capacity by 200% with premium partner garages.</p>
                    </div>
                </div>

                <!-- Node 3 -->
                <div class="relative">
                    <span class="absolute -left-12 top-1.5 h-8 w-8 rounded-full bg-neutral-700 border-4 border-dark-primary flex items-center justify-center text-[10px] text-dark-primary font-bold">2024</span>
                    <div class="space-y-1.5">
                        <h4 class="text-md font-bold text-white">Seed Operations Began</h4>
                        <p class="text-sm text-neutral-400">Founded with a single automated garage test bed in Bandra, Mumbai, deploying the first plate recognition API.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Team -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 space-y-16">
            <div class="text-center space-y-2">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Our Team</h2>
                <h3 class="text-2xl sm:text-3xl font-bold text-white">The Brains Behind the Decks</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach($team as $member)
                    <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full border border-white/5 text-center p-6 space-y-4">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-28 w-28 rounded-full object-cover mx-auto border-2 border-white/10">
                        <div>
                            <strong class="text-md text-white block">{{ $member['name'] }}</strong>
                            <span class="text-xs text-neutral-500">{{ $member['role'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Awards / Accolades Table -->
    <section class="py-20 bg-dark-secondary">
        <div class="max-w-5xl mx-auto px-6 space-y-12">
            <div class="text-center space-y-2">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Accolades</h2>
                <h3 class="text-2xl sm:text-3xl font-bold text-white">Industry Recognitions</h3>
            </div>

            <div class="glass-panel rounded-3xl overflow-hidden shadow-xl border border-white/5">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-white/5 text-neutral-400 font-semibold border-b border-white/5">
                            <th class="px-6 py-4">Year</th>
                            <th class="px-6 py-4">Award Title</th>
                            <th class="px-6 py-4">Issuer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-neutral-300">
                        @foreach($awards as $aw)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-mono font-bold text-brand-cyan">{{ $aw['year'] }}</td>
                                <td class="px-6 py-4 font-semibold text-white">{{ $aw['title'] }}</td>
                                <td class="px-6 py-4 text-neutral-400">{{ $aw['issuer'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Pillar Values Section -->
    <section class="py-20 relative border-t border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Operational Core</h2>
                <h3 class="text-3xl font-bold text-white tracking-tight">Our Core Value Pillars</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-white/5 border border-white/5 space-y-3">
                    <span class="text-2xl">🔒</span>
                    <strong class="text-white block font-bold text-sm">Compromise-Free Security</strong>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Continuous surveillance, audited hosts, and high-frequency guard patrols to protect your assets.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/5 space-y-3">
                    <span class="text-2xl">🤖</span>
                    <strong class="text-white block font-bold text-sm">Full Smart Automation</strong>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Say goodbye to paper tickets and lost gate keys. License plates are your modern digital access key.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/5 space-y-3">
                    <span class="text-2xl">📈</span>
                    <strong class="text-white block font-bold text-sm">Elastic Scalability</strong>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Expanding rapidly across urban centers. Driveways, corporate spaces, and airports unified under one platform.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/5 space-y-3">
                    <span class="text-2xl">🤝</span>
                    <strong class="text-white block font-bold text-sm">Client-First Design</strong>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Seamless interfaces, rapid digital bookings, instant cancellations, and a friendly 24/7 support channel.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sustainability Section -->
    <section class="py-24 relative overflow-hidden bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-accent">Green Initiative</span>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                    Commitment to Net-Zero <br>
                    <span class="text-gradient-emerald">Urban Transit & Charging</span>
                </h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    ParkHawker is committed to reducing environmental impact in dense cities. We actively prioritize partner garages that utilize solar panels, optimize grid usage, and offer level-3 DC chargers powered by 100% renewable electricity.
                </p>
                
                <div class="grid grid-cols-2 gap-6 pt-2 text-xs">
                    <div>
                        <strong class="text-white block text-2xl font-bold font-mono">400+ MT</strong>
                        <span class="text-neutral-500 mt-1 block">Carbon emissions prevented annually</span>
                    </div>
                    <div>
                        <strong class="text-brand-accent block text-2xl font-bold font-mono">100%</strong>
                        <span class="text-neutral-500 mt-1 block">Renewable power at premium EV decks</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <!-- Visual Decarbonization card graphic -->
                <div class="glass-panel rounded-3xl p-6 w-full max-w-sm border border-brand-accent/20 bg-brand-accent/5">
                    <span class="text-3xl block mb-4">🍃</span>
                    <strong class="text-white block text-sm mb-2">Solar Net-Meter Status</strong>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Total Generation</span>
                            <span class="text-white font-semibold">14,250 kWh this month</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Grid Offset Rate</span>
                            <span class="text-brand-accent font-bold">120% (Net Positive)</span>
                        </div>
                        <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden mt-1">
                            <div class="bg-brand-accent h-full rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Regional Corporate Offices -->
    <section class="py-24 animate-reveal-up">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Our Presence</h2>
                <h3 class="text-3xl font-bold text-white tracking-tight">Regional Offices</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-panel rounded-3xl p-6 space-y-3 animate-reveal-fade">
                    <strong class="text-white block text-md">Mumbai (HQ)</strong>
                    <span class="text-xs text-brand-cyan font-mono block">Plot 12, Maker Chambers VI, Nariman Point</span>
                    <p class="text-xs text-neutral-500">Corporate strategy, executive lounge, and core platform development operations.</p>
                </div>
                <div class="glass-panel rounded-3xl p-6 space-y-3 animate-reveal-fade">
                    <strong class="text-white block text-md">New Delhi (CP Hub)</strong>
                    <span class="text-xs text-brand-purple font-mono block">Block E, Connaught Place, New Delhi</span>
                    <p class="text-xs text-neutral-500">Government relations, national partnerships, and northern zone hosting operations.</p>
                </div>
                <div class="glass-panel rounded-3xl p-6 space-y-3 animate-reveal-fade">
                    <strong class="text-white block text-md">Bengaluru (R&D)</strong>
                    <span class="text-xs text-brand-accent font-mono block">100 Feet Rd, Indiranagar, Bengaluru</span>
                    <p class="text-xs text-neutral-500">Smart hardware testing, automated bollard R&D, and computer vision API engineering.</p>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
