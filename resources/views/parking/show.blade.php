<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="{{ $spot['name'] }}" 
            description="{{ $spot['description'] }}"
            image="{{ $spot['image'] }}"
        />
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-5" x-data="{ 
        activeImg: '{{ $spot['image'] }}',
        images: [
            '{{ $spot['image'] }}',
            'https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=800'
        ]
    }">
        <!-- Breadcrumb -->
        <nav class="flex text-xs text-neutral-500 gap-2 mb-3 uppercase tracking-wider">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('parking.index') }}" class="hover:text-white transition-colors">Locations</a>
            <span>/</span>
            <span class="text-neutral-300 font-medium">{{ $spot['name'] }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <!-- Left Side: Gallery & Spot Info -->
            <div class="lg:col-span-8 space-y-5">
                <!-- Gallery Showcase -->
                <div class="space-y-3">
                    <div class="relative h-[300px] w-full rounded-3xl overflow-hidden border border-white/5 shadow-2xl">
                        <img :src="activeImg" alt="{{ $spot['name'] }}" class="w-full h-full object-cover transition-all duration-500">
                    </div>
                    <!-- Thumbnails -->
                    <div class="flex gap-2.5">
                        <template x-for="(img, idx) in images" :key="idx">
                            <button 
                                @click="activeImg = img" 
                                class="h-14 w-20 rounded-2xl overflow-hidden border-2 transition-all focus:outline-none"
                                :class="activeImg === img ? 'border-brand-cyan scale-[0.98]' : 'border-transparent opacity-60 hover:opacity-100'"
                            >
                                <img :src="img" alt="Gallery thumbnail" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Spot description & details -->
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-brand-cyan">📍 {{ $spot['city'] }} ({{ $spot['area'] }})</span>
                            <div class="flex items-center gap-1 text-sm font-bold text-white">
                                <span class="text-brand-cyan">★</span> {{ $spot['rating'] }} <span class="text-xs text-neutral-500 font-medium">({{ $spot['reviews_count'] }} ratings)</span>
                            </div>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">{{ $spot['name'] }}</h1>
                        <p class="text-sm text-neutral-500 font-medium">{{ $spot['address'] }}</p>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-lg font-bold text-white">About the Facility</h3>
                        <p class="text-sm text-neutral-400 leading-relaxed">{{ $spot['description'] }}</p>
                    </div>

                    <!-- Google Ad Slot -->
                    <x-ad-slot slot="parking_show_middle" class="my-4" />

                    <!-- Amenities Grid -->
                    <div class="space-y-3 pt-3 border-t border-white/5">
                        <h3 class="text-lg font-bold text-white">Offered Amenities</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                            @foreach($spot['amenities'] as $key => $available)
                                <div class="flex items-center gap-2.5 p-3 rounded-2xl border transition-colors {{ $available ? 'bg-white/5 border-white/10 text-white' : 'bg-transparent border-white/5 text-neutral-600' }}">
                                    @if($key === 'ev_charging')
                                        <span class="text-md">⚡</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">EV Charging</span>
                                    @elseif($key === 'valet')
                                        <span class="text-md">🚗</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">Smart Valet</span>
                                    @elseif($key === 'security_cctv')
                                        <span class="text-md">🛡️</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">24/7 Guards & CCTV</span>
                                    @elseif($key === 'wash')
                                        <span class="text-md">🧼</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">Premium Wash</span>
                                    @elseif($key === 'wheelchair')
                                        <span class="text-md">♿</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">Handicap Access</span>
                                    @elseif($key === 'tailored_help')
                                        <span class="text-md">🤝</span>
                                        <span class="text-xs font-semibold uppercase tracking-wider">Staff Support</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Safety Checklist & EV Specs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-white/5">
                        <!-- Safety checklist -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-white">Security Checklist</h3>
                            <ul class="space-y-1.5 text-xs text-neutral-400">
                                <li class="flex items-center gap-2 text-brand-accent">✓ 24/7 Remote Video Monitoring</li>
                                <li class="flex items-center gap-2 text-brand-accent">✓ Guard Patrols on Ground</li>
                                <li class="flex items-center gap-2 text-brand-accent">✓ Hazard & Fire Suppression Systems</li>
                                <li class="flex items-center gap-2 text-brand-accent">✓ Well-Lit Covered Pedestrian Ramps</li>
                            </ul>
                        </div>

                        <!-- EV Details -->
                        @if($spot['amenities']['ev_charging'])
                            <div class="space-y-2">
                                <h3 class="text-lg font-bold text-white">EV Charger Details</h3>
                                <div class="bg-white/5 border border-white/10 rounded-2xl p-3 text-xs space-y-1.5">
                                    <div class="flex justify-between">
                                        <span class="text-neutral-500">Dispenser Power</span>
                                        <strong class="text-white font-bold">150 kW DC Fast</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-neutral-500">Connector Interface</span>
                                        <strong class="text-brand-cyan font-bold">CCS Type 2</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-neutral-500">Charging Surcharge</span>
                                        <strong class="text-white font-bold">{{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['ev_fee'] ?? 150, 2) }} flat</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Rules list -->
                    <div class="space-y-2 pt-3 border-t border-white/5">
                        <h3 class="text-lg font-bold text-white">Facility Regulations</h3>
                        <ul class="space-y-2">
                            @foreach($spot['rules'] as $rule)
                                <li class="flex items-start gap-2 text-sm text-neutral-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-brand-cyan mt-2"></span>
                                    <span>{{ $rule }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Reviews list -->
                    <div class="space-y-4 pt-3 border-t border-white/5">
                        <h3 class="text-lg font-bold text-white">Visitor Reviews</h3>
                        <div class="space-y-3">
                            @foreach($spot['reviews'] as $rev)
                                <div class="glass-card rounded-2xl p-3.5 border border-white/5 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <strong class="text-sm text-white block">{{ $rev['user'] }}</strong>
                                            <span class="text-[10px] text-neutral-500 uppercase tracking-wider">{{ $rev['date'] }}</span>
                                        </div>
                                        <span class="text-xs font-bold text-brand-cyan">★ {{ number_format($rev['rating'], 1) }}</span>
                                    </div>
                                    <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                                        “{{ $rev['comment'] }}”
                                    </p>
                                    <!-- Host Response -->
                                    <div class="p-2 bg-white/5 rounded-xl border border-white/5 text-xs text-neutral-400 space-y-1 mt-1.5">
                                        <div class="flex items-center justify-between font-bold">
                                            <span class="text-brand-purple">💬 Operator Response</span>
                                            <span class="text-neutral-600 font-normal">Replied 1 day after</span>
                                        </div>
                                        <p class="italic text-[11px] leading-relaxed">
                                            "Thank you for your feedback! We strive to maintain absolute security and clean charging stations for all drivers. Safe travels!"
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Booking Panel (Sticky) -->
            <div class="lg:col-span-4 lg:sticky lg:top-20">
                <div class="glass-panel rounded-3xl p-4.5 shadow-2xl space-y-4">
                    <div class="flex items-baseline justify-between border-b border-white/5 pb-3">
                        <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Pricing Starting At</span>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-white">
                                @if(($spot['currency_code'] ?? '') === 'JPY')
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }}
                                @else
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }}
                                @endif
                            </span>
                            <span class="text-xs text-neutral-500 font-medium">/ hr</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-xs text-neutral-400">
                            <span>Status</span>
                            <span class="text-brand-accent font-semibold flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent animate-pulse"></span>
                                Open & Booking
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-neutral-400">
                            <span>Space Left</span>
                            <span class="text-white font-medium">{{ $spot['available_spots'] }} / {{ $spot['total_spots'] }} spots free</span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-neutral-400">
                            <span>Daily Pass</span>
                            <span class="text-white font-medium">
                                @if(($spot['currency_code'] ?? '') === 'JPY')
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_day'], 0) }} / 24 hrs
                                @else
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_day'], 2) }} / 24 hrs
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Direct checkout forms -->
                    <form action="{{ route('booking.create') }}" method="GET" class="space-y-3 pt-3 border-t border-white/5">
                        <input type="hidden" name="parking_id" value="{{ $spot['id'] }}">
                        
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-neutral-400 uppercase tracking-wider block">Quick Reservation Setup</label>
                            
                            <a href="https://maps.google.com/?q={{ urlencode($spot['address']) }}" target="_blank" class="w-full py-2.5 rounded-xl border border-white/10 hover:bg-white/5 text-neutral-300 hover:text-white text-xs font-semibold flex items-center justify-center gap-2 transition-all">
                                <svg class="h-4 w-4 text-brand-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                Get Facility Directions
                            </a>

                            <button type="submit" class="magnetic-btn w-full py-2.5 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm tracking-wide shadow-lg hover:opacity-95 transition-all">
                                Proceed to Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Suggest nearby list -->
        @if(count($nearby) > 0)
            <div class="space-y-4 pt-10 mt-10 border-t border-white/5">
                <h3 class="text-xl font-bold text-white tracking-tight">Other Options in {{ $spot['city'] }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($nearby as $near)
                        <div class="glass-card rounded-2xl overflow-hidden flex flex-col justify-between h-full border border-white/5">
                            <div class="h-32 overflow-hidden relative">
                                <img src="{{ $near['image'] }}" alt="{{ $near['name'] }}" class="w-full h-full object-cover">
                                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full bg-dark-primary/80 text-[10px] font-bold text-brand-cyan uppercase">
                                    @if(($near['currency_code'] ?? '') === 'JPY')
                                        {{ $near['currency_symbol'] ?? '₹' }}{{ number_format($near['price_per_hour'], 0) }}/hr
                                    @else
                                        {{ $near['currency_symbol'] ?? '₹' }}{{ number_format($near['price_per_hour'], 2) }}/hr
                                    @endif
                                </span>
                            </div>
                            <div class="p-3.5 space-y-3">
                                <div class="space-y-0.5">
                                    <h4 class="text-sm font-bold text-white">{{ $near['name'] }}</h4>
                                    <span class="text-xs text-neutral-500">📍 {{ $near['area'] }}</span>
                                </div>
                                <a href="{{ route('parking.show', $near['id']) }}" class="w-full text-center block py-1.5 rounded-xl bg-white/5 border border-white/10 hover:bg-white text-dark-primary hover:border-white text-xs font-semibold text-white hover:text-dark-primary transition-all duration-300">
                                    View Space
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-public-layout>
