<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Insights & Mobility News" 
            description="Explore our smart parking and urban mobility articles. Find parking hacks, EV battery preservation guidelines, and smart cities insights."
        />
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="text-center max-w-xl mx-auto mb-8 space-y-3">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Mobility Insights</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">The ParkingHawker Blog</h1>
            <p class="text-sm text-neutral-400">Pioneering analysis on smart cities, EV charging systems, and transit hacks.</p>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between border-b border-white/5 pb-3 mb-4 gap-4">
            <!-- Categories Toggles -->
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                <a 
                    href="{{ route('blog.index') }}" 
                    class="px-4 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ !($filters['category'] ?? '') ? 'bg-white text-dark-primary' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}"
                >
                    All Articles
                </a>
                @foreach($categories as $cat)
                    @php
                        $catSlug = is_object($cat) ? $cat->slug : \Illuminate\Support\Str::slug($cat);
                        $catName = is_object($cat) ? $cat->name : $cat;
                    @endphp
                    <a 
                        href="{{ route('blog.category', $catSlug) }}" 
                        class="px-4 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ ($filters['category'] ?? '') == $catName ? 'bg-white text-dark-primary' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}"
                    >
                        {{ $catName }}
                    </a>
                @endforeach
            </div>

            <!-- Search Inputs -->
            <form action="{{ route('blog.index') }}" method="GET" class="w-full md:w-72 flex gap-2">
                @if(!empty($filters['category']))
                    <input type="hidden" name="category" value="{{ $filters['category'] }}">
                @endif
                <input 
                    type="text" 
                    name="query" 
                    value="{{ $filters['query'] ?? '' }}" 
                    placeholder="Search articles..." 
                    class="w-full px-4 py-1.5 rounded-xl bg-white/5 border border-white/10 text-white text-xs focus:outline-none focus:border-brand-cyan"
                >
                <button type="submit" class="px-3 rounded-xl bg-brand-cyan text-dark-primary font-bold text-xs hover:bg-brand-cyan/95 transition-colors">
                    Filter
                </button>
            </form>
        </div>

        <!-- Google Ad Slot -->
        <x-ad-slot slot="blog_index_top_banner" class="mb-5" />

        <!-- Articles list -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($articles as $art)
                <article class="bg-white/[0.03] backdrop-blur-md rounded-3xl overflow-hidden flex flex-col justify-between h-full border border-white/10 hover:border-brand-cyan/30 transition-all duration-300 shadow-2xl reveal-fade group">
                    <div class="h-40 overflow-hidden relative bg-white/5">
                        @if(!empty($art['image']))
                            <img src="{{ $art['image'] }}" alt="{{ $art['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <!-- Beautiful premium SVG placeholder for missing images to avoid broken img layout -->
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-brand-cyan/10 to-brand-purple/10 text-neutral-500">
                                <svg class="h-10 w-10 text-neutral-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.9 2.9m-18 8.25h21.75a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 002.25 15.75zm10.5-6a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                </svg>
                                <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-600">ParkingHawker News</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-dark-primary/80 backdrop-blur text-[10px] font-bold text-brand-cyan uppercase tracking-wider">{{ $art['category'] }}</span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between gap-4">
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between text-[10px] text-neutral-400 font-semibold uppercase tracking-wider">
                                <span>{{ $art['date'] }}</span>
                                <span>{{ $art['read_time'] }}</span>
                            </div>
                            <h3 class="text-md sm:text-lg font-bold leading-snug">
                                <a href="{{ route('blog.show', $art['slug']) }}" class="text-white hover:text-brand-cyan transition-colors duration-200">
                                    {{ $art['title'] }}
                                </a>
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-300 line-clamp-3 leading-relaxed">{{ $art['summary'] }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-white/10 text-xs">
                            <span class="text-neutral-400 font-medium">By {{ $art['author'] }}</span>
                            <a href="{{ route('blog.show', $art['slug']) }}" class="text-brand-cyan hover:text-white font-bold transition-colors duration-200 inline-flex items-center gap-1">
                                Read More
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-20 border border-dashed border-white/10 rounded-3xl">
                    <p class="text-sm text-neutral-500">No blog posts match your current search.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-public-layout>
