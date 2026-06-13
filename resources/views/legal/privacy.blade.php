<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Privacy Policy" 
            description="Our privacy commitment. Learn how we securely protect your personal details, license plate recognition logs, and payment tokens."
        />
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="text-center max-w-xl mx-auto mb-10 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Legal Center</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Privacy Policy</h1>
            <p class="text-xs text-neutral-500">Last updated: June 13, 2026</p>
        </div>

        <!-- Google Ad Slot -->
        <x-ad-slot slot="privacy_top_banner" class="mb-8" />

        <div class="glass-panel rounded-3xl p-6 sm:p-8 space-y-6 text-sm text-neutral-300 leading-relaxed">
            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">1.</span> Information We Collect
                </h2>
                <p>
                    We collect information to provide better services to all our users. This includes:
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-400">
                    <li><strong>Account Details:</strong> Your name, email address, phone number, and password when you register.</li>
                    <li><strong>Vehicle Information:</strong> License plate numbers to facilitate automatic smart barrier gate access control.</li>
                    <li><strong>Booking & Transactions:</strong> Date, time, duration, and billing tokens for reservations (processed securely through certified partners).</li>
                    <li><strong>Location Data:</strong> Real-time GPS location when seeking vacant parking spaces via our app.</li>
                </ul>
            </section>

            <div class="h-px bg-white/5"></div>

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">2.</span> How We Use Your Data
                </h2>
                <p>
                    Your data is strictly utilized to facilitate core features of ParkingHawker, specifically:
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-400">
                    <li>Executing spot reservations and processing automated gate access.</li>
                    <li>Notifying you of billing details, EV charging completions, or reservation time expirations.</li>
                    <li>Improving our automated routing engine and local spot-finding speed metrics.</li>
                    <li>Ensuring facility safety by logging license plates of vehicles inside smart decks.</li>
                </ul>
            </section>

            <div class="h-px bg-white/5"></div>

            <!-- Google Ad Slot -->
            <x-ad-slot slot="privacy_middle_banner" class="my-6" />

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">3.</span> Data Security & Retention
                </h2>
                <p>
                    We implement industry-grade security protocols. Payment processing is fully tokenized and PCI-DSS compliant. License plate logs are automatically purged after 30 days unless flag triggers indicate facility security threats. We never sell or lease your personal data to third-party brokers.
                </p>
            </section>

            <div class="h-px bg-white/5"></div>

            <section class="space-y-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="text-brand-cyan">4.</span> Third-Party Services
                </h2>
                <p>
                    We utilize Google Analytics to analyze platform traffic patterns and Google AdSense to serve targeted advertisements. These services may collect cookies and usage data to personalize ad delivery. For detailed instructions on managing your preferences, please consult our <a href="{{ route('faq') }}" class="text-brand-cyan hover:underline">FAQ section</a>.
                </p>
            </section>
        </div>
    </div>
</x-public-layout>
