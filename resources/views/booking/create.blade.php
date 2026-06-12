<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Book Your Spot at {{ $spot['name'] }}" 
            description="Complete your reservation at {{ $spot['name'] }}. Select vehicle size, schedule duration, and checkout securely."
        />
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-10" x-data="{
        step: 1,
        spotId: {{ $spot['id'] }},
        vehiclePlate: '',
        vehicleType: 'car',
        duration: '3 hours',
        entryDate: '{{ date('Y-m-d') }}',
        entryTime: '08:00',
        paymentMethod: 'card',
        cardName: '',
        cardNumber: '',
        cardExpiry: '',
        cardCvc: '',
        evAddon: false,
        washAddon: false,
        currencySymbol: '{{ $spot['currency_symbol'] ?? '₹' }}',
        currencyCode: '{{ $spot['currency_code'] ?? 'INR' }}',
        
        // Dynamic Pricing states
        pricing: {
            unit_price: {{ $spot['price_per_hour'] }},
            total_price: {{ $spot['price_per_hour'] * 3 }},
            ev_surcharge: 0,
            wash_surcharge: 0,
            tax: 0,
            final_total: 0
        },
        
        errors: {},

        init() {
            this.updatePricing();
            this.$watch('duration', value => this.updatePricing());
            this.$watch('evAddon', value => this.updatePricing());
            this.$watch('washAddon', value => this.updatePricing());
        },

        formatMoney(amount) {
            if (this.currencyCode === 'JPY') {
                return this.currencySymbol + Math.round(amount).toLocaleString();
            }
            return this.currencySymbol + parseFloat(amount).toFixed(2);
        },

        updatePricing() {
            fetch('{{ route('booking.calculate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    spot_id: this.spotId,
                    duration: this.duration,
                    ev_addon: this.evAddon,
                    wash_addon: this.washAddon
                })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.error) {
                    this.pricing = {
                        unit_price: data.unit_price,
                        total_price: data.total_price,
                        ev_surcharge: data.ev_surcharge,
                        wash_surcharge: data.wash_surcharge,
                        tax: data.tax,
                        final_total: data.final_total
                    };
                }
            });
        },

        validateStep(stepNum) {
            this.errors = {};
            if (stepNum === 1) {
                if (!this.vehiclePlate) {
                    this.errors.vehiclePlate = 'License plate number is required.';
                } else if (this.vehiclePlate.length < 3) {
                    this.errors.vehiclePlate = 'License plate must be at least 3 characters.';
                }
                
                if (!this.entryDate) {
                    this.errors.entryDate = 'Please pick a start date.';
                }
            } else if (stepNum === 3) {
                if (this.paymentMethod === 'card') {
                    if (!this.cardName) this.errors.cardName = 'Cardholder name is required.';
                    if (!this.cardNumber) this.errors.cardNumber = 'Card number is required.';
                    if (!this.cardExpiry) this.errors.cardExpiry = 'Expiry is required.';
                    if (!this.cardCvc) this.errors.cardCvc = 'CVC is required.';
                }
            }
            return Object.keys(this.errors).length === 0;
        },

        nextStep() {
            if (this.validateStep(this.step)) {
                this.step++;
            }
        },

        prevStep() {
            this.step--;
        }
    }">

        <!-- Progress Indicator -->
        <div class="mb-10">
            <div class="flex items-center justify-between text-xs font-semibold text-neutral-500 uppercase tracking-widest mb-4">
                <span :class="step >= 1 ? 'text-brand-cyan' : ''">1. Vehicle Info</span>
                <span :class="step >= 2 ? 'text-brand-cyan' : ''">2. Add-ons</span>
                <span :class="step >= 3 ? 'text-brand-cyan' : ''">3. Payment</span>
                <span :class="step >= 4 ? 'text-brand-cyan' : ''">4. Confirmation</span>
            </div>
            <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-brand-cyan to-brand-purple h-full rounded-full transition-all duration-300" :style="'width: ' + ((step - 1) * 33.3) + '%'"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Form wizard panel -->
            <div class="lg:col-span-8 glass-panel rounded-3xl p-8 shadow-2xl relative">
                <!-- Floating top highlight -->
                <div class="absolute top-0 left-8 right-8 h-0.5 bg-gradient-to-r from-transparent via-brand-cyan to-transparent"></div>

                <form action="{{ route('booking.store') }}" method="POST" @submit="if(!validateStep(3)) $event.preventDefault()">
                    @csrf
                    <input type="hidden" name="spot_id" :value="spotId">
                    <input type="hidden" name="vehicle_type" :value="vehicleType">
                    <input type="hidden" name="duration" :value="duration">
                    <input type="hidden" name="entry_date" :value="entryDate">
                    <input type="hidden" name="entry_time" :value="entryTime">

                    <!-- STEP 1: Vehicle Information -->
                    <div x-show="step === 1" class="space-y-6" x-transition>
                        <h2 class="text-xl font-bold text-white tracking-tight">1. Vehicle & Schedule Details</h2>
                        
                        <div class="space-y-4">
                            <!-- Vehicle Plate -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">License Plate Number</label>
                                <input type="text" x-model="vehiclePlate" name="vehicle_plate" placeholder="e.g. MH-01-AB-1234" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan uppercase">
                                <span x-show="errors.vehiclePlate" x-text="errors.vehiclePlate" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                            </div>

                            <!-- Vehicle Nickname & Color -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Vehicle Nickname</label>
                                    <input type="text" placeholder="e.g. White SUV" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                </div>
                                <div class="flex flex-col" x-data="{ selectedColor: 'silver' }">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Vehicle Color</label>
                                    <div class="flex items-center gap-2 py-2.5">
                                        <button type="button" @click="selectedColor = 'white'" :class="selectedColor === 'white' ? 'ring-2 ring-brand-cyan' : ''" class="h-6 w-6 rounded-full bg-white border border-white/20 focus:outline-none"></button>
                                        <button type="button" @click="selectedColor = 'black'" :class="selectedColor === 'black' ? 'ring-2 ring-brand-cyan' : ''" class="h-6 w-6 rounded-full bg-black border border-white/20 focus:outline-none"></button>
                                        <button type="button" @click="selectedColor = 'silver'" :class="selectedColor === 'silver' ? 'ring-2 ring-brand-cyan' : ''" class="h-6 w-6 rounded-full bg-slate-400 border border-white/20 focus:outline-none"></button>
                                        <button type="button" @click="selectedColor = 'blue'" :class="selectedColor === 'blue' ? 'ring-2 ring-brand-cyan' : ''" class="h-6 w-6 rounded-full bg-blue-600 border border-white/20 focus:outline-none"></button>
                                        <button type="button" @click="selectedColor = 'red'" :class="selectedColor === 'red' ? 'ring-2 ring-brand-cyan' : ''" class="h-6 w-6 rounded-full bg-red-600 border border-white/20 focus:outline-none"></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Type -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Vehicle Classification</label>
                                <select x-model="vehicleType" class="px-4 py-3 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                    <option value="car">Standard Sedan / Coupe</option>
                                    <option value="suv">Oversized SUV / Truck</option>
                                    <option value="motorcycle">Motorcycle</option>
                                </select>
                            </div>

                            <!-- Duration Select -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Duration of Stay</label>
                                <select x-model="duration" class="px-4 py-3 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                    <option value="1 hour">1 Hour</option>
                                    <option value="3 hours">3 Hours</option>
                                    <option value="6 hours">6 Hours</option>
                                    <option value="12 hours">12 Hours</option>
                                    <option value="1 day">1 Day</option>
                                    <option value="3 days">3 Days</option>
                                    <option value="7 days">7 Days</option>
                                </select>
                            </div>

                            <!-- Entry Schedule -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Arrival Date</label>
                                    <input type="date" x-model="entryDate" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                    <span x-show="errors.entryDate" x-text="errors.entryDate" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Arrival Time</label>
                                    <input type="time" x-model="entryTime" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 flex justify-end">
                            <button type="button" @click="nextStep()" class="px-7 py-3 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/95 transition-colors">
                                Next Step
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Options & Add-ons -->
                    <div x-show="step === 2" class="space-y-6" x-transition style="display: none;">
                        <h2 class="text-xl font-bold text-white tracking-tight">2. Select Premium Services</h2>
                        
                        <div class="space-y-4">
                            <!-- EV charger addon -->
                            @if($spot['amenities']['ev_charging'])
                                <label class="flex items-start gap-4 p-5 rounded-2xl border cursor-pointer transition-colors" :class="evAddon ? 'bg-brand-cyan/5 border-brand-cyan' : 'bg-white/5 border-white/10'">
                                    <input type="checkbox" x-model="evAddon" name="ev_addon" value="1" class="h-5 w-5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 mt-1">
                                    <div>
                                        <strong class="text-sm text-white block mb-0.5">
                                            EV Supercharging Station (+ 
                                            @if(($spot['currency_code'] ?? '') === 'JPY')
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['ev_fee'] ?? 150, 0) }}
                                            @else
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['ev_fee'] ?? 150, 2) }}
                                            @endif
                                            flat)
                                        </strong>
                                        <p class="text-xs text-neutral-400">Secure a dedicated spot equipped with a Level-3 supercharger. Your battery status can be tracked dynamically.</p>
                                    </div>
                                </label>
                            @endif

                            <!-- Wash addon -->
                            @if($spot['amenities']['wash'])
                                <label class="flex items-start gap-4 p-5 rounded-2xl border cursor-pointer transition-colors" :class="washAddon ? 'bg-brand-cyan/5 border-brand-cyan' : 'bg-white/5 border-white/10'">
                                    <input type="checkbox" x-model="washAddon" name="wash_addon" value="1" class="h-5 w-5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 mt-1">
                                    <div>
                                        <strong class="text-sm text-white block mb-0.5">
                                            Deluxe Car Wash Service (+ 
                                            @if(($spot['currency_code'] ?? '') === 'JPY')
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['wash_fee'] ?? 300, 0) }}
                                            @else
                                                {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['wash_fee'] ?? 300, 2) }}
                                            @endif
                                            flat)
                                        </strong>
                                        <p class="text-xs text-neutral-400">Professional exterior eco-friendly hand-wash while you park. Return to a perfectly cleaned, glossy vehicle.</p>
                                    </div>
                                </label>
                            @endif

                            <!-- Valet addon -->
                            <label class="flex items-start gap-4 p-5 rounded-2xl border cursor-pointer transition-colors bg-white/5 border-white/10" x-data="{ valetSelected: false }" :class="valetSelected ? 'bg-brand-cyan/5 border-brand-cyan' : 'bg-white/5 border-white/10'">
                                <input type="checkbox" @click="valetSelected = !valetSelected" class="h-5 w-5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 mt-1">
                                <div>
                                    <strong class="text-sm text-white block mb-0.5">Smart Valet Service (Promo: FREE)</strong>
                                    <p class="text-xs text-neutral-400">Leave your keys with our certified attendant. Your car will be parked securely and brought to the exit bay upon return.</p>
                                </div>
                            </label>

                            <!-- Luggage storage addon -->
                            <label class="flex items-start gap-4 p-5 rounded-2xl border cursor-pointer transition-colors bg-white/5 border-white/10" x-data="{ luggageSelected: false }" :class="luggageSelected ? 'bg-brand-cyan/5 border-brand-cyan' : 'bg-white/5 border-white/10'">
                                <input type="checkbox" @click="luggageSelected = !luggageSelected" class="h-5 w-5 rounded bg-white/5 border border-white/10 text-brand-cyan focus:ring-0 mt-1">
                                <div>
                                    <strong class="text-sm text-white block mb-0.5">Complimentary Luggage Protection (FREE)</strong>
                                    <p class="text-xs text-neutral-400">Drop off heavy bags at the service hub. They will be stored in our climate-controlled lockbox and returned to your car trunk.</p>
                                </div>
                            </label>
                        </div>

                        <div class="pt-6 flex justify-between">
                            <button type="button" @click="prevStep()" class="px-6 py-3 rounded-xl border border-white/10 text-neutral-400 hover:text-white transition-colors text-sm font-semibold">
                                Back
                            </button>
                            <button type="button" @click="nextStep()" class="px-7 py-3 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/95 transition-colors">
                                Next Step
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: Secure Payment Mock -->
                    <div x-show="step === 3" class="space-y-6" x-transition style="display: none;">
                        <h2 class="text-xl font-bold text-white tracking-tight">3. Complete Secure Checkout</h2>
                        
                        <div class="space-y-5">
                            <div class="flex gap-4 border-b border-white/5 pb-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" x-model="paymentMethod" class="text-brand-cyan focus:ring-0">
                                    <span class="text-sm text-neutral-300">Credit / Debit Card</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="payment_method" value="apple" x-model="paymentMethod" class="text-brand-cyan focus:ring-0">
                                    <span class="text-sm text-neutral-300">Apple Pay / Google Pay</span>
                                </label>
                            </div>

                            <div x-show="paymentMethod === 'card'" class="space-y-4" x-transition>
                                <!-- Name -->
                                <div class="flex flex-col">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2">Cardholder Name</label>
                                    <input type="text" x-model="cardName" placeholder="e.g. Jane Doe" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                    <span x-show="errors.cardName" x-text="errors.cardName" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                                </div>
                                
                                <!-- Card Number -->
                                <div class="flex flex-col">
                                    <label class="text-xs font-semibold text-neutral-400 mb-2">Card Number</label>
                                    <input type="text" x-model="cardNumber" placeholder="•••• •••• •••• ••••" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                    <span x-show="errors.cardNumber" x-text="errors.cardNumber" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                                </div>

                                <!-- Expiry & CVC -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col">
                                        <label class="text-xs font-semibold text-neutral-400 mb-2">Expiry Date</label>
                                        <input type="text" x-model="cardExpiry" placeholder="MM/YY" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                        <span x-show="errors.cardExpiry" x-text="errors.cardExpiry" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="text-xs font-semibold text-neutral-400 mb-2">CVC / CVV</label>
                                        <input type="text" x-model="cardCvc" placeholder="•••" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                        <span x-show="errors.cardCvc" x-text="errors.cardCvc" class="text-xs text-red-400 mt-1" style="display: none;"></span>
                                    </div>
                                </div>
                            </div>

                            <div x-show="paymentMethod === 'apple'" class="py-8 text-center bg-white/5 border border-white/5 rounded-2xl" x-transition style="display: none;">
                                <span class="text-sm text-neutral-400">Express integration active. You will authorize with your secure wallet upon confirming.</span>
                            </div>
                        </div>

                        <div class="pt-6 flex justify-between">
                            <button type="button" @click="prevStep()" class="px-6 py-3 rounded-xl border border-white/10 text-neutral-400 hover:text-white transition-colors text-sm font-semibold">
                                Back
                            </button>
                            <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-bold text-sm tracking-wide shadow-lg hover:opacity-95 transition-all">
                                Confirm & Book Spot
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Price Breakdown Sticky Sidebar -->
            <div class="lg:col-span-4 lg:sticky lg:top-28">
                <div class="glass-panel rounded-3xl p-6 shadow-2xl space-y-6">
                    <h3 class="text-md font-bold text-white">Billing Breakdown</h3>
                    
                    <div class="space-y-4 text-xs text-neutral-400 border-b border-white/5 pb-4">
                        <div class="flex justify-between">
                            <span>Selected Deck</span>
                            <span class="text-white font-medium">{{ $spot['name'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Base Rate (Hourly)</span>
                            <span class="text-white font-medium">
                                @if(($spot['currency_code'] ?? '') === 'JPY')
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 0) }}
                                @else
                                    {{ $spot['currency_symbol'] ?? '₹' }}{{ number_format($spot['price_per_hour'], 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Rent Time</span>
                            <span class="text-brand-cyan font-semibold" x-text="duration"></span>
                        </div>
                    </div>

                    <!-- Computations list -->
                    <div class="space-y-3.5 text-sm">
                        <div class="flex justify-between text-neutral-400">
                            <span class="text-xs">Parking subtotal</span>
                            <span class="text-white" x-text="formatMoney(pricing.total_price)"></span>
                        </div>
                        <div class="flex justify-between text-neutral-400" x-show="pricing.ev_surcharge > 0">
                            <span class="text-xs">EV Charger spot</span>
                            <span class="text-white" x-text="formatMoney(pricing.ev_surcharge)"></span>
                        </div>
                        <div class="flex justify-between text-neutral-400" x-show="pricing.wash_surcharge > 0">
                            <span class="text-xs">Eco Car Wash</span>
                            <span class="text-white" x-text="formatMoney(pricing.wash_surcharge)"></span>
                        </div>
                        <div class="flex justify-between text-neutral-400">
                            <span class="text-xs">Taxes & Fees (8%)</span>
                            <span class="text-white" x-text="formatMoney(pricing.tax)"></span>
                        </div>
                        
                        <!-- Coupon code input -->
                        <div class="space-y-2 pt-4 border-t border-white/5" x-data="{ couponCode: '', couponApplied: false, discountAmount: 0 }">
                            <label class="text-xs font-semibold text-neutral-400 uppercase tracking-wider block">Discount Coupon</label>
                            <div class="flex gap-2">
                                <input type="text" x-model="couponCode" placeholder="e.g. PARK15" class="flex-1 px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white text-xs focus:outline-none focus:border-brand-cyan uppercase">
                                <button type="button" @click="if(couponCode.toUpperCase() === 'PARK15') { couponApplied = true; discountAmount = pricing.final_total * 0.15; } else { alert('Invalid Coupon Code'); }" class="px-3.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-xs hover:bg-brand-cyan/90 transition-colors">
                                    Apply
                                </button>
                            </div>
                            <div x-show="couponApplied" x-transition class="text-xxs font-semibold text-brand-accent flex justify-between mt-1" style="display: none;">
                                <span>✓ Coupon PARK15 (15% Off) Applied!</span>
                                <span x-text="'-' + formatMoney(discountAmount)"></span>
                            </div>
                            
                            <div class="flex justify-between font-bold text-white pt-4 border-t border-white/5">
                                <span>Total Billing</span>
                                <span class="text-lg text-brand-cyan" x-text="formatMoney(couponApplied ? pricing.final_total - discountAmount : pricing.final_total)"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
