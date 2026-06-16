<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Press & Media Room | ParkingHawker" 
            description="Get the latest news releases, announcements, and media assets from ParkingHawker, India's leading smart parking platform."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-12 text-center space-y-4 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Media Room</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                Latest News & <br>
                <span class="text-gradient-cyan-purple">Press Releases</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                Stay updated with corporate announcements, platform updates, and scaling achievements.
            </p>
        </div>
    </section>

    <!-- Press Articles Grid -->
    <section class="py-6 max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['date' => 'June 10, 2026', 'title' => 'ParkingHawker Expands Smart Spot Booking to 50+ Cities across India', 'excerpt' => 'Introducing dynamic booking algorithms and localized EV charging stations in major hubs including Agra, Ahmedabad, and Pune.', 'tag' => 'Expansion'],
                ['date' => 'April 15, 2026', 'title' => 'Integrating Zero-Gate License Plate Recognition at Multiplex Decks', 'excerpt' => 'Eliminating manual check-in lanes with advanced computer vision tracking, delivering average check-in speed of less than 3 seconds.', 'tag' => 'Technology'],
                ['date' => 'January 20, 2026', 'title' => 'ParkingHawker Closes Seed Round to Accelerate Level-3 EV Integrations', 'excerpt' => 'Strategic funding will double down on automated multi-level garage partnerships and city-wide green charging slots.', 'tag' => 'Corporate']
            ] as $article)
            <div class="glass-panel rounded-3xl p-6 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-neutral-500 font-medium">{{ $article['date'] }}</span>
                        <span class="px-2 py-0.5 rounded-full bg-[#06b6d4]/10 border border-[#06b6d4]/20 text-[#06b6d4] font-semibold text-[10px] uppercase tracking-wider">{{ $article['tag'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white hover:text-brand-cyan transition-colors cursor-pointer">{{ $article['title'] }}</h3>
                    <p class="text-neutral-400 text-xs leading-relaxed">{{ $article['excerpt'] }}</p>
                </div>
                <a href="#" class="text-xs font-semibold text-brand-purple hover:underline inline-flex items-center gap-1">Read Article →</a>
            </div>
            @endforeach
        </div>

        <x-ad-slot slot="press_bottom_banner" class="my-6" />
    </section>
</x-public-layout>
