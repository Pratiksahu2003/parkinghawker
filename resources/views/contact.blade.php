<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Contact Our Team" 
            description="Have questions about parking contracts, EV station partnerships, or billing? Reach out to our 24/7 client operations team."
        />
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Get in Touch</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Connect With Operations</h1>
            <p class="text-sm text-neutral-400">We respond to all contract and partnership inquiries within 3 hours.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Contact Info -->
            <div class="lg:col-span-5 space-y-8">
                <div class="glass-panel rounded-3xl p-6 space-y-6">
                    <h3 class="text-lg font-bold text-white">Direct Channels</h3>
                    
                    <div class="space-y-4 text-sm">
                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <span class="text-lg">📞</span>
                            <div>
                                <strong class="text-white block font-semibold">Client Hotline</strong>
                                <a href="tel:+18005557275" class="text-neutral-400 hover:text-brand-cyan transition-colors">+1 (800) 555-PARK</a>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <span class="text-lg">✉️</span>
                            <div>
                                <strong class="text-white block font-semibold">Support Desk</strong>
                                <a href="mailto:support@parkinghawker.com" class="text-neutral-400 hover:text-brand-cyan transition-colors">support@parkinghawker.com</a>
                            </div>
                        </div>

                        <!-- HQ Address -->
                        <div class="flex items-start gap-4">
                            <span class="text-lg">📍</span>
                            <div>
                                <strong class="text-white block font-semibold">Corporate HQ</strong>
                                <span class="text-neutral-400">455 Mission St, San Francisco, CA 94105</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Map Mock -->
                <div class="h-60 rounded-3xl bg-dark-secondary border border-white/5 relative overflow-hidden flex items-center justify-center">
                    <div class="absolute inset-0 bg-[radial-gradient(rgba(6,182,212,0.05)_1px,transparent_1px)] bg-[size:16px_16px]"></div>
                    <div class="relative z-10 text-center space-y-2 p-6">
                        <span class="text-2xl">🗺️</span>
                        <strong class="text-white block text-sm">SOMA Corporate Campus</strong>
                        <p class="text-xs text-neutral-500">Directions and customer lounge open M-F 9am - 6pm.</p>
                    </div>
                </div>
            </div>

            <!-- Right: Inquiry Form -->
            <div class="lg:col-span-7">
                <div class="glass-panel rounded-3xl p-8 shadow-2xl relative" x-data="{
                    name: '',
                    email: '',
                    phone: '',
                    requirement: 'general',
                    message: '',
                    charLimit: 1000,
                    submitted: false
                }">
                    <!-- Floating header bar decoration -->
                    <div class="absolute top-0 left-8 right-8 h-0.5 bg-gradient-to-r from-transparent via-brand-cyan to-transparent"></div>

                    <!-- Server Success Notice -->
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-2xl bg-brand-accent/10 border border-brand-accent/20 text-sm font-medium text-brand-accent">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Your Name</label>
                                <input type="text" name="name" x-model="name" placeholder="e.g. Jane Doe" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan" required>
                                @error('name') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Email Address</label>
                                <input type="email" name="email" x-model="email" placeholder="e.g. jane@company.com" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan" required>
                                @error('email') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Phone -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Phone Number (Optional)</label>
                                <input type="text" name="phone" x-model="phone" placeholder="e.g. +1 (555) 019-2834" class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                                @error('phone') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Inquiry Type -->
                            <div class="flex flex-col">
                                <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Requirement</label>
                                <select name="requirement" x-model="requirement" class="px-4 py-3 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                                    <option value="general">General Inquiries</option>
                                    <option value="corporate">Corporate Monthly Contracts</option>
                                    <option value="partnership">EV Charge Partnerships</option>
                                    <option value="billing">Billing & Refund Support</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="flex flex-col relative">
                            <label class="text-xs font-semibold text-neutral-400 mb-2 uppercase tracking-wider">Your Message</label>
                            <textarea name="message" x-model="message" :maxlength="charLimit" rows="5" placeholder="Tell us how we can help you..." class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan resize-none" required></textarea>
                            <!-- Character counter -->
                            <span class="absolute bottom-2 right-4 text-[10px] text-neutral-500 font-mono" x-text="(charLimit - message.length) + ' characters left'"></span>
                            @error('message') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="submit" class="magnetic-btn px-8 py-3.5 rounded-xl bg-brand-cyan hover:bg-brand-cyan/95 text-dark-primary font-bold text-sm tracking-wide shadow-lg transition-all">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
