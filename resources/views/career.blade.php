<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Careers | Join the Smart Parking Revolution" 
            description="Explore job opportunities, company culture, and open positions at ParkingHawker. Help us build the future of urban mobility."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-12 text-center space-y-4 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Careers</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                Build the Future of <br>
                <span class="text-gradient-cyan-purple">Smart Transit</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                Join our engineering, operations, or design teams and tackle complex urban bottlenecks.
            </p>
        </div>
    </section>

    <!-- Open Positions -->
    <section class="py-6 max-w-7xl mx-auto px-6 space-y-6">
        <div class="text-center md:text-left space-y-1">
            <h3 class="text-xl font-bold text-white">Current Opportunities</h3>
            <p class="text-xs text-neutral-400">Apply to shape city infrastructure and dynamic routing networks.</p>
        </div>

        <div class="space-y-4">
            @foreach([
                ['title' => 'Senior AI Computer Vision Engineer', 'department' => 'Engineering', 'location' => 'Mumbai / Hybrid', 'type' => 'Full-time'],
                ['title' => 'Product Designer (UX/UI)', 'department' => 'Product Design', 'location' => 'Remote / Delhi', 'type' => 'Full-time'],
                ['title' => 'City Growth Operations Manager', 'department' => 'Operations', 'location' => 'Pune', 'type' => 'Full-time']
            ] as $job)
            <div class="glass-panel rounded-3xl p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-brand-cyan uppercase tracking-widest">{{ $job['department'] }}</span>
                    <h4 class="text-lg font-bold text-white">{{ $job['title'] }}</h4>
                    <div class="flex items-center gap-4 text-xs text-neutral-400">
                        <span>📍 {{ $job['location'] }}</span>
                        <span>💼 {{ $job['type'] }}</span>
                    </div>
                </div>
                <a href="/contact" class="w-full md:w-auto px-6 py-2.5 rounded-xl border border-white/10 hover:border-white/20 bg-white/5 hover:bg-white/10 text-xs font-bold text-neutral-300 hover:text-white transition-all text-center">
                    Apply Now
                </a>
            </div>
            @endforeach
        </div>

        <x-ad-slot slot="career_bottom_banner" class="my-6" />
    </section>
</x-public-layout>
