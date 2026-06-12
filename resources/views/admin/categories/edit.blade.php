<x-admin-layout>
    <x-slot name="title">Edit Category</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.categories.index') }}" class="hover:text-white transition-colors">Categories</a>
        <span class="mx-1.5">/</span>
        <span class="text-white">Edit</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Blog Category</h1>
        <p class="text-sm text-neutral-500 mt-1">Make adjustments, rewrite description, or change accent colors.</p>
    </div>

    <!-- Edit Form -->
    <div class="max-w-xl">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="glass-card rounded-2xl p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-neutral-300 mb-1.5">Category Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required placeholder="e.g. EV Charging" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-neutral-300 mb-1.5">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Briefly describe what kind of articles belong to this category..." class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="color" class="block text-sm font-semibold text-neutral-300 mb-1.5">Badge Accent Color <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2">
                        <input type="color" id="color_picker" value="{{ old('color', $category->color) }}" oninput="document.getElementById('color').value = this.value" class="h-10 w-12 rounded bg-transparent border-0 cursor-pointer">
                        <input type="text" name="color" id="color" value="{{ old('color', $category->color) }}" required placeholder="#06b6d4" oninput="document.getElementById('color_picker').value = this.value" class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm font-mono focus:outline-none focus:border-brand-cyan">
                    </div>
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-neutral-300 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="h-4.5 w-4.5 rounded bg-white/5 border-white/10 text-brand-cyan focus:ring-brand-cyan focus:ring-opacity-25 focus:ring-2">
                <label for="is_active" class="text-sm font-semibold text-neutral-300 cursor-pointer">Mark as Active</label>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                <button type="submit" class="flex-1 px-5 py-3 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
