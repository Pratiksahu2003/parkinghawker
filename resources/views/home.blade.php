<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Premium Parking Booking Platform" 
            description="Find and book premium, secure parking spots with EV charging and valet services. Smooth automated check-ins and state-of-the-art security."
        />
    </x-slot>

    <!-- Fullscreen Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden py-20">
        <!-- Ambient glowing blobs -->
        <div class="absolute top-1/4 left-1/10 h-96 w-96 rounded-full bg-brand-cyan/10 blur-[120px] pointer-events-none reveal-fade"></div>
        <div class="absolute bottom-1/4 right-1/10 h-112 w-112 rounded-full bg-brand-purple/10 blur-[150px] pointer-events-none reveal-fade"></div>

        <div class="max-w-7xl mx-auto px-6 w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Hero Left: Typography & Intro -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-semibold tracking-wide text-brand-cyan uppercase reveal-fade">
                    <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                    Live Availability: 450+ Spots Free Now
                </div>
                
                <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-white leading-tight reveal-up">
                    Modern Parking <br class="hidden sm:inline">
                    <span class="text-gradient-cyan-purple">Reimagined.</span>
                </h1>
                
                <p class="text-lg text-neutral-400 max-w-xl mx-auto lg:mx-0 leading-relaxed reveal-up">
                    Secure an elite space instantly. Enjoy keyless entry scanning, lightning-fast level-3 EV supercharging, and professional valet services.
                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2 reveal-up">
                    <a href="#search-section" class="magnetic-btn px-8 py-4 rounded-full bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-xl shadow-brand-cyan/25 hover:opacity-95 transition-all">
                        Reserve Your Spot
                    </a>
                    <a href="#features" class="px-7 py-3.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
                        Explore Features
                    </a>
                </div>
            </div>

            <!-- Hero Right: Dynamic Availability Widget -->
            <div class="lg:col-span-5 flex justify-center reveal-fade">
                <div class="glass-card w-full max-w-sm p-6 rounded-3xl relative overflow-hidden">
                    <!-- Tech grid gridlines decoration -->
                    <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold uppercase tracking-wider text-neutral-500">Live Status</span>
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-cyan opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-cyan"></span>
                            </span>
                        </div>
                        
                        <div class="space-y-1">
                            <h3 class="text-3xl font-bold text-white tracking-tight" x-data="{ count: 142 }" x-init="setInterval(() => { count = Math.max(130, Math.min(150, count + (Math.random() > 0.5 ? 1 : -1))) }, 4000)">
                                <span x-text="count">142</span> <span class="text-sm font-medium text-neutral-500">/ 350 Spots</span>
                            </h3>
                            <p class="text-xs text-neutral-400">Available at Silicon Valley Premium Garage</p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-brand-cyan to-brand-purple h-full rounded-full transition-all duration-1000" style="width: 40%"></div>
                        </div>

                        <!-- Info details -->
                        <div class="grid grid-cols-2 gap-4 pt-2 border-t border-white/5 text-xs">
                            <div>
                                <span class="text-neutral-500 block">Peak Hours Rate</span>
                                <strong class="text-white font-medium">
                                    @php
                                        $svSpot = collect($parkingSpots)->firstWhere('id', 1);
                                    @endphp
                                    @if($svSpot)
                                        @if(($svSpot['currency_code'] ?? '') === 'JPY')
                                            {{ $svSpot['currency_symbol'] ?? '$' }}{{ number_format($svSpot['price_per_hour'], 0) }} / hr
                                        @else
                                            {{ $svSpot['currency_symbol'] ?? '$' }}{{ number_format($svSpot['price_per_hour'], 2) }} / hr
                                        @endif
                                    @else
                                        $12.00 / hr
                                    @endif
                                </strong>
                            </div>
                            <div>
                                <span class="text-neutral-500 block">Active EV Plugs</span>
                                <strong class="text-brand-accent font-medium">12 Available</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form Section -->
    <section id="search-section" class="py-16 relative z-20 scroll-mt-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="glass-panel rounded-3xl p-8 shadow-2xl relative overflow-visible" x-data="{ 
                location: '',
                vehicleType: 'car',
                entryDate: '{{ date('Y-m-d') }}',
                entryTime: '08:00',
                exitDate: '{{ date('Y-m-d') }}',
                exitTime: '18:00',
                parkingType: 'all',
                evRequired: false,
                suggestions: [],
                allLocations: {!! json_encode($locations) !!},
                errors: {},
                showSuggestions: false,
                
                searchLocations() {
                    if (this.location.length < 2) {
                        this.suggestions = [];
                        return;
                    }
                    this.suggestions = this.allLocations.filter(loc => 
                        loc.toLowerCase().includes(this.location.toLowerCase())
                    );
                },
                selectSuggestion(value) {
                    this.location = value;
                    this.suggestions = [];
                    this.showSuggestions = false;
                },
                validateForm(e) {
                    this.errors = {};
                    if (!this.location) {
                        this.errors.location = 'Please enter a location.';
                    }
                    
                    const entry = new Date(this.entryDate + 'T' + this.entryTime);
                    const exit = new Date(this.exitDate + 'T' + this.exitTime);
                    
                    if (exit <= entry) {
                        this.errors.dates = 'Exit date/time must be after entry date/time.';
                    }
                    
                    if (Object.keys(this.errors).length > 0) {
                        e.preventDefault();
                    }
                }
            }">
                <!-- Floating decoration line -->
                <div class="absolute top-0 left-10 right-10 h-0.5 bg-gradient-to-r from-transparent via-brand-cyan to-transparent"></div>

                <h2 class="text-xl font-bold text-white mb-6 tracking-tight flex items-center gap-2">
                    <svg class="h-5 w-5 text-brand-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Custom Parking Reservation Form
                </h2>

                <form action="{{ route('parking.index') }}" method="GET" @submit="validateForm($event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Location & Suggestions -->
                        <div class="relative flex flex-col justify-end">
                            <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Where to Park</label>
                            <input 
                                type="text" 
                                name="city" 
                                x-model="location" 
                                @input="searchLocations()"
                                @focus="showSuggestions = true"
                                @click.away="showSuggestions = false"
                                placeholder="Enter city (e.g. San Francisco)" 
                                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder-neutral-600 transition-colors"
                            >
                            <!-- Error display -->
                            <span x-show="errors.location" x-text="errors.location" class="text-xs text-red-400 mt-1 absolute -bottom-5" style="display: none;"></span>

                            <!-- Suggestion Dropdown -->
                            <div x-show="showSuggestions && suggestions.length > 0" class="absolute top-full left-0 right-0 mt-2 bg-dark-secondary border border-white/10 rounded-xl overflow-hidden shadow-2xl z-50" style="display: none;">
                                <template x-for="item in suggestions" :key="item">
                                    <button 
                                        type="button" 
                                        @click="selectSuggestion(item)"
                                        class="w-full px-4 py-3 text-left text-sm text-neutral-300 hover:bg-white/5 hover:text-brand-cyan transition-colors"
                                        x-text="item"
                                    ></button>
                                </template>
                            </div>
                        </div>

                        <!-- Vehicle Type Selection -->
                        <div class="flex flex-col justify-end">
                            <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Vehicle Type</label>
                            <select name="vehicle_type" x-model="vehicleType" class="w-full px-4 py-3 rounded-xl bg-dark-primary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                                <option value="car">Car (Sedan/Hatchback)</option>
                                <option value="suv">SUV / Truck</option>
                                <option value="motorcycle">Motorcycle</option>
                            </select>
                        </div>

                        <!-- Entry Date/Time -->
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col justify-end">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Entry Date</label>
                                <input type="date" name="entry_date" x-model="entryDate" class="w-full px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <div class="flex flex-col justify-end">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Entry Time</label>
                                <input type="time" name="entry_time" x-model="entryTime" class="w-full px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                        </div>

                        <!-- Exit Date/Time -->
                        <div class="grid grid-cols-2 gap-2 relative">
                            <div class="flex flex-col justify-end">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Exit Date</label>
                                <input type="date" name="exit_date" x-model="exitDate" class="w-full px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <div class="flex flex-col justify-end">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Exit Time</label>
                                <input type="time" name="exit_time" x-model="exitTime" class="w-full px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <!-- Error display -->
                            <span x-show="errors.dates" x-text="errors.dates" class="text-xs text-red-400 mt-1 absolute -bottom-5 left-0" style="display: none;"></span>
                        </div>
                    </div>

                    <!-- Lower filter row -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-white/5">
                        <div class="flex items-center gap-6">
                            <!-- Parking Type -->
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Decks:</span>
                                <select name="parking_type" x-model="parkingType" class="px-3 py-1.5 rounded-lg bg-dark-primary border border-white/10 text-neutral-300 text-xs focus:outline-none">
                                    <option value="all">All Structures</option>
                                    <option value="covered">Covered</option>
                                    <option value="underground">Underground</option>
                                    <option value="rooftop">Rooftop</option>
                                </select>
                            </div>

                            <!-- EV checkbox -->
                            <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="ev_charging" value="yes" x-model="evRequired" class="h-4.5 w-4.5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 focus:ring-offset-0">
                                <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">EV Charger Required</span>
                            </label>
                        </div>

                        <button type="submit" class="magnetic-btn w-full md:w-auto px-8 py-3.5 rounded-xl bg-brand-cyan hover:bg-brand-cyan/95 text-dark-primary font-bold text-sm tracking-wide shadow-lg transition-all">
                            Scan Available Slots
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Engineered Excellence</h2>
                <p class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Advanced Services Built for Comfort</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Feature 1: Smart Booking -->
                <div class="glass-card rounded-3xl p-6 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-12 w-12 rounded-2xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center mb-6 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">Automated Check-in</h3>
                        <p class="text-sm text-neutral-400 leading-relaxed">No paper tickets. License plate recognition reads your vehicle and lifts gates instantly.</p>
                    </div>
                </div>

                <!-- Feature 2: High Security -->
                <div class="glass-card rounded-3xl p-6 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-12 w-12 rounded-2xl bg-brand-purple/10 border border-brand-purple/20 flex items-center justify-center mb-6 text-brand-purple group-hover:bg-brand-purple group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">Ultimate Protection</h3>
                        <p class="text-sm text-neutral-400 leading-relaxed">Continuous HD video monitoring, night patrols, and modern hazard sensor systems.</p>
                    </div>
                </div>

                <!-- Feature 3: EV Charger -->
                <div class="glass-card rounded-3xl p-6 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-12 w-12 rounded-2xl bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center mb-6 text-brand-accent group-hover:bg-brand-accent group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">EV Supercharging</h3>
                        <p class="text-sm text-neutral-400 leading-relaxed">Level-3 superchargers available at premium slots. Check charge status directly on your phone.</p>
                    </div>
                </div>

                <!-- Feature 4: Valet service -->
                <div class="glass-card rounded-3xl p-6 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-12 w-12 rounded-2xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center mb-6 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">Smart Valet</h3>
                        <p class="text-sm text-neutral-400 leading-relaxed">Drop off your keys at the entrance. Your vehicle will be parked and returned securely.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 relative bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div class="space-y-2">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Active Spaces</span>
                <span class="text-4xl sm:text-5xl font-bold text-white counter-num block" data-target="2450">0</span>
            </div>
            <div class="space-y-2">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Reservations Completed</span>
                <span class="text-4xl sm:text-5xl font-bold text-white block">{{ $stats['total_bookings'] }}</span>
            </div>
            <div class="space-y-2">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Satisfaction Rating</span>
                <span class="text-4xl sm:text-5xl font-bold text-brand-cyan block">{{ $stats['happy_customers'] }}</span>
            </div>
            <div class="space-y-2">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Metro Cities</span>
                <span class="text-4xl sm:text-5xl font-bold text-white block">{{ $stats['cities'] }}</span>
            </div>
        </div>
    </section>

    <!-- Featured Parking Spots -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap items-end justify-between mb-16 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Curated Spaces</h2>
                    <p class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Popular Parking Garages</p>
                </div>
                <a href="{{ route('parking.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-cyan hover:text-brand-purple transition-colors">
                    Explore All Available Lots
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($parkingSpots as $spot)
                    <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $spot['image'] }}" alt="{{ $spot['name'] }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-dark-primary/80 backdrop-blur text-[11px] font-bold text-brand-cyan uppercase tracking-wider">
                                @if(($spot['currency_code'] ?? '') === 'JPY')
                                    {{ $spot['currency_symbol'] ?? '$' }}{{ number_format($spot['price_per_hour'], 0) }} / hr
                                @else
                                    {{ $spot['currency_symbol'] ?? '$' }}{{ number_format($spot['price_per_hour'], 2) }} / hr
                                @endif
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between gap-6">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-xs text-neutral-400">
                                    <span>{{ $spot['city'] }} ({{ $spot['area'] }})</span>
                                    <span class="flex items-center gap-0.5 text-brand-cyan">★ {{ $spot['rating'] }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-white">{{ $spot['name'] }}</h3>
                                <p class="text-sm text-neutral-400 line-clamp-2">{{ $spot['description'] }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-white/5">
                                <span class="text-xs text-neutral-500">🚘 {{ $spot['available_spots'] }} spaces free</span>
                                <a href="{{ route('parking.show', $spot['id']) }}" class="px-5 py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white text-dark-primary hover:border-white text-xs font-semibold text-white hover:text-dark-primary transition-all duration-300">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-dark-secondary relative overflow-hidden" x-data="{ 
        active: 0,
        testimonials: [
            { name: 'Sarah Jenkins', role: 'EV Driver', comment: 'The live chargers status are 100% correct. I reserved my spot while driving, plugged in immediately, and left. Unbelievable UX.' },
            { name: 'Arthur Pendelton', role: 'Daily Commuter', comment: 'Automated camera license scans mean I do not even have to roll down my window. Perfect execution and security.' },
            { name: 'Chloe Vance', role: 'Tesla Owner', comment: 'Saves me 15 minutes of looking for street spaces in downtown NYC every single day. The best app on my phone.' }
        ]
    }">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-12">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Client Endorsements</h2>
            
            <div class="relative min-h-36 flex items-center justify-center">
                <template x-for="(test, index) in testimonials" :key="index">
                    <div x-show="active === index" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute w-full space-y-6">
                        <p class="text-xl sm:text-2xl text-neutral-300 font-light italic leading-relaxed">
                            “<span x-text="test.comment"></span>”
                        </p>
                        <div>
                            <strong class="text-white block" x-text="test.name"></strong>
                            <span class="text-xs text-neutral-500" x-text="test.role"></span>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Carousel Controls -->
            <div class="flex items-center justify-center gap-3 pt-6">
                <template x-for="(test, index) in testimonials" :key="index">
                    <button 
                        @click="active = index" 
                        class="h-2 rounded-full transition-all duration-300"
                        :class="active === index ? 'w-8 bg-brand-cyan' : 'w-2 bg-white/20'"
                        :aria-label="'Go to slide ' + (index + 1)"
                    ></button>
                </template>
            </div>
        </div>
    </section>

    <!-- FAQ Preview Section -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-6 space-y-16">
            <div class="text-center space-y-4">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Frequently Asked</h2>
                <p class="text-3xl sm:text-4xl font-bold tracking-tight text-white">General Inquiries</p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                <!-- FAQ Item 1 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>How early can I book a parking spot?</span>
                        <svg class="h-5 w-5 transform transition-transform duration-300" :class="openFaq === 1 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse x-transition class="px-6 pb-6 text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-4">
                        You can book up to 30 days in advance on our website. Early bookings secure the best pricing brackets and guarantee premium locations.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>Can I cancel or modify my reservation?</span>
                        <svg class="h-5 w-5 transform transition-transform duration-300" :class="openFaq === 2 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse x-transition class="px-6 pb-6 text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-4">
                        Yes, reservations can be cancelled up to 2 hours before your scheduled entry time for a full refund. Simply visit your dashboard or link in the booking confirmation email.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>What payment methods do you accept?</span>
                        <svg class="h-5 w-5 transform transition-transform duration-300" :class="openFaq === 3 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse x-transition class="px-6 pb-6 text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-4">
                        We accept all major credit cards (Visa, Mastercard, American Express), Apple Pay, and Google Pay. All transactions are securely processed.
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
