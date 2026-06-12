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
                        <p class="text-sm text-neutral-400">Deployed dynamic green pricing algorithms and automated charger waitlist notifications across SOMA decks.</p>
                    </div>
                </div>

                <!-- Node 2 -->
                <div class="relative">
                    <span class="absolute -left-12 top-1.5 h-8 w-8 rounded-full bg-brand-purple border-4 border-dark-primary flex items-center justify-center text-[10px] text-dark-primary font-bold">2025</span>
                    <div class="space-y-1.5">
                        <h4 class="text-md font-bold text-white">East Coast Expansion</h4>
                        <p class="text-sm text-neutral-400">Broke ground in New York Times Square, scaling capacity by 200% with premium partner garages.</p>
                    </div>
                </div>

                <!-- Node 3 -->
                <div class="relative">
                    <span class="absolute -left-12 top-1.5 h-8 w-8 rounded-full bg-neutral-700 border-4 border-dark-primary flex items-center justify-center text-[10px] text-dark-primary font-bold">2024</span>
                    <div class="space-y-1.5">
                        <h4 class="text-md font-bold text-white">Seed Operations Began</h4>
                        <p class="text-sm text-neutral-400">Founded with a single automated garage test bed in San Francisco, deploying the first plate recognition API.</p>
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

</x-public-layout>
