<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Refund Policy" 
            description="Our customer refund guidelines. Review cancellation parameters, automatic refund processing timelines, and exceptions."
        />
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="text-center max-w-xl mx-auto mb-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Legal Center</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Refund & Cancel Policy</h1>
            <p class="text-xs text-neutral-500">Last updated: June 13, 2026</p>
        </div>

        <!-- Google Ad Slot -->
        <x-ad-slot slot="refund_top_banner" class="mb-8" />

        <div class="glass-panel rounded-3xl p-6 sm:p-8 space-y-6 text-sm text-neutral-300 leading-relaxed">
            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">1.</span> Standard Cancellations
                </h2>
                <p>
                    We believe in flexibility. Cancellations are processed automatically based on the following guidelines:
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-400">
                    <li><strong>More than 2 hours before booking:</strong> Full 100% refund processed back to your original payment method. No administrative fees applied.</li>
                    <li><strong>Within 2 hours of booking:</strong> 50% partial refund. A small holding charge is retained to compensate operators for locking down the spot.</li>
                    <li><strong>After scheduled arrival time:</strong> Non-refundable. Empty reservations that are not cancelled or checked into are logged as "No Shows" and billed in full.</li>
                </ul>
            </section>

            <div class="h-px bg-white/5"></div>

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">2.</span> Charging Session Disputes
                </h2>
                <p>
                    If an EV charger dispenser malfunctions during your booking, please log a service ticket via the <a href="{{ route('contact') }}" class="text-brand-cyan hover:underline">Contact Support Form</a>. Once verified by our hardware log team, a full session billing adjustment or credit token will issue to your profile within 24 hours.
                </p>
            </section>

            <div class="h-px bg-white/5"></div>

            <!-- Google Ad Slot -->
            <x-ad-slot slot="refund_middle_banner" class="my-6" />

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">3.</span> Refund Processing SLA
                </h2>
                <p>
                    Once cancelled or approved by support, the refund is initiated instantly. However, standard bank clearance timelines apply:
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-400">
                    <li><strong>Credit/Debit Cards:</strong> 5 to 7 business days to reflect on statements.</li>
                    <li><strong>Apple Pay / Google Pay:</strong> 2 to 3 business days.</li>
                    <li><strong>Parking Credit Tokens:</strong> Instant profile allocation.</li>
                </ul>
            </section>
        </div>
    </div>
</x-public-layout>
