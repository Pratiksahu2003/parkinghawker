<x-admin-layout>
    <x-slot name="title">Manage User Roles</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.users.index') }}" class="hover:text-white transition-colors">Users</a>
        <span class="mx-1.5">/</span>
        <span class="text-white">Edit Roles</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Manage User Roles: {{ $user->name }}</h1>
        <p class="text-sm text-neutral-500 mt-1">Assign or remove access roles for this user.</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 max-w-2xl">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- User Info Readonly -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-white/5">
                <div>
                    <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-1">User Name</label>
                    <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-1">Email Address</label>
                    <p class="text-sm font-semibold text-white">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Role Selection -->
            <div>
                <label class="block text-sm font-semibold text-neutral-300 mb-3">Select Roles</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                    @forelse($roles as $role)
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white/[0.02] border border-white/5 hover:border-white/10 hover:bg-white/[0.04] transition-all cursor-pointer">
                            <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'checked' : '' }} class="mt-0.5 h-4.5 w-4.5 rounded bg-white/5 border-white/10 text-brand-cyan focus:ring-brand-cyan focus:ring-opacity-25 focus:ring-2">
                            <label for="role_{{ $role->id }}" class="text-sm font-medium text-neutral-300 cursor-pointer select-none">{{ $role->name }}</label>
                        </div>
                    @empty
                        <p class="text-xs text-neutral-600 col-span-2">No roles registered in the database.</p>
                    @endforelse
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Save Assignments
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
