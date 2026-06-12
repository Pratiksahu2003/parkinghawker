<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Insights & Mobility News" 
            description="Explore our smart parking and urban mobility articles. Find parking hacks, EV battery preservation guidelines, and smart cities insights."
        />
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center max-w-xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold uppercase tracking-widest text-brand-cyan">Mobility Insights</h2>
            <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">The ParkingHawker Blog</h1>
            <p class="text-sm text-neutral-400">Pioneering analysis on smart cities, EV charging systems, and transit hacks.</p>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between border-b border-white/5 pb-6 mb-8 gap-4">
            <!-- Categories Toggles -->
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-3 md:pb-0">
                <a 
                    href="{{ route('blog.index') }}" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ !($filters['category'] ?? '') ? 'bg-white text-dark-primary' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}"
                >
                    All Articles
                </a>
                @foreach($categories as $cat)
                    <a 
                        href="{{ route('blog.category', $cat->slug) }}" 
                        class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ ($filters['category'] ?? '') == $cat->name ? 'bg-white text-dark-primary' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}"
                    >
                        {{ $cat->name }}
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
                    class="w-full px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-white text-xs focus:outline-none focus:border-brand-cyan"
                >
                <button type="submit" class="px-4 rounded-xl bg-brand-cyan text-dark-primary font-bold text-xs hover:bg-brand-cyan/95 transition-colors">
                    Filter
                </button>
            </form>
        </div>

        <!-- Articles list -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($articles as $art)
                <article class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full border border-white/5 reveal-fade">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ $art['image'] }}" alt="{{ $art['title'] }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-dark-primary/80 text-[10px] font-bold text-brand-cyan uppercase tracking-wider">{{ $art['category'] }}</span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-[10px] text-neutral-500 font-semibold uppercase tracking-wider">
                                <span>{{ $art['date'] }}</span>
                                <span>{{ $art['read_time'] }}</span>
                            </div>
                            <h3 class="text-md sm:text-lg font-bold text-white hover:text-brand-cyan transition-colors leading-snug">
                                <a href="{{ route('blog.show', $art['slug']) }}">{{ $art['title'] }}</a>
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-400 line-clamp-3 leading-relaxed">{{ $art['summary'] }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/5 text-xs">
                            <span class="text-neutral-500 font-medium">By {{ $art['author'] }}</span>
                            <a href="{{ route('blog.show', $art['slug']) }}" class="text-white hover:text-brand-cyan font-bold transition-colors inline-flex items-center gap-1">
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
