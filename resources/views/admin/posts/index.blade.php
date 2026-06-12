<x-admin-layout>
    <x-slot name="title">Blog Posts</x-slot>
    <x-slot name="breadcrumb"><a href="{{ route('admin.posts.index') }}" class="text-white">Blog Posts</a></x-slot>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Blog Posts</h1>
            <p class="text-sm text-neutral-500 mt-1">Manage, create, and organize all your blog content.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors flex items-center gap-2 shrink-0">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Post
        </a>
    </div>

    <!-- Filters Bar -->
    <form action="{{ route('admin.posts.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">

        <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Drafts</option>
            <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
        </select>

        <select name="category_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm font-semibold hover:bg-white/10 transition-colors">Filter</button>
    </form>

    <!-- Posts Table -->
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Post</th>
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden md:table-cell">Category</th>
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden md:table-cell">Author</th>
                        <th class="text-center px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden sm:table-cell">Views</th>
                        <th class="text-right px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($posts as $post)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($post->featured_image)
                                        <img src="{{ $post->featured_image }}" alt="" class="h-10 w-14 rounded-lg object-cover hidden sm:block border border-white/5">
                                    @else
                                        <div class="h-10 w-14 rounded-lg bg-white/5 hidden sm:flex items-center justify-center">
                                            <svg class="h-5 w-5 text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-white font-medium hover:text-brand-cyan transition-colors line-clamp-1">
                                            {{ $post->title }}
                                            @if($post->is_featured)
                                                <span class="text-amber-400 text-xs">★</span>
                                            @endif
                                            @if($post->youtube_url)
                                                <span class="text-red-400 text-xs">▶</span>
                                            @endif
                                        </a>
                                        <p class="text-xs text-neutral-600 mt-0.5">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }} · {{ $post->read_time }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" style="background: {{ $post->category?->color ?? '#06b6d4' }}15; color: {{ $post->category?->color ?? '#06b6d4' }}">
                                    {{ $post->category?->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-neutral-400 text-xs hidden md:table-cell">{{ $post->author_name }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($post->status === 'published')
                                    <span class="px-2.5 py-1 rounded-full bg-brand-accent/10 text-brand-accent text-[10px] font-bold uppercase tracking-wider">Live</span>
                                @elseif($post->status === 'draft')
                                    <span class="px-2.5 py-1 rounded-full bg-amber-500/10 text-amber-500 text-[10px] font-bold uppercase tracking-wider">Draft</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-neutral-500/10 text-neutral-500 text-[10px] font-bold uppercase tracking-wider">Archived</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-neutral-400 font-mono text-xs hidden sm:table-cell">{{ number_format($post->views_count) }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-2 rounded-lg text-neutral-500 hover:text-brand-cyan hover:bg-white/5 transition-all" title="Edit">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="p-2 rounded-lg text-neutral-500 hover:text-brand-accent hover:bg-white/5 transition-all" title="View">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-neutral-500 hover:text-red-400 hover:bg-red-500/5 transition-all" title="Delete">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <svg class="h-10 w-10 text-neutral-700 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                <p class="text-sm text-neutral-500">No blog posts found.</p>
                                <a href="{{ route('admin.posts.create') }}" class="text-xs text-brand-cyan font-semibold mt-2 inline-block">Create your first post →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-white/5">
                {{ $posts->withQueryString()->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
