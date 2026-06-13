<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Complete Directory of Parking Spaces | ParkingHawker" 
            description="Browse our complete directory of hourly, daily, and monthly parking facilities and EV charging points in major cities."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-12 text-center space-y-4 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Directory Index</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                All Verified <br>
                <span class="text-gradient-cyan-purple">Parking Facilities</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                Find public, private, event, and charging-friendly parking lots categorized by city.
            </p>
        </div>
    </section>

    <!-- Cities Index / Links Section -->
    <section class="py-6 max-w-7xl mx-auto px-6">
        <div class="glass-panel rounded-3xl p-6 sm:p-8 space-y-6">
            <h3 class="text-lg font-bold text-white">Find Parking by City Directory</h3>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    'New Delhi', 'Mumbai', 'Bengaluru', 'Hyderabad', 
                    'Pune', 'Kolkata', 'Chennai', 'Ahmedabad', 
                    'Agra', 'Lucknow', 'Jaipur', 'Indore', 
                    'Bhopal', 'Chandigarh', 'Noida', 'Gurugram'
                ] as $city)
                <a href="/book-parking-space-in/{{ strtolower(str_replace(' ', '-', $city)) }}.html"
                   class="flex items-center gap-2 p-3.5 rounded-2xl bg-white/5 border border-white/5 hover:border-white/10 hover:bg-white/8 text-sm font-semibold text-neutral-300 hover:text-white transition-all">
                    <span>📍</span> {{ $city }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>
