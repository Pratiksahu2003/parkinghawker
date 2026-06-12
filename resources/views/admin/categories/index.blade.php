<x-admin-layout>
    <x-slot name="title">Categories</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.categories.index') }}" class="text-white">Categories</a>
    </x-slot>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Blog Categories</h1>
            <p class="text-sm text-neutral-500 mt-1">Organize your posts into structured topics and themes.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors flex items-center gap-2 shrink-0">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Category</th>
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden sm:table-cell">Slug</th>
                        <th class="text-left px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider hidden md:table-cell">Description</th>
                        <th class="text-center px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Status</th>
                        <th class="text-center px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Posts</th>
                        <th class="text-right px-6 py-3.5 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($categories as $category)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <!-- Color Indicator Dot/Badge -->
                                    <div class="h-4 w-4 rounded-full border border-white/10 shrink-0" style="background-color: {{ $category->color }}"></div>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-white font-medium hover:text-brand-cyan transition-colors">
                                        {{ $category->name }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-neutral-500 hidden sm:table-cell">/blog?category={{ $category->slug }}</td>
                            <td class="px-6 py-4 text-xs text-neutral-400 max-w-xs truncate hidden md:table-cell" title="{{ $category->description }}">
                                {{ $category->description ?? 'No description provided.' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($category->is_active)
                                    <span class="px-2.5 py-1 rounded-full bg-brand-accent/10 text-brand-accent text-[10px] font-bold uppercase tracking-wider">Active</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-neutral-500/10 text-neutral-500 text-[10px] font-bold uppercase tracking-wider">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center font-mono text-xs text-white">
                                {{ $category->posts_count }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 rounded-lg text-neutral-500 hover:text-brand-cyan hover:bg-white/5 transition-all" title="Edit">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-neutral-500 hover:text-red-400 hover:bg-red-500/5 transition-all" title="Delete" {{ $category->posts_count > 0 ? 'disabled style=opacity:0.3;cursor:not-allowed' : '' }}>
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <svg class="h-10 w-10 text-neutral-700 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <p class="text-sm text-neutral-500">No categories found.</p>
                                <a href="{{ route('admin.categories.create') }}" class="text-xs text-brand-cyan font-semibold mt-2 inline-block">Create your first category →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
