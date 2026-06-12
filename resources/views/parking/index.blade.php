<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Find Parking Spaces" 
            description="Browse, filter, and search premium parking spaces across key metropolitan regions. Sort by ratings, spot availability, or pricing."
        />
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10" x-data="{ viewMode: 'grid', filterOpen: false }">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between border-b border-white/5 pb-6 mb-8 gap-4">
            <div class="space-y-1">
                <h1 class="text-3xl font-bold text-white tracking-tight">Available Spaces</h1>
                <p class="text-sm text-neutral-400">Discover premium decks in prime locations.</p>
            </div>

            <!-- List control actions -->
            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                <button @click="filterOpen = !filterOpen" class="md:hidden px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-xs font-semibold text-white flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Filters
                </button>
                <div class="flex items-center gap-2">
                    <!-- Grid vs Map view switches -->
                    <button 
                        @click="viewMode = 'grid'" 
                        class="p-2.5 rounded-xl border transition-all"
                        :class="viewMode === 'grid' ? 'bg-white text-dark-primary border-white' : 'bg-white/5 text-neutral-400 border-white/5'"
                        aria-label="Grid view"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    </button>
                    <button 
                        @click="viewMode = 'map'" 
                        class="p-2.5 rounded-xl border transition-all"
                        :class="viewMode === 'map' ? 'bg-white text-dark-primary border-white' : 'bg-white/5 text-neutral-400 border-white/5'"
                        aria-label="Map view"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Sidebar Filters -->
            <aside class="lg:col-span-3 lg:block" :class="filterOpen ? 'block fixed inset-0 z-50 bg-dark-primary/95 p-6 overflow-y-auto' : 'hidden'">
                <div class="flex items-center justify-between lg:hidden mb-6">
                    <h3 class="font-bold text-white text-lg">Filters</h3>
                    <button @click="filterOpen = false" class="text-neutral-400 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form action="{{ route('parking.index') }}" method="GET" class="space-y-6">
                    <!-- City Search -->
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">City/Area</label>
                        <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="e.g. Mumbai" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                    </div>

                    <!-- Structure Type -->
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Structure</label>
                        <select name="parking_type" class="w-full px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                            <option value="all" {{ ($filters['parking_type'] ?? '') == 'all' ? 'selected' : '' }}>All Types</option>
                            <option value="covered" {{ ($filters['parking_type'] ?? '') == 'covered' ? 'selected' : '' }}>Covered</option>
                            <option value="underground" {{ ($filters['parking_type'] ?? '') == 'underground' ? 'selected' : '' }}>Underground</option>
                            <option value="rooftop" {{ ($filters['parking_type'] ?? '') == 'rooftop' ? 'selected' : '' }}>Rooftop</option>
                            <option value="open" {{ ($filters['parking_type'] ?? '') == 'open' ? 'selected' : '' }}>Open Lots</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Sort By</label>
                        <select name="sort" class="w-full px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                            <option value="rating" {{ ($filters['sort'] ?? '') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                            <option value="price_low" {{ ($filters['sort'] ?? '') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ ($filters['sort'] ?? '') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="spots" {{ ($filters['sort'] ?? '') == 'spots' ? 'selected' : '' }}>Most Spots Available</option>
                        </select>
                    </div>

                    <!-- Amenities Toggle Toggles -->
                    <div class="space-y-4 pt-4 border-t border-white/5">
                        <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider block">Amenities</span>
                        
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="ev_charging" value="yes" {{ ($filters['ev_charging'] ?? '') == 'yes' ? 'checked' : '' }} class="h-4.5 w-4.5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0">
                            <span class="text-sm text-neutral-300">EV Supercharger</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="valet" value="yes" {{ ($filters['valet'] ?? '') == 'yes' ? 'checked' : '' }} class="h-4.5 w-4.5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0">
                            <span class="text-sm text-neutral-300">Smart Valet</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="security" value="yes" {{ ($filters['security'] ?? '') == 'yes' ? 'checked' : '' }} class="h-4.5 w-4.5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0">
                            <span class="text-sm text-neutral-300">CCTV & Guards</span>
                        </label>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="flex-1 py-3 rounded-xl bg-brand-cyan hover:bg-brand-cyan/95 text-dark-primary font-bold text-sm tracking-wide transition-colors">
                            Apply
                        </button>
                        <a href="{{ route('parking.index') }}" class="px-4 py-3 rounded-xl border border-white/10 hover:bg-white/5 text-neutral-400 hover:text-white transition-colors text-sm font-semibold flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </form>
            </aside>

            <!-- Main Results Layout Area -->
            <div class="lg:col-span-9" :class="viewMode === 'map' ? 'lg:col-span-9' : ''">
                <!-- GRID VIEW -->
                <div x-show="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 gap-6" x-transition:enter="transition ease-out duration-300">
                    @forelse($spots as $spot)
                        <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full reveal-fade">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $spot['image'] }}" alt="{{ $spot['name'] }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-dark-primary/60 via-transparent to-transparent pointer-events-none"></div>
                                <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-dark-primary/80 backdrop-blur text-xs font-bold text-brand-cyan uppercase tracking-wider">
                                    @if(($spot['currency_code'] ?? '') === 'JPY')
                                        {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }} / hr
                                    @else
                                        {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }} / hr
                                    @endif
                                </span>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between gap-5">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-xs text-neutral-500">
                                        <span>📍 {{ $spot['city'] }}, {{ $spot['area'] }}</span>
                                        <span class="flex items-center gap-0.5 text-brand-cyan font-bold">★ {{ $spot['rating'] }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-white tracking-tight">{{ $spot['name'] }}</h3>
                                    <p class="text-sm text-neutral-400 line-clamp-2">{{ $spot['description'] }}</p>
                                    
                                    <!-- Amenities icons -->
                                    <div class="flex items-center gap-3 pt-2 text-neutral-500">
                                        @if($spot['amenities']['ev_charging'])
                                            <span class="px-2 py-1 rounded bg-white/5 border border-white/5 text-[10px] text-brand-accent uppercase font-bold tracking-wider">⚡ EV</span>
                                        @endif
                                        @if($spot['amenities']['valet'])
                                            <span class="px-2 py-1 rounded bg-white/5 border border-white/5 text-[10px] text-brand-cyan uppercase font-bold tracking-wider">🚗 Valet</span>
                                        @endif
                                        @if($spot['amenities']['security_cctv'])
                                            <span class="px-2 py-1 rounded bg-white/5 border border-white/5 text-[10px] text-brand-purple uppercase font-bold tracking-wider">🛡️ CCTV</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-white/5">
                                    <span class="text-xs font-semibold text-neutral-400">🚘 {{ $spot['available_spots'] }} / {{ $spot['total_spots'] }} spots free</span>
                                    <a href="{{ route('parking.show', $spot['id']) }}" class="px-5 py-2.5 rounded-xl bg-white text-dark-primary font-bold text-xs hover:bg-neutral-100 transition-colors">
                                        Book Spot
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-20 border border-dashed border-white/10 rounded-3xl space-y-4">
                            <svg class="h-12 w-12 text-neutral-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div class="space-y-1">
                                <h3 class="text-md font-bold text-white">No parking spots found</h3>
                                <p class="text-sm text-neutral-500">Try modifying your locations, amenities, or keywords.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- MAP VIEW -->
                <div x-show="viewMode === 'map'" class="grid grid-cols-1 lg:grid-cols-12 gap-6" x-transition:enter="transition ease-out duration-300" style="display: none;">
                    <!-- List panel -->
                    <div class="lg:col-span-5 space-y-4 max-h-[600px] overflow-y-auto pr-2">
                        @foreach($spots as $spot)
                            <div class="glass-card rounded-2xl p-4 flex gap-4 cursor-pointer hover:border-brand-cyan/30 transition-all">
                                <img src="{{ $spot['image'] }}" alt="{{ $spot['name'] }}" class="h-20 w-20 rounded-xl object-cover">
                                <div class="flex-grow flex flex-col justify-between">
                                    <div class="space-y-0.5">
                                        <h4 class="text-sm font-bold text-white line-clamp-1">{{ $spot['name'] }}</h4>
                                        <span class="text-xs text-neutral-500">📍 {{ $spot['city'] }}, {{ $spot['area'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs mt-1">
                                        <span class="text-brand-cyan font-bold">
                                            @if(($spot['currency_code'] ?? '') === 'JPY')
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }}/hr
                                            @else
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }}/hr
                                            @endif
                                        </span>
                                        <a href="{{ route('parking.show', $spot['id']) }}" class="text-white hover:text-brand-cyan font-bold transition-colors">Select</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Interactive Map Mock -->
                    <div class="lg:col-span-7 h-[600px] rounded-3xl bg-dark-secondary border border-white/5 relative overflow-hidden flex items-center justify-center">
                        <!-- Futuristic grid line design -->
                        <div class="absolute inset-0 bg-[radial-gradient(rgba(6,182,212,0.08)_1px,transparent_1px)] bg-[size:20px_20px] opacity-75"></div>
                        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.01)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.01)_1px,transparent_1px)] bg-[size:100px_100px]"></div>

                        <!-- Central radar sweep -->
                        <div class="absolute h-80 w-80 rounded-full border border-brand-cyan/10 animate-pulse pointer-events-none flex items-center justify-center">
                            <div class="h-48 w-48 rounded-full border border-brand-purple/10"></div>
                        </div>

                        <!-- Map coordinates label -->
                        <span class="absolute top-4 left-4 font-mono text-[10px] text-neutral-600">GRID SYS: MH_MUM_NEON_400021</span>

                        <!-- Interactive mockup Pins -->
                        @foreach($spots as $spot)
                            @php
                                // Generate mock screen offsets based on coordinates
                                $top = rand(25, 75);
                                $left = rand(25, 75);
                            @endphp
                            <div 
                                class="absolute cursor-pointer group z-20" 
                                style="top: {{ $top }}%; left: {{ $left }}%;"
                                x-data="{ tooltip: false }"
                                @mouseenter="tooltip = true"
                                @mouseleave="tooltip = false"
                                @click="window.location.href = '{{ route('parking.show', $spot['id']) }}'"
                            >
                                <!-- Ping aura -->
                                <div class="absolute -inset-2 rounded-full bg-brand-cyan/20 blur-sm group-hover:scale-150 transition-all duration-300"></div>
                                <div class="h-4 w-4 rounded-full bg-brand-cyan border-2 border-white relative z-10 flex items-center justify-center transition-transform group-hover:scale-125">
                                    <span class="h-1.5 w-1.5 rounded-full bg-dark-primary"></span>
                                </div>

                                <!-- Tooltip popup -->
                                <div 
                                    x-show="tooltip" 
                                    x-transition 
                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-dark-primary/95 border border-brand-cyan/30 rounded-xl p-3 w-48 shadow-2xl z-30" 
                                    style="display: none;"
                                >
                                    <strong class="text-xs text-white block truncate mb-0.5">{{ $spot['name'] }}</strong>
                                    <span class="text-[10px] text-neutral-400 block mb-1">🚘 {{ $spot['available_spots'] }} spots free</span>
                                    <span class="text-xs font-bold text-brand-cyan">
                                        @if(($spot['currency_code'] ?? '') === 'JPY')
                                            {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }}/hr
                                        @else
                                            {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }}/hr
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
