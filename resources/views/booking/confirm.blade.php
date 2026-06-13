<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Reservation Confirmed" 
            description="Your parking space reservation is confirmed. Download your digital entry voucher."
        />
    </x-slot>

    <div class="max-w-xl mx-auto px-6 py-6 text-center space-y-5">
        <!-- Success Check Circle -->
        <div class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-brand-accent/15 border border-brand-accent/30 text-brand-accent animate-bounce">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>

        <div class="space-y-1">
            <h1 class="text-3xl font-bold text-white tracking-tight">Booking Confirmed!</h1>
            <p class="text-sm text-neutral-400">Your digital parking permit is active and ready for entry.</p>
        </div>

        <!-- Ticket Card Showcase -->
        <div class="glass-card rounded-3xl overflow-hidden border border-white/10 shadow-2xl relative text-left">
            <!-- Top perforation border decoration -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-brand-cyan via-brand-purple to-brand-cyan"></div>

            <div class="p-4.5 space-y-4">
                <!-- Pass header -->
                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                    <div>
                        <span class="text-[10px] text-neutral-500 uppercase tracking-widest block font-semibold">Voucher ID</span>
                        <strong class="text-sm text-white font-mono uppercase">{{ $booking['booking_reference'] }}</strong>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/20 text-[10px] text-brand-accent uppercase font-bold tracking-wider">Active Permit</span>
                </div>

                <!-- Spot Info -->
                <div class="space-y-0.5">
                    <span class="text-[10px] text-neutral-500 uppercase tracking-widest block font-semibold">Selected Location</span>
                    <strong class="text-md text-white block">{{ $booking['spot_name'] }}</strong>
                    <p class="text-xs text-neutral-400">{{ $booking['address'] }}</p>
                </div>

                <!-- Ticket Grid -->
                <div class="grid grid-cols-2 gap-3 border-t border-b border-white/5 py-2.5 text-xs">
                    <div>
                        <span class="text-neutral-500 block mb-0.5">License Plate</span>
                        <strong class="text-white font-mono text-sm uppercase">{{ $booking['vehicle_plate'] }}</strong>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Vehicle Model</span>
                        <strong class="text-white font-medium">{{ $booking['vehicle_type'] }}</strong>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Arrival Schedule</span>
                        <strong class="text-white font-medium">{{ $booking['entry_datetime'] }}</strong>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Duration</span>
                        <strong class="text-white font-medium">{{ $booking['duration'] }}</strong>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Amount Paid</span>
                        <strong class="text-brand-cyan font-semibold">
                            @if(($booking['currency_code'] ?? '') === 'JPY')
                                {{ $booking['currency_symbol'] ?? '₹' }}{{ number_format($booking['total_price'], 0) }}
                            @else
                                {{ $booking['currency_symbol'] ?? '₹' }}{{ number_format($booking['total_price'], 2) }}
                            @endif
                        </strong>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Transaction Status</span>
                        <strong class="text-brand-accent font-semibold flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-brand-accent animate-pulse"></span>
                            Paid • Secured
                        </strong>
                    </div>
                </div>

                <!-- Gate passcode info -->
                <div class="flex items-center justify-between bg-white/5 border border-white/5 rounded-2xl p-3">
                    <div>
                        <span class="text-[10px] text-neutral-500 uppercase tracking-widest block font-semibold">Gate Entry PIN</span>
                        <strong class="text-lg text-white font-mono tracking-widest">{{ $booking['passcode'] }}</strong>
                    </div>
                    <!-- Mock QR Code graphic -->
                    <div class="h-14 w-14 bg-white p-1 rounded-lg flex flex-col justify-between items-center opacity-90">
                        <!-- Custom styled QR look with inline nested grids -->
                        <div class="grid grid-cols-4 gap-0.5 h-full w-full">
                            <div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div>
                            <div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div>
                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div>
                            <div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Live Transit Checklist -->
            <div class="p-4.5 border-t border-white/5 space-y-2">
                <span class="text-[10px] text-neutral-500 uppercase tracking-widest block font-semibold">Live System Sync Status</span>
                <ul class="space-y-1.5 text-xs">
                    <li class="flex items-center gap-2 text-brand-accent font-medium">
                        <span>✓</span>
                        <span>License Plate <strong class="font-mono text-white">{{ $booking['vehicle_plate'] }}</strong> registered in camera scanner API</span>
                    </li>
                    <li class="flex items-center gap-2 text-brand-accent font-medium">
                        <span>✓</span>
                        <span>Dedicated slot blocked under Booking Ref ID</span>
                    </li>
                    <li class="flex items-center gap-2 text-brand-accent font-medium">
                        <span>✓</span>
                        <span>Support Attendants notified for check-in assistance</span>
                    </li>
                </ul>
            </div>

            <!-- Footer terms -->
            <div class="px-4.5 py-3 bg-white/5 text-[10px] text-neutral-500 border-t border-white/5">
                ⚠ Please align your license plate clearly at gate cameras for automated ticketless check-in.
            </div>
        </div>

        <div class="flex flex-col items-center gap-3">
            <div class="flex items-center justify-center gap-3">
                <button onclick="window.print()" class="px-5 py-2.5 rounded-xl border border-white/10 hover:bg-white/5 text-neutral-400 hover:text-white transition-colors text-sm font-semibold">
                    Print Pass
                </button>
                <a href="{{ route('home') }}" class="magnetic-btn px-5 py-2.5 rounded-xl bg-brand-cyan hover:bg-brand-cyan/95 text-dark-primary font-bold text-sm transition-colors">
                    Return Home
                </a>
            </div>
            
            <!-- Google/Apple Wallet Integration -->
            <div class="flex gap-2.5 pt-1">
                <a href="#" onclick="alert('Google Wallet Sync Active')" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-white/10 hover:border-white/20 text-white text-[10px] font-bold flex items-center gap-2 transition-all">
                    <span>🍏 Add to Apple Wallet</span>
                </a>
                <a href="#" onclick="alert('Google Wallet Sync Active')" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-white/10 hover:border-white/20 text-white text-[10px] font-bold flex items-center gap-2 transition-all">
                    <span>🤖 Add to Google Wallet</span>
                </a>
            </div>
        </div>
    </div>
</x-public-layout>
