<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Terms of Service" 
            description="Our service conditions. Review guidelines on automated smart-barrier entries, overstay parameters, and payment account setups."
        />
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="text-center max-w-xl mx-auto mb-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Legal Center</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Terms of Service</h1>
            <p class="text-xs text-neutral-500">Last updated: June 13, 2026</p>
        </div>

        <!-- Google Ad Slot -->
        <x-ad-slot slot="terms_top_banner" class="mb-8" />

        <div class="glass-panel rounded-3xl p-6 sm:p-8 space-y-6 text-sm text-neutral-300 leading-relaxed">
            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">1.</span> Agreement to Terms
                </h2>
                <p>
                    By accessing or reserving parking spots via ParkingHawker, you agree to comply with and be bound by these Terms of Service. If you disagree with any portion of these conditions, you must refrain from using the application or entering our smart decks.
                </p>
            </section>

            <div class="h-px bg-white/5"></div>

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">2.</span> Smart Booking & Overstays
                </h2>
                <p>
                    All reservations must designate accurate arrival and departure parameters. 
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-400">
                    <li><strong>Early Entry:</strong> Access gates will allow entry up to 10 minutes prior to scheduled start times.</li>
                    <li><strong>Late Departures (Overstays):</strong> If your vehicle remains parked beyond the scheduled exit time, billing updates automatically at a penalty rate of 1.5x the standard hourly price.</li>
                    <li><strong>Space Forfeiture:</strong> Spots are held for up to 30 minutes past the scheduled arrival. If un-scanned, the spot may release with standard cancel fees.</li>
                </ul>
            </section>

            <div class="h-px bg-white/5"></div>

            <!-- Google Ad Slot -->
            <x-ad-slot slot="terms_middle_banner" class="my-6" />

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">3.</span> EV Charging Etiquette
                </h2>
                <p>
                    When reserving charging-equipped spots, vehicles must unplug and relocate to standard spots within 15 minutes of receiving a "Charge Complete" notification. Idle parking fees may apply to facilitate charger rotation availability.
                </p>
            </section>

            <div class="h-px bg-white/5"></div>

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">4.</span> Facility Liability Limitations
                </h2>
                <p>
                    ParkingHawker facilitates reservations and secure gate control. While we utilize automated CCTV monitoring and local facility guards, vehicle owners retain full responsibility for personal belongings and vehicles. We assume no liability for personal property theft or damage inside facilities.
                </p>
            </section>
        </div>
    </div>
</x-public-layout>
