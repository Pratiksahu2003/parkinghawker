<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Explore Cities | Book Parking Across India" 
            description="Find and book premium, secure parking spots in 50+ cities across India. Compare rates, locate EV stations, and reserve instantly on ParkingHawker."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="relative py-12 text-center space-y-4 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Explore Hubs</h2>
            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                Smart Parking in <br>
                <span class="text-gradient-cyan-purple">Active Indian Cities</span>
            </h1>
            <p class="text-base sm:text-lg text-neutral-400 max-w-xl mx-auto leading-relaxed">
                Compare rates, check live slot availability, and reserve parking in major metropolitan regions.
            </p>
        </div>
    </section>

    <!-- Cities Grid -->
    <section class="py-6 max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach([
                ['name' => 'New Delhi',    'slug' => 'new-delhi',    'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Mumbai',       'slug' => 'mumbai',       'image' => 'https://images.unsplash.com/photo-1566552881560-0be862a7c445?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Bengaluru',    'slug' => 'bangalore',    'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Hyderabad',    'slug' => 'hyderabad',    'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Pune',         'slug' => 'pune',         'image' => 'https://images.unsplash.com/photo-1601999109332-542b18dbec57?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Kolkata',      'slug' => 'kolkata',      'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Chennai',      'slug' => 'chennai',      'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Ahmedabad',    'slug' => 'ahmedabad',    'image' => 'https://images.unsplash.com/photo-1603251483861-12c85e25287e?auto=format&fit=crop&q=80&w=300']
            ] as $city)
            <a href="/book-parking-space-in/{{ $city['slug'] }}.html"
               class="group relative h-40 rounded-3xl overflow-hidden border border-white/5 flex flex-col justify-end p-4 transition-all hover:-translate-y-1 hover:border-white/10">
                <img src="{{ $city['image'] }}" alt="{{ $city['name'] }}" class="absolute inset-0 h-full w-full object-cover opacity-40 group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-primary via-dark-primary/60 to-transparent"></div>
                <div class="relative z-10">
                    <h3 class="text-md font-bold text-white group-hover:text-brand-cyan transition-colors">{{ $city['name'] }}</h3>
                    <p class="text-[10px] text-neutral-400">View parking slots →</p>
                </div>
            </a>
            @endforeach
        </div>

        <x-ad-slot slot="cities_bottom_banner" class="my-6" />
    </section>
</x-public-layout>
