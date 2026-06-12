<x-admin-layout>
    <x-slot name="title">Edit Permission</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.permissions.index') }}" class="hover:text-white transition-colors">Permissions</a>
        <span class="mx-1.5">/</span>
        <span class="text-white">Edit</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Permission: {{ $permission->name }}</h1>
        <p class="text-sm text-neutral-500 mt-1">Update permission name.</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 max-w-md">
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-2">Permission Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $permission->name) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan transition-colors">
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Update Permission
                </button>
                <a href="{{ route('admin.permissions.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
