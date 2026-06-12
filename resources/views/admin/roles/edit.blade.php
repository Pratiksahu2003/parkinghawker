<x-admin-layout>
    <x-slot name="title">Edit Role</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.roles.index') }}" class="hover:text-white transition-colors">Roles</a>
        <span class="mx-1.5">/</span>
        <span class="text-white">Edit</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Role: {{ $role->name }}</h1>
        <p class="text-sm text-neutral-500 mt-1">Adjust name and permissions assigned to this role.</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 max-w-2xl">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-neutral-300 mb-1.5">Role Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required value="{{ old('name', $role->name) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600 transition-colors">
            </div>

            <!-- Permission Selection -->
            <div>
                <label class="block text-sm font-semibold text-neutral-300 mb-3">Assign Permissions</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                    @forelse($permissions as $perm)
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white/[0.02] border border-white/5 hover:border-white/10 hover:bg-white/[0.04] transition-all cursor-pointer">
                            <input type="checkbox" name="permissions[]" id="perm_{{ $perm->id }}" value="{{ $perm->name }}" {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }} class="mt-0.5 h-4.5 w-4.5 rounded bg-white/5 border-white/10 text-brand-cyan focus:ring-brand-cyan focus:ring-opacity-25 focus:ring-2">
                            <label for="perm_{{ $perm->id }}" class="text-sm font-medium text-neutral-300 cursor-pointer select-none">{{ $perm->name }}</label>
                        </div>
                    @empty
                        <p class="text-xs text-neutral-600 col-span-2">No permissions registered yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Update Role
                </button>
                <a href="{{ route('admin.roles.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
