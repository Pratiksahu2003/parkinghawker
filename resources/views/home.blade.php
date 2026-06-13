<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Premium Parking Booking Platform" 
            description="Find and book premium, secure parking spots with EV charging and valet services. Smooth automated check-ins and state-of-the-art security."
        />
    </x-slot>

    <!-- Fullscreen Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden py-10">
        <!-- Ambient glowing blobs -->
        <div class="absolute top-1/4 left-1/10 h-96 w-96 rounded-full bg-brand-cyan/10 blur-[120px] pointer-events-none reveal-fade"></div>
        <div class="absolute bottom-1/4 right-1/10 h-112 w-112 rounded-full bg-brand-purple/10 blur-[150px] pointer-events-none reveal-fade"></div>

        <div class="max-w-7xl mx-auto px-6 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
            <!-- Hero Left: Typography & Intro -->
            <div class="lg:col-span-7 space-y-4 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold tracking-wide text-brand-cyan uppercase reveal-fade">
                    <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                    Live Availability: 450+ Spots Free Now
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-white leading-tight reveal-up">
                    Modern Parking <br class="hidden sm:inline">
                    <span class="text-gradient-cyan-purple">Reimagined.</span>
                </h1>
                
                <p class="text-base text-neutral-400 max-w-xl mx-auto lg:mx-0 leading-relaxed reveal-up">
                    Secure an elite space instantly. Enjoy keyless entry scanning, lightning-fast level-3 EV supercharging, and professional valet services.
                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-0 reveal-up">
                    <a href="#search-section" class="magnetic-btn px-6 py-2.5 rounded-full bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm shadow-xl shadow-brand-cyan/25 hover:opacity-95 transition-all">
                        Reserve Your Spot
                    </a>
                    <a href="#features" class="px-5 py-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold text-sm transition-all">
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
                            <p class="text-xs text-neutral-400">Available at Mumbai Nariman Point Garage</p>
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
                                            {{ $svSpot['currency_symbol'] ?? '₹' }}{{ number_format($svSpot['price_per_hour'], 0) }} / hr
                                        @else
                                            {{ $svSpot['currency_symbol'] ?? '₹' }}{{ number_format($svSpot['price_per_hour'], 2) }} / hr
                                        @endif
                                    @else
                                        ₹150.00 / hr
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

    <!-- Google Ad Slot -->
    <div class="max-w-7xl mx-auto px-6">
        <x-ad-slot slot="home_top_banner" class="my-4" />
    </div>

    <!-- Search Form Section -->
    <section id="search-section" class="py-8 relative z-20 scroll-mt-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="glass-panel rounded-3xl p-6 shadow-2xl relative overflow-visible" x-data="{ 
                location: '',
                vehicleType: 'car',
                entryDate: '{{ date('Y-m-d') }}',
                entryTime: '08:00',
                exitDate: '{{ date('Y-m-d') }}',
                exitTime: '18:00',
                parkingType: 'all',
                evRequired: false,
                suggestions: [],
                allLocations: @js($locations),
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

                <h2 class="text-lg font-bold text-white mb-4 tracking-tight flex items-center gap-2">
                    <svg class="h-4.5 w-4.5 text-brand-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Custom Parking Reservation Form
                </h2>

                <form action="{{ route('parking.index') }}" method="GET" @submit="validateForm($event)" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Location & Suggestions -->
                        <div class="relative flex flex-col justify-end">
                            <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Where to Park</label>
                            <input 
                                type="text" 
                                name="city" 
                                x-model="location" 
                                @input="searchLocations()"
                                @focus="showSuggestions = true"
                                @click.away="showSuggestions = false"
                                placeholder="Enter city (e.g. Mumbai)" 
                                class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder-neutral-600 transition-colors"
                            >
                            <!-- Error display -->
                            <span x-show="errors.location" x-text="errors.location" class="text-xs text-red-400 mt-1 absolute -bottom-5" style="display: none;"></span>

                            <!-- Suggestion Dropdown -->
                            <div x-show="showSuggestions && suggestions.length > 0" class="absolute top-full left-0 right-0 mt-2 bg-dark-secondary border border-white/10 rounded-xl overflow-hidden shadow-2xl z-50" style="display: none;">
                                <template x-for="item in suggestions" :key="item">
                                    <button 
                                        type="button" 
                                        @click="selectSuggestion(item)"
                                        class="w-full px-4 py-2.5 text-left text-sm text-neutral-300 hover:bg-white/5 hover:text-brand-cyan transition-colors"
                                        x-text="item"
                                    ></button>
                                </template>
                            </div>
                        </div>

                        <!-- Vehicle Type Selection -->
                        <div class="flex flex-col justify-end">
                            <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Vehicle Type</label>
                            <select name="vehicle_type" x-model="vehicleType" class="w-full px-4 py-2.5 rounded-xl bg-dark-primary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                                <option value="car">Car (Sedan/Hatchback)</option>
                                <option value="suv">SUV / Truck</option>
                                <option value="motorcycle">Motorcycle</option>
                            </select>
                        </div>

                        <!-- Entry Date/Time -->
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col justify-end">
                                <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Entry Date</label>
                                <input type="date" name="entry_date" x-model="entryDate" class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <div class="flex flex-col justify-end">
                                <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Entry Time</label>
                                <input type="time" name="entry_time" x-model="entryTime" class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                        </div>

                        <!-- Exit Date/Time -->
                        <div class="grid grid-cols-2 gap-2 relative">
                            <div class="flex flex-col justify-end">
                                <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Exit Date</label>
                                <input type="date" name="exit_date" x-model="exitDate" class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <div class="flex flex-col justify-end">
                                <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Exit Time</label>
                                <input type="time" name="exit_time" x-model="exitTime" class="w-full px-3 py-2.5 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan transition-colors">
                            </div>
                            <!-- Error display -->
                            <span x-show="errors.dates" x-text="errors.dates" class="text-xs text-red-400 mt-1 absolute -bottom-5 left-0" style="display: none;"></span>
                        </div>
                    </div>

                    <!-- Lower filter row -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-white/5">
                        <div class="flex items-center gap-6">
                            <!-- Parking Type -->
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Decks:</span>
                                <select name="parking_type" x-model="parkingType" class="px-2.5 py-1.5 rounded-lg bg-dark-primary border border-white/10 text-neutral-300 text-xs focus:outline-none">
                                    <option value="all">All Decks</option>
                                    <option value="covered">Covered</option>
                                    <option value="underground">Underground</option>
                                    <option value="rooftop">Rooftop</option>
                                </select>
                            </div>

                            <!-- EV checkbox -->
                            <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="ev_charging" value="yes" x-model="evRequired" class="h-4.5 w-4.5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 focus:ring-offset-0">
                                <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">EV Charger</span>
                            </label>
                        </div>

                        <button type="submit" class="magnetic-btn w-full md:w-auto px-6 py-2.5 rounded-xl bg-brand-cyan hover:bg-brand-cyan/95 text-dark-primary font-bold text-sm tracking-wide shadow-lg transition-all">
                            Scan Available Slots
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-10 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-8 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Engineered Excellence</h2>
                <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Advanced Services Built for Comfort</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Feature 1: Smart Booking -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-11 w-11 rounded-2xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center mb-4 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-md font-bold text-white mb-1.5">Automated Check-in</h3>
                        <p class="text-xs text-neutral-400 leading-relaxed">No paper tickets. License plate recognition reads your vehicle and lifts gates instantly.</p>
                    </div>
                </div>

                <!-- Feature 2: High Security -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-11 w-11 rounded-2xl bg-brand-purple/10 border border-brand-purple/20 flex items-center justify-center mb-4 text-brand-purple group-hover:bg-brand-purple group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-md font-bold text-white mb-1.5">Ultimate Protection</h3>
                        <p class="text-xs text-neutral-400 leading-relaxed">Continuous HD video monitoring, night patrols, and modern hazard sensor systems.</p>
                    </div>
                </div>

                <!-- Feature 3: EV Charger -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-11 w-11 rounded-2xl bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center mb-4 text-brand-accent group-hover:bg-brand-accent group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-md font-bold text-white mb-1.5">EV Supercharging</h3>
                        <p class="text-xs text-neutral-400 leading-relaxed">Level-3 superchargers available at premium slots. Check charge status directly on your phone.</p>
                    </div>
                </div>

                <!-- Feature 4: Valet service -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden flex flex-col justify-between group">
                    <div class="h-11 w-11 rounded-2xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center mb-4 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-dark-primary transition-all duration-300">
                        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-md font-bold text-white mb-1.5">Smart Valet</h3>
                        <p class="text-xs text-neutral-400 leading-relaxed">Drop off your keys at the entrance. Your vehicle will be parked and returned securely.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section A: How It Works (Interactive Process Stepper) -->
    <section class="py-10 relative overflow-hidden bg-dark-secondary/40 border-t border-b border-white/5" x-data="{ currentStep: 1 }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-8 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Seamless Transit</h2>
                <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">How Smart Parking Works</p>
            </div>

            <!-- Stepper Buttons -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <button @click="currentStep = 1" :class="currentStep === 1 ? 'border-brand-cyan bg-brand-cyan/5 text-brand-cyan' : 'border-white/5 bg-white/5 text-neutral-400 hover:text-white'" class="flex items-center gap-3 p-3.5 rounded-2xl border text-left transition-all duration-300">
                    <span class="text-lg font-bold font-mono">01</span>
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider">Search & Filter</span>
                        <span class="block text-[9px] text-neutral-500 font-normal mt-0.5">Find nearby spots</span>
                    </div>
                </button>
                <button @click="currentStep = 2" :class="currentStep === 2 ? 'border-brand-cyan bg-brand-cyan/5 text-brand-cyan' : 'border-white/5 bg-white/5 text-neutral-400 hover:text-white'" class="flex items-center gap-3 p-3.5 rounded-2xl border text-left transition-all duration-300">
                    <span class="text-lg font-bold font-mono">02</span>
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider">Book Spot</span>
                        <span class="block text-[9px] text-neutral-500 font-normal mt-0.5">Add EV & detailing</span>
                    </div>
                </button>
                <button @click="currentStep = 3" :class="currentStep === 3 ? 'border-brand-cyan bg-brand-cyan/5 text-brand-cyan' : 'border-white/5 bg-white/5 text-neutral-400 hover:text-white'" class="flex items-center gap-3 p-3.5 rounded-2xl border text-left transition-all duration-300">
                    <span class="text-lg font-bold font-mono">03</span>
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider">Get Smart Pass</span>
                        <span class="block text-[9px] text-neutral-500 font-normal mt-0.5">Voucher in portal</span>
                    </div>
                </button>
                <button @click="currentStep = 4" :class="currentStep === 4 ? 'border-brand-cyan bg-brand-cyan/5 text-brand-cyan' : 'border-white/5 bg-white/5 text-neutral-400 hover:text-white'" class="flex items-center gap-3 p-3.5 rounded-2xl border text-left transition-all duration-300">
                    <span class="text-lg font-bold font-mono">04</span>
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider">Park & Charge</span>
                        <span class="block text-[9px] text-neutral-500 font-normal mt-0.5">Scan-in check-in</span>
                    </div>
                </button>
            </div>

            <!-- Stepper Content Cards -->
            <div class="glass-panel rounded-3xl p-6 relative overflow-hidden">
                <div x-show="currentStep === 1" x-transition.opacity.duration.300ms class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                    <div class="md:col-span-6 space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-[10px] font-bold uppercase text-brand-cyan">Phase One: Search</span>
                        <h4 class="text-2xl font-bold text-white">Find Your Perfect Spot Instantly</h4>
                        <p class="text-sm text-neutral-400 leading-relaxed">
                            Enter your destination city and date/time. Our smart engine filters covered, underground, or open decks, matching vehicle limits, heights, and security standards.
                        </p>
                        <ul class="space-y-2 text-xs text-neutral-300">
                            <li class="flex items-center gap-2">✔ Filter by EV Charging, valet services, or security guards</li>
                            <li class="flex items-center gap-2">✔ Live distance updates to your final destination</li>
                            <li class="flex items-center gap-2">✔ Check peak hourly rates and real-time occupancy</li>
                        </ul>
                    </div>
                    <div class="md:col-span-6 flex justify-center">
                        <div class="relative bg-dark-primary/60 border border-white/5 rounded-2xl p-6 w-full max-w-sm font-mono text-xs text-neutral-400 space-y-4">
                            <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                <span class="text-brand-cyan font-bold">query_status.bin</span>
                                <span class="h-2 w-2 rounded-full bg-brand-cyan animate-pulse"></span>
                            </div>
                            <div class="space-y-1">
                                <p>&gt; Scanning Mumbai Bandra Kurla Complex...</p>
                                <p class="text-brand-accent">&gt; 3 garages found with EV level-3 capacity</p>
                                <p>&gt; Sorting by closest distance (120m, 180m, 290m)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="currentStep === 2" x-transition.opacity.duration.300ms class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center" style="display: none;">
                    <div class="md:col-span-6 space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-brand-purple/10 border border-brand-purple/20 text-[10px] font-bold uppercase text-brand-purple">Phase Two: Reservation</span>
                        <h4 class="text-2xl font-bold text-white">Customize & Confirm Details</h4>
                        <p class="text-sm text-neutral-400 leading-relaxed">
                            Select check-in add-ons. Need a quick top-up charge while you attend a meeting? Opt for EV Supercharging. Want a pristine vehicle upon return? Add a professional waterless car wash.
                        </p>
                        <ul class="space-y-2 text-xs text-neutral-300">
                            <li class="flex items-center gap-2">✔ Flexible parking options (hourly, daily, monthly billing)</li>
                            <li class="flex items-center gap-2">✔ Complete insurance add-ons up to ₹2,00,000</li>
                            <li class="flex items-center gap-2">✔ Secure checkout using cards, UPI, net banking</li>
                        </ul>
                    </div>
                    <div class="md:col-span-6 flex justify-center">
                        <div class="relative bg-dark-primary/60 border border-white/5 rounded-2xl p-6 w-full max-w-sm font-mono text-xs text-neutral-400 space-y-3">
                            <div class="flex justify-between text-white border-b border-white/5 pb-2 font-bold">
                                <span>Reservation Addons</span>
                                <span>Selected</span>
                            </div>
                            <div class="flex justify-between">
                                <span>1x Premium Spot BKC</span>
                                <span class="text-white">₹150.00 / hr</span>
                            </div>
                            <div class="flex justify-between text-brand-cyan">
                                <span>+ Level-3 EV Plug</span>
                                <span>₹150.00 (Fixed)</span>
                            </div>
                            <div class="flex justify-between text-brand-purple">
                                <span>+ Eco Waterless Wash</span>
                                <span>₹300.00 (Fixed)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="currentStep === 3" x-transition.opacity.duration.300ms class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center" style="display: none;">
                    <div class="md:col-span-6 space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/20 text-[10px] font-bold uppercase text-brand-accent">Phase Three: Pass Code</span>
                        <h4 class="text-2xl font-bold text-white">Receive Your Smart Gate Pass</h4>
                        <p class="text-sm text-neutral-400 leading-relaxed">
                            Once booked, a digital boarding pass is instantly generated. This contains your slot location details, navigation link, entry/exit guidelines, and a high-security encrypted QR code.
                        </p>
                        <ul class="space-y-2 text-xs text-neutral-300">
                            <li class="flex items-center gap-2">✔ Digital PDF or print-ready gate check pass</li>
                            <li class="flex items-center gap-2">✔ Integrated Apple and Google Wallet pass sync</li>
                            <li class="flex items-center gap-2">✔ Real-time status update link</li>
                        </ul>
                    </div>
                    <div class="md:col-span-6 flex justify-center">
                        <div class="bg-gradient-to-tr from-brand-cyan to-brand-purple p-0.5 rounded-2xl shadow-xl w-60 overflow-hidden">
                            <div class="bg-dark-primary rounded-[14px] p-5 text-center space-y-4 text-xs">
                                <span class="text-xxs uppercase tracking-wider text-brand-cyan font-bold">Digital Smart Pass</span>
                                <div class="bg-white p-3 rounded-lg flex items-center justify-center">
                                    <!-- Embedded Mock Passcode QR Code SVG -->
                                    <svg class="h-28 w-28 text-dark-primary" viewBox="0 0 100 100" fill="currentColor">
                                        <path d="M5,5 h30 v30 h-30 z M10,10 v20 h20 v-20 z M15,15 h10 v10 h-10 z M65,5 h30 v30 h-30 z M70,10 v20 h20 v-20 z M75,15 h10 v10 h-10 z M5,65 h30 v30 h-30 z M10,70 v20 h20 v-20 z M15,75 h10 v10 h-10 z M45,45 h10 v10 h-10 z M55,55 h10 v10 h-10 z M45,65 h10 v10 h-10 z M75,45 h10 v15 h-10 z M65,75 h10 v10 h-10 z M75,75 h20 v20 h-20 z M85,85 h5 v5 h-5 z"/>
                                    </svg>
                                </div>
                                <span class="font-mono text-white block tracking-widest text-[11px]">PASS-7782-HKR</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="currentStep === 4" x-transition.opacity.duration.300ms class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center" style="display: none;">
                    <div class="md:col-span-6 space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-[10px] font-bold uppercase text-brand-cyan">Phase Four: Access</span>
                        <h4 class="text-2xl font-bold text-white">Automated Entry Verification</h4>
                        <p class="text-sm text-neutral-400 leading-relaxed">
                            Drive up to the gate. Advanced optical cameras read your registered license plate, or scan the QR pass at the console. The barrier lifts within 1.5 seconds. Pull in and relax.
                        </p>
                        <ul class="space-y-2 text-xs text-neutral-300">
                            <li class="flex items-center gap-2">✔ Zero-contact, ticketless scan-in system</li>
                            <li class="flex items-center gap-2">✔ Automated charging activation upon plug-in</li>
                            <li class="flex items-center gap-2">✔ 24/7 security attendant checks for complete protection</li>
                        </ul>
                    </div>
                    <div class="md:col-span-6 flex justify-center">
                        <div class="relative bg-dark-primary/60 border border-white/5 rounded-2xl p-6 w-full max-w-sm text-center space-y-3">
                            <span class="text-xxs uppercase tracking-wider text-neutral-500 font-bold block">Plate Scanner Terminal</span>
                            <div class="inline-block px-5 py-2.5 rounded bg-slate-900 border border-white/10 text-white font-mono font-bold text-sm tracking-wider">
                                MH 12 PK 8842
                            </div>
                            <span class="text-brand-accent text-xs font-bold block animate-pulse">✓ Verification Successful. Gate Opening.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section B: EV Charging Infrastructure Grid & Simulator -->
    <section class="py-10 relative overflow-hidden" x-data="{ 
        charging: false, 
        percent: 45, 
        speed: 150, 
        cost: 0, 
        timer: null,
        toggleCharging() {
            this.charging = !this.charging;
            if(this.charging) {
                this.timer = setInterval(() => {
                    if(this.percent < 100) {
                        this.percent += 1;
                        this.cost = (this.cost + 4.25);
                    } else {
                        clearInterval(this.timer);
                        this.charging = false;
                    }
                }, 1000);
            } else {
                clearInterval(this.timer);
            }
        }
    }">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Specs & Info -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/20 text-xs font-semibold tracking-wide text-brand-accent uppercase">
                    <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                    Green Infrastructure Active
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white leading-tight">
                    Level-3 DC Supercharging <br>
                    <span class="text-gradient-cyan-purple">At Your Fingertips.</span>
                </h2>
                
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Leave your electric vehicle parked and connected to our ultra-fast DC dispensers. Our infrastructure operates on clean energy, replenishing battery cells efficiently while protecting battery lifespan.
                </p>

                <!-- Plug Specs Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div class="p-3 rounded-2xl bg-white/5 border border-white/5 space-y-1">
                        <span class="text-[10px] uppercase font-bold text-neutral-500 block">Fast Charge Specs</span>
                        <strong class="text-white text-md block">150 kW DC Fast</strong>
                        <span class="text-[10px] text-brand-cyan block">CCS2 Compatible</span>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/5 border border-white/5 space-y-1">
                        <span class="text-[10px] uppercase font-bold text-neutral-500 block">Medium Charge Specs</span>
                        <strong class="text-white text-md block">50 kW DC</strong>
                        <span class="text-[10px] text-brand-purple block">CCS2 Compatible</span>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/5 border border-white/5 space-y-1">
                        <span class="text-[10px] uppercase font-bold text-neutral-500 block">Standard Charge Specs</span>
                        <strong class="text-white text-md block">22 kW AC</strong>
                        <span class="text-[10px] text-brand-accent block">Type 2 Connector</span>
                    </div>
                </div>
            </div>

            <!-- Live Simulator Interactive Card -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="glass-card w-full max-w-sm p-5 rounded-3xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:16px_16px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/5 pb-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-neutral-500">Live Charger Simulation</span>
                            <span class="px-2 py-0.5 rounded bg-brand-accent/15 border border-brand-accent/20 text-[9px] font-mono text-brand-accent font-bold">DC Bay #12</span>
                        </div>

                        <!-- Graphic Gauge -->
                        <div class="flex flex-col items-center justify-center py-2 relative">
                            <!-- Circular status border decoration -->
                            <div class="h-28 w-28 rounded-full border-4 border-white/5 flex items-center justify-center relative">
                                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-brand-cyan border-r-brand-cyan transition-all duration-1000" :style="'transform: rotate(' + (percent * 3.6) + 'deg)'"></div>
                                <div class="text-center">
                                    <span class="text-2xl font-extrabold text-white tracking-tight" x-text="percent + '%'">45%</span>
                                    <span class="text-[9px] text-neutral-500 block uppercase font-bold mt-0.5">Battery Level</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar & Rates -->
                        <div class="space-y-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-neutral-400">Power Speed</span>
                                <span class="text-white font-bold" x-text="speed + ' kW DC'">150 kW DC</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-neutral-400">Accrued Cost</span>
                                <span class="text-brand-accent font-bold" x-text="'₹' + cost.toFixed(2)">₹0.00</span>
                            </div>
                            
                            <!-- Trigger Button -->
                            <button type="button" @click="toggleCharging()" :class="charging ? 'bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20' : 'bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan hover:bg-brand-cyan/20'" class="w-full py-2.5 rounded-xl font-bold text-xs tracking-wider uppercase transition-all duration-300">
                                <span x-text="charging ? '🛑 Stop Charging Session' : '⚡ Simulate Charger Plug-In'">⚡ Simulate Charger Plug-In</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-10 relative bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="space-y-1">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Active Spaces</span>
                <span class="text-3xl sm:text-4xl font-bold text-white counter-num block" data-target="2450">0</span>
            </div>
            <div class="space-y-1">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Reservations Done</span>
                <span class="text-3xl sm:text-4xl font-bold text-white block">{{ $stats['total_bookings'] }}</span>
            </div>
            <div class="space-y-1">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Satisfaction Rating</span>
                <span class="text-3xl sm:text-4xl font-bold text-brand-cyan block">{{ $stats['happy_customers'] }}</span>
            </div>
            <div class="space-y-1">
                <span class="text-neutral-500 font-semibold uppercase tracking-wider text-xs block">Metro Cities</span>
                <span class="text-3xl sm:text-4xl font-bold text-white block">{{ $stats['cities'] }}</span>
            </div>
        </div>
    </section>

    <!-- Featured Parking Spots -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap items-end justify-between mb-8 gap-6">
                <div class="space-y-3">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Curated Spaces</h2>
                    <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Popular Parking Garages</p>
                </div>
                <a href="{{ route('parking.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-cyan hover:text-brand-purple transition-colors">
                    Explore All Available Lots
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($parkingSpots as $spot)
                    <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $spot['image'] }}" alt="{{ $spot['name'] }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-dark-primary/80 backdrop-blur text-[11px] font-bold text-brand-cyan uppercase tracking-wider">
                                @if(($spot['currency_code'] ?? '') === 'JPY')
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }} / hr
                                @else
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }} / hr
                                @endif
                            </span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-xs text-neutral-400">
                                    <span>{{ $spot['city'] }} ({{ $spot['area'] }})</span>
                                    <span class="flex items-center gap-0.5 text-brand-cyan">★ {{ $spot['rating'] }}</span>
                                </div>
                                <h3 class="text-md font-bold text-white">{{ $spot['name'] }}</h3>
                                <p class="text-xs text-neutral-400 line-clamp-2">{{ $spot['description'] }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between pt-3 border-t border-white/5">
                                <span class="text-xs text-neutral-500">🚘 {{ $spot['available_spots'] }} spaces free</span>
                                <a href="{{ route('parking.show', $spot['id']) }}" class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white text-dark-primary hover:border-white text-xs font-semibold text-white hover:text-dark-primary transition-all duration-300">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section C: Driveway Hosting Earnings Calculator -->
    <section class="py-10 relative overflow-hidden bg-dark-secondary/20 border-t border-b border-white/5" x-data="{ 
        hours: 8, 
        days: 5, 
        city: 'mumbai',
        getEstimate() {
            let baseRate = 80; 
            if (this.city === 'mumbai') baseRate = 120;
            else if (this.city === 'delhi') baseRate = 100;
            else if (this.city === 'bengaluru') baseRate = 90;
            else if (this.city === 'pune') baseRate = 70;
            else if (this.city === 'kolkata') baseRate = 60;
            
            let weekly = this.hours * this.days * baseRate;
            let monthly = Math.round(weekly * 4.33);
            let yearly = monthly * 12;
 
            return {
                weekly: weekly.toLocaleString('en-IN'),
                monthly: monthly.toLocaleString('en-IN'),
                yearly: yearly.toLocaleString('en-IN')
            };
        }
    }">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Details left -->
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-purple">Monetize Empty Space</span>
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white leading-tight">
                    Turn Your Idle Driveway <br>
                    Into <span class="text-gradient-cyan-purple">Passive Income.</span>
                </h2>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Have a vacant parking spot, garage, or front driveway? Join our national network of parking hosts. Simply set your pricing, specify when your spot is available, and scan cars in automatically using our platform controls.
                </p>

                <div class="space-y-3">
                    <div class="flex items-start gap-3 text-xs">
                        <span class="text-brand-cyan">✔</span>
                        <div>
                            <strong class="text-white block font-bold">100% Control</strong>
                            <span class="text-neutral-500">Decide exactly who parks and when. Pause or modify availability in one tap.</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-xs">
                        <span class="text-brand-purple">✔</span>
                        <div>
                            <strong class="text-white block font-bold">Automated Payments</strong>
                            <span class="text-neutral-500">Earnings accrue per second. Withdraw directly to your linked bank account.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calculator right -->
            <div class="lg:col-span-6 flex justify-center">
                <div class="glass-panel w-full max-w-md p-6 rounded-3xl relative overflow-hidden">
                    <h3 class="text-md font-bold text-white mb-4">Estimate Your Earnings</h3>

                    <div class="space-y-4">
                        <!-- City selection -->
                        <div class="flex flex-col">
                            <label class="text-[11px] font-semibold text-neutral-400 mb-1.5 uppercase tracking-wider">Select Spot Location</label>
                            <select x-model="city" class="px-4 py-2.5 rounded-xl bg-dark-primary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                <option value="mumbai">Mumbai (Bandra/Colaba)</option>
                                <option value="delhi">New Delhi (CP/Dwarka)</option>
                                <option value="bengaluru">Bengaluru (Indiranagar)</option>
                                <option value="pune">Pune (Koregaon Park)</option>
                                <option value="kolkata">Kolkata (Salt Lake)</option>
                            </select>
                        </div>

                        <!-- Hours range -->
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-[11px] font-semibold text-neutral-400 uppercase tracking-wider">Hours Shared Per Day</label>
                                <span class="text-xs font-bold text-brand-cyan" x-text="hours + ' hrs'">8 hrs</span>
                            </div>
                            <input type="range" min="1" max="24" x-model="hours" class="w-full h-1 bg-white/5 rounded-lg appearance-none cursor-pointer accent-brand-cyan">
                        </div>

                        <!-- Days range -->
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-[11px] font-semibold text-neutral-400 uppercase tracking-wider">Days Shared Per Week</label>
                                <span class="text-xs font-bold text-brand-purple" x-text="days + ' days'">5 days</span>
                            </div>
                            <input type="range" min="1" max="7" x-model="days" class="w-full h-1 bg-white/5 rounded-lg appearance-none cursor-pointer accent-brand-purple">
                        </div>

                        <!-- Estimates outputs -->
                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/5 text-center">
                            <div>
                                <span class="text-[10px] text-neutral-500 uppercase tracking-wider font-bold block">Weekly</span>
                                <strong class="text-white text-sm font-bold block mt-1" x-text="'₹' + getEstimate().weekly">₹0</strong>
                            </div>
                            <div>
                                <span class="text-[10px] text-neutral-500 uppercase tracking-wider font-bold block">Monthly</span>
                                <strong class="text-brand-cyan text-md font-extrabold block mt-0.5" x-text="'₹' + getEstimate().monthly">₹0</strong>
                            </div>
                            <div>
                                <span class="text-[10px] text-neutral-500 uppercase tracking-wider font-bold block">Yearly Est.</span>
                                <strong class="text-brand-purple text-md font-bold block mt-1" x-text="'₹' + getEstimate().yearly">₹0</strong>
                            </div>
                        </div>

                        <a href="{{ route('contact') }}" class="block text-center py-4 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm tracking-wide shadow-lg shadow-brand-cyan/15 hover:opacity-95 transition-all mt-4">
                            Start Hosting Driveway
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section D: City Occupancy & Live Spot Metrics -->
    <section class="py-10 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-8 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Live Metrics</h2>
                <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">National Capacity Status</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Mumbai -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden space-y-4">
                    <div class="flex items-center justify-between border-b border-white/5 pb-3">
                        <strong class="text-white text-md">Mumbai Metro</strong>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-cyan opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-cyan"></span>
                        </span>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Total Managed Lots</span>
                            <span class="text-white font-semibold">4 Garages (1,250 slots)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Average Occupancy</span>
                            <span class="text-brand-cyan font-bold">84% Occupied</span>
                        </div>
                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden mt-1">
                            <div class="bg-brand-cyan h-full rounded-full" style="width: 84%"></div>
                        </div>
                    </div>
                </div>

                <!-- New Delhi -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden space-y-4">
                    <div class="flex items-center justify-between border-b border-white/5 pb-3">
                        <strong class="text-white text-md">New Delhi CP Zone</strong>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-purple opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-purple"></span>
                        </span>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Total Managed Lots</span>
                            <span class="text-white font-semibold">3 Garages (900 slots)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Average Occupancy</span>
                            <span class="text-brand-purple font-bold">68% Occupied</span>
                        </div>
                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden mt-1">
                            <div class="bg-brand-purple h-full rounded-full" style="width: 68%"></div>
                        </div>
                    </div>
                </div>

                <!-- Bengaluru -->
                <div class="glass-card rounded-3xl p-5 relative overflow-hidden space-y-4">
                    <div class="flex items-center justify-between border-b border-white/5 pb-3">
                        <strong class="text-white text-md">Bengaluru Region</strong>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-accent opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-accent"></span>
                        </span>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Total Managed Lots</span>
                            <span class="text-white font-semibold">3 Garages (750 slots)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-400">Average Occupancy</span>
                            <span class="text-brand-accent font-bold">75% Occupied</span>
                        </div>
                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden mt-1">
                            <div class="bg-brand-accent h-full rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-10 bg-dark-secondary relative overflow-hidden" x-data="{ 
        active: 0,
        testimonials: [
            { name: 'Sarah Jenkins', role: 'EV Driver', comment: 'The live chargers status are 100% correct. I reserved my spot while driving, plugged in immediately, and left. Unbelievable UX.' },
            { name: 'Arthur Pendelton', role: 'Daily Commuter', comment: 'Automated camera license scans mean I do not even have to roll down my window. Perfect execution and security.' },
            { name: 'Chloe Vance', role: 'Tesla Owner', comment: 'Saves me 15 minutes of looking for street spaces in downtown NYC every single day. The best app on my phone.' }
        ]
    }">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-6">
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

    <!-- Section E: Trust, Safety & Insurance Guarantee -->
    <section class="py-10 relative overflow-hidden bg-dark-secondary/40 border-t border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-8 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Guaranteed Safety</h2>
                <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Drive & Park with Absolute Peace of Mind</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Insurance -->
                <div class="glass-panel rounded-3xl p-5 space-y-3 relative overflow-hidden">
                    <span class="text-4xl block mb-2">🛡</span>
                    <h3 class="text-lg font-bold text-white">₹2,00,000 Damage Cover</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed">
                        Every reservation is backed by our comprehensive damage shield policy. Your vehicle is protected against accidental scrapes, vandalism, or theft during the booking period.
                    </p>
                </div>

                <!-- Card 2: Verification -->
                <div class="glass-panel rounded-3xl p-5 space-y-3 relative overflow-hidden">
                    <span class="text-4xl block mb-2">🔍</span>
                    <h3 class="text-lg font-bold text-white">14-Point Space Inspection</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed">
                        We manually check structural integrity, accessibility, overhead clearances, street-level hazards, lighting density, and camera blindspots before listing any parking space.
                    </p>
                </div>

                <!-- Card 3: CCTV surveillance -->
                <div class="glass-panel rounded-3xl p-5 space-y-3 relative overflow-hidden">
                    <span class="text-4xl block mb-2">📹</span>
                    <h3 class="text-lg font-bold text-white">24/7 Remote Video Patrols</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed">
                        Our centralized operations center monitors garage live feeds. Any anomalous entry or movement triggers an immediate alert to local municipal responders.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section F: Mobile App Connectivity & Integration Banner -->
    <section class="py-10 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-slate-900 to-brand-purple/20 border border-white/5 p-6 sm:p-8 lg:p-10">
                <!-- Ambient glow inside card -->
                <div class="absolute -bottom-40 -left-40 h-80 w-80 rounded-full bg-brand-cyan/20 blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-semibold tracking-wide text-brand-cyan uppercase">
                            📱 Smart App Integration
                        </span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                            Elevate Your Commute. <br>
                            Get the ParkHawker App.
                        </h2>
                        <p class="text-xs sm:text-sm text-neutral-400 max-w-xl leading-relaxed">
                            Control gates directly using secure Bluetooth triggers, receive notifications when EV charging is complete, check lock-screen timers, and navigate using Apple or Google Maps APIs.
                        </p>
                        
                        <div class="flex flex-wrap gap-4 pt-2">
                            <!-- Download App Store -->
                            <a href="#" class="px-5 py-3.5 rounded-xl bg-white text-dark-primary font-bold text-xs hover:bg-neutral-200 transition-colors flex items-center gap-2.5">
                                <span>🍏 Download for iOS</span>
                            </a>
                            <!-- Download Play Store -->
                            <a href="#" class="px-5 py-3.5 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-bold text-xs transition-colors flex items-center gap-2.5">
                                <span>🤖 Download for Android</span>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-4 flex justify-center lg:justify-end">
                        <!-- Simulated Lockscreen Widget Mockup -->
                        <div class="w-64 bg-slate-900/90 border border-white/15 rounded-3xl p-5 shadow-2xl space-y-4">
                            <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                <span class="text-[9px] uppercase tracking-wider text-neutral-500 font-bold">Lockscreen Widget</span>
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-cyan animate-pulse"></span>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-xl">🚘</span>
                                <div>
                                    <strong class="text-white text-xs block">Bandra BKC Spot A-12</strong>
                                    <span class="text-[10px] text-neutral-400">Reservation ends in <strong class="text-brand-cyan font-mono">02:14:52</strong></span>
                                </div>
                            </div>
                            <!-- Unlock barrier slider simulator mock -->
                            <div class="bg-white/5 border border-white/10 rounded-xl p-2.5 text-center text-[10px] font-bold text-brand-cyan cursor-pointer hover:bg-white/10 transition-colors">
                                📶 Tap to Open Smart Entry Gate
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Preview Section -->
    <section class="py-10">
        <div class="max-w-4xl mx-auto px-6 space-y-8">
            <div class="text-center space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Frequently Asked</h2>
                <p class="text-2xl sm:text-3xl font-bold tracking-tight text-white">General Inquiries</p>
            </div>

            <div class="space-y-3" x-data="{ openFaq: null }">
                <!-- FAQ Item 1 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-3.5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>How early can I book a parking spot?</span>
                        <svg class="h-5 w-5 transform transition-transform duration-300" :class="openFaq === 1 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse x-transition class="px-6 pb-4 text-xs sm:text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-3">
                        You can book up to 30 days in advance on our website. Early bookings secure the best pricing brackets and guarantee premium locations.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-3.5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>Can I cancel or modify my reservation?</span>
                        <svg class="h-4.5 w-4.5 transform transition-transform duration-300" :class="openFaq === 2 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse x-transition class="px-6 pb-4 text-xs sm:text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-3">
                        Yes, reservations can be cancelled up to 2 hours before your scheduled entry time for a full refund. Simply visit your dashboard or link in the booking confirmation email.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-3.5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none">
                        <span>What payment methods do you accept?</span>
                        <svg class="h-4.5 w-4.5 transform transition-transform duration-300" :class="openFaq === 3 ? 'rotate-180 text-brand-cyan' : 'text-neutral-500'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse x-transition class="px-6 pb-4 text-xs sm:text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-3">
                        We accept all major credit cards (Visa, Mastercard, American Express), Apple Pay, and Google Pay. All transactions are securely processed.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Ad Slot -->
    <div class="max-w-7xl mx-auto px-6 pb-12">
        <x-ad-slot slot="home_bottom_banner" class="my-6" />
    </div>

</x-public-layout>
