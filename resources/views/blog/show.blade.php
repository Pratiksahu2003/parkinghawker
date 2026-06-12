<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="{{ $article['title'] }}" 
            description="{{ $article['summary'] }}"
            image="{{ $article['image'] }}"
            type="article"
        />
    </x-slot>

    <article class="max-w-4xl mx-auto px-6 py-12">
        <!-- Breadcrumbs -->
        <nav class="flex text-xs text-neutral-500 gap-2 mb-6 uppercase tracking-wider">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
            <span>/</span>
            <span class="text-neutral-300 font-medium truncate">{{ $article['title'] }}</span>
        </nav>

        <!-- Article Header -->
        <header class="space-y-6 mb-8 text-center sm:text-left">
            <span class="px-3 py-1 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-[10px] font-bold text-brand-cyan uppercase tracking-wider">
                {{ $article['category'] }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                {{ $article['title'] }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-4 text-xs text-neutral-400 border-t border-b border-white/5 py-4">
                <div>
                    <span class="text-neutral-500 block">Published On</span>
                    <strong class="text-white">{{ $article['date'] }}</strong>
                </div>
                <div class="h-6 w-px bg-white/5 hidden sm:block"></div>
                <div>
                    <span class="text-neutral-500 block">Read Time</span>
                    <strong class="text-white">{{ $article['read_time'] }}</strong>
                </div>
                <div class="h-6 w-px bg-white/5 hidden sm:block"></div>
                <div>
                    <span class="text-neutral-500 block">Written By</span>
                    <strong class="text-white">{{ $article['author'] }} ({{ $article['author_role'] }})</strong>
                </div>
                <div class="h-6 w-px bg-white/5 hidden sm:block"></div>
                <div>
                    <span class="text-neutral-500 block">Views</span>
                    <strong class="text-white">{{ number_format($article['views_count'] ?? 0) }}</strong>
                </div>
            </div>
        </header>

        <!-- YouTube Video Player or Banner Image -->
        @if(!empty($article['youtube_embed_url']))
            <div class="aspect-video w-full rounded-3xl overflow-hidden border border-white/5 mb-10 shadow-2xl">
                <iframe class="w-full h-full" src="{{ $article['youtube_embed_url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        @elseif(!empty($article['image']))
            <!-- Big Banner Image -->
            <div class="h-[350px] w-full rounded-3xl overflow-hidden border border-white/5 mb-10">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Rich Text content -->
        <div class="prose prose-invert max-w-none text-neutral-300 space-y-6 leading-relaxed">
            {!! $article['content'] !!}
        </div>

        <!-- Tags -->
        @if(!empty($article['tags']) && is_array($article['tags']))
            <div class="flex flex-wrap gap-2 mt-8 pt-8 border-t border-white/5">
                @foreach($article['tags'] as $tag)
                    <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-neutral-400 hover:text-white hover:border-brand-cyan/30 transition-all text-xs font-semibold cursor-pointer">
                        #{{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Author bio card -->
        <div class="bg-white/5 border border-white/5 rounded-3xl p-6 mt-16 flex items-start gap-5">
            <div class="h-14 w-14 rounded-full bg-gradient-to-tr from-brand-cyan to-brand-purple flex items-center justify-center p-0.5 shrink-0">
                <div class="h-full w-full rounded-full bg-dark-primary flex items-center justify-center font-bold text-white text-md">
                    {{ substr($article['author'], 0, 2) }}
                </div>
            </div>
            <div class="space-y-1">
                <strong class="text-md text-white block">{{ $article['author'] }}</strong>
                <span class="text-xs text-brand-cyan block">{{ $article['author_role'] }}</span>
                <p class="text-xs text-neutral-400 mt-2 leading-relaxed">
                    Alexander compiles and drafts infrastructure guidelines, researching how cities scale smart charging adapters and automated license systems.
                </p>
            </div>
        </div>

        <!-- Related articles list -->
        @if(count($related) > 0)
            <div class="space-y-8 pt-16 mt-16 border-t border-white/5">
                <h3 class="text-xl font-bold text-white tracking-tight">Related Articles</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($related as $rel)
                        <div class="glass-card rounded-2xl overflow-hidden flex flex-col justify-between h-full border border-white/5">
                            <div class="h-36 overflow-hidden relative">
                                <img src="{{ $rel['image'] }}" alt="{{ $rel['title'] }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full bg-dark-primary/80 text-[9px] font-bold text-brand-cyan uppercase">{{ $rel['category'] }}</span>
                            </div>
                            <div class="p-5 space-y-3">
                                <h4 class="text-xs sm:text-sm font-bold text-white line-clamp-2 leading-snug">
                                    <a href="{{ route('blog.show', $rel['slug']) }}" class="hover:text-brand-cyan transition-colors">{{ $rel['title'] }}</a>
                                </h4>
                                <a href="{{ route('blog.show', $rel['slug']) }}" class="text-brand-cyan hover:text-brand-purple text-xs font-semibold inline-flex items-center gap-1 transition-colors">
                                    Read Article
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
</x-public-layout>
