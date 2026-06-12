<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Help & Frequently Asked Questions" 
            description="Find instant answers to common parking questions about mobile reservations, automated entry gates, payment refunds, and corporate monthly memberships."
        />
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-12" x-data="{
        activeTab: 'booking',
        searchQuery: '',
        faqs: {
            booking: [
                { q: 'How early can I book a parking spot?', a: 'You can reserve a spot up to 30 days in advance. Pre-booking secures the best rates and guarantees availability.' },
                { q: 'Can I cancel or modify my reservation?', a: 'Yes, cancel up to 2 hours before entry time for a full refund. Modifications can be made from your booking details link.' },
                { q: 'Do you offer monthly parking contracts?', a: 'Yes, corporate and individual monthly subscriptions can be requested via our Contact page.' }
            ],
            payments: [
                { q: 'What payment methods are supported?', a: 'We accept all major credit cards (Visa, Mastercard, Amex), Apple Pay, and Google Pay.' },
                { q: 'Is there a booking transaction fee?', a: 'No hidden booking fees. The final price you see on checkout includes parking and standard local taxes.' }
            ],
            security: [
                { q: 'Are your parking structures safe?', a: 'Yes, all locations features constant HD CCTV surveillance, well-lit bays, automated entry scanner gates, and security staff.' },
                { q: 'What if someone parks in my reserved spot?', a: 'Our automated plate readers will identify unauthorized parking and flag the bay. Attendants will immediately resolve or tow.' }
            ],
            refunds: [
                { q: 'How long does a refund take to process?', a: 'Refunds are triggered immediately upon cancellation and typically appear back in your account within 3-5 business days.' }
            ],
            membership: [
                { q: 'What is the ParkClub Membership?', a: 'It is a premium loyalty program offering 10% cash back on parking, free deluxe washes, and priority booking lanes.' }
            ]
        },

        filteredFaqs() {
            if (!this.searchQuery) {
                return this.faqs[this.activeTab] || [];
            }
            
            let query = this.searchQuery.toLowerCase();
            let results = [];
            
            // Search through all tabs
            Object.values(this.faqs).forEach(tabItems => {
                tabItems.forEach(item => {
                    if (item.q.toLowerCase().includes(query) || item.a.toLowerCase().includes(query)) {
                        results.push(item);
                    }
                });
            });
            
            return results;
        }
    }">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Help Center</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Got Questions? We Have Answers</h1>
            
            <!-- Quick Search Input -->
            <div class="pt-4 relative">
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="Search for questions (e.g. refund, plate)..." 
                    class="w-full px-5 py-3.5 rounded-2xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan transition-colors"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            <!-- Category Tabs Sidebar -->
            <aside class="md:col-span-3 flex flex-row md:flex-col gap-2 overflow-x-auto pb-4 md:pb-0 border-b md:border-b-0 md:border-r border-white/5 pr-0 md:pr-4">
                <template x-for="tab in ['booking', 'payments', 'security', 'refunds', 'membership']">
                    <button 
                        @click="activeTab = tab; searchQuery = ''" 
                        class="px-4 py-2.5 rounded-xl text-left text-xs font-bold uppercase tracking-wider transition-all whitespace-nowrap focus:outline-none"
                        :class="activeTab === tab && !searchQuery ? 'bg-white text-dark-primary shadow-lg shadow-white/5' : 'text-neutral-400 hover:text-white hover:bg-white/5'"
                        x-text="tab"
                    ></button>
                </template>
            </aside>

            <!-- FAQs accordion list panel -->
            <div class="md:col-span-9 space-y-4" x-data="{ openIdx: null }">
                <template x-for="(faq, idx) in filteredFaqs()" :key="idx">
                    <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
                        <button 
                            @click="openIdx = openIdx === idx ? null : idx" 
                            class="w-full px-6 py-5 text-left flex items-center justify-between font-bold text-white hover:text-brand-cyan transition-colors focus:outline-none text-sm sm:text-base"
                        >
                            <span x-text="faq.q"></span>
                            <svg class="h-4.5 w-4.5 transform transition-transform duration-300 text-neutral-500" :class="openIdx === idx ? 'rotate-180 text-brand-cyan' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div 
                            x-show="openIdx === idx" 
                            x-collapse 
                            x-transition 
                            class="px-6 pb-6 text-sm text-neutral-400 leading-relaxed border-t border-white/5 pt-4"
                            x-html="faq.a"
                        ></div>
                    </div>
                </template>

                <!-- No search results display -->
                <div x-show="filteredFaqs().length === 0" class="text-center py-12 border border-dashed border-white/10 rounded-2xl" style="display: none;">
                    <p class="text-sm text-neutral-500">No results match your search keywords.</p>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
