<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="User Reviews & Testimonials | ParkingHawker" 
            description="See what vehicle owners and lot hosts say about ParkingHawker's ticketless smart parking experience and instant EV supercharging reservations."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-12 text-center space-y-4 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Testimonials</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                What Our Users <br>
                <span class="text-gradient-cyan-purple">Are Saying</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                Trusted by thousands of daily commuters and parking deck hosts across the country.
            </p>
        </div>
    </section>

    <!-- Reviews Grid -->
    <section class="py-6 max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Rajesh Kumar', 'role' => 'Daily Commuter', 'rating' => '⭐⭐⭐⭐⭐', 'comment' => 'Saved me at least 20 minutes of searching every morning near my office in Connaught Place. Ticketless entry is a game changer!'],
                ['name' => 'Sanjana Rao', 'role' => 'EV Owner', 'rating' => '⭐⭐⭐⭐⭐', 'comment' => 'Being able to reserve both a premium slot and a Level-3 supercharger in Ahmedabad is incredible. Love the clean web interface.'],
                ['name' => 'Vikram Goel', 'role' => 'Garage Partner', 'rating' => '⭐⭐⭐⭐⭐', 'comment' => 'Listing our commercial deck in Pune on ParkingHawker increased our occupancy rate by 40% in just two months. Seamless automation!']
            ] as $review)
            <div class="glass-panel rounded-3xl p-6 space-y-4 flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="text-amber-400 text-sm tracking-widest">{{ $review['rating'] }}</div>
                    <p class="text-neutral-300 text-sm leading-relaxed italic">"{{ $review['comment'] }}"</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 rounded-full bg-brand-cyan flex items-center justify-center font-bold text-dark-primary text-xs">
                        {{ substr($review['name'], 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">{{ $review['name'] }}</h4>
                        <p class="text-[10px] text-neutral-500">{{ $review['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-public-layout>
