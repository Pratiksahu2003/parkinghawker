<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="breadcrumb"><span class="text-white">Dashboard</span></x-slot>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Blog Dashboard</h1>
            <p class="text-sm text-neutral-500 mt-1">Overview of your content performance and activity.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Post
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <!-- Total Posts -->
        <div class="glass-card rounded-2xl p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Total Posts</span>
                <div class="h-8 w-8 rounded-lg bg-brand-cyan/10 flex items-center justify-center">
                    <svg class="h-4 w-4 text-brand-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['total_posts'] }}</p>
        </div>

        <!-- Published -->
        <div class="glass-card rounded-2xl p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Published</span>
                <div class="h-8 w-8 rounded-lg bg-brand-accent/10 flex items-center justify-center">
                    <svg class="h-4 w-4 text-brand-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['published'] }}</p>
        </div>

        <!-- Drafts -->
        <div class="glass-card rounded-2xl p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Drafts</span>
                <div class="h-8 w-8 rounded-lg bg-amber-500/10 flex items-center justify-center">
                    <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['drafts'] }}</p>
        </div>

        <!-- Total Views -->
        <div class="glass-card rounded-2xl p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Total Views</span>
                <div class="h-8 w-8 rounded-lg bg-brand-purple/10 flex items-center justify-center">
                    <svg class="h-4 w-4 text-brand-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($stats['total_views']) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Posts Table -->
        <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-sm font-bold text-white">Recent Posts</h3>
                <a href="{{ route('admin.posts.index') }}" class="text-xs text-brand-cyan hover:text-brand-cyan/80 font-semibold">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Title</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden sm:table-cell">Category</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Status</th>
                            <th class="text-right px-6 py-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden sm:table-cell">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recentPosts as $post)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-3.5">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-white hover:text-brand-cyan font-medium transition-colors line-clamp-1">{{ $post->title }}</a>
                                    <p class="text-xs text-neutral-600 mt-0.5">{{ $post->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-6 py-3.5 hidden sm:table-cell">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" style="background: {{ $post->category?->color ?? '#06b6d4' }}15; color: {{ $post->category?->color ?? '#06b6d4' }}">
                                        {{ $post->category?->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5">
                                    @if($post->status === 'published')
                                        <span class="px-2.5 py-1 rounded-full bg-brand-accent/10 text-brand-accent text-[10px] font-bold uppercase tracking-wider">Published</span>
                                    @elseif($post->status === 'draft')
                                        <span class="px-2.5 py-1 rounded-full bg-amber-500/10 text-amber-500 text-[10px] font-bold uppercase tracking-wider">Draft</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-neutral-500/10 text-neutral-500 text-[10px] font-bold uppercase tracking-wider">Archived</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3.5 text-right text-neutral-400 font-mono text-xs hidden sm:table-cell">{{ number_format($post->views_count) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-neutral-500 text-sm">No posts yet. Create your first blog post!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Sidebar: Categories + Top Posts -->
        <div class="space-y-6">
            <!-- Categories Card -->
            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white">Categories</h3>
                    <a href="{{ route('admin.categories.create') }}" class="text-xs text-brand-accent hover:text-brand-accent/80 font-semibold">+ Add</a>
                </div>
                <div class="p-4 space-y-2">
                    @forelse($categories as $cat)
                        <div class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/[0.03] transition-colors">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2.5 w-2.5 rounded-full" style="background: {{ $cat->color }}"></span>
                                <span class="text-sm text-neutral-300 font-medium">{{ $cat->name }}</span>
                            </div>
                            <span class="text-xs text-neutral-600 font-mono">{{ $cat->posts_count }} posts</span>
                        </div>
                    @empty
                        <p class="text-xs text-neutral-500 text-center py-4">No categories created yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Top Viewed Posts -->
            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5">
                    <h3 class="text-sm font-bold text-white">Most Viewed</h3>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($topPosts as $index => $post)
                        <div class="flex items-center gap-3">
                            <span class="text-lg font-bold text-neutral-700 w-6 text-center">{{ $index + 1 }}</span>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-sm text-neutral-300 hover:text-brand-cyan font-medium transition-colors line-clamp-1">{{ $post->title }}</a>
                                <p class="text-[10px] text-neutral-600 font-mono">{{ number_format($post->views_count) }} views</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-neutral-500 text-center py-4">No views yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
