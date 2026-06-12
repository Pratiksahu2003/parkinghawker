<x-admin-layout>
    <x-slot name="title">Permissions Management</x-slot>
    <x-slot name="breadcrumb">
        <span class="text-white">Permissions</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Permissions Management</h1>
        <p class="text-sm text-neutral-500 mt-1">Configure and create system permissions for role-based gating.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Permissions List (2 cols) -->
        <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-neutral-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="text-left px-6 py-3.5">Permission Name</th>
                            <th class="text-right px-6 py-3.5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-neutral-300">
                        @forelse($permissions as $perm)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4 font-semibold text-white">
                                    {{ $perm->name }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.permissions.edit', $perm->id) }}" class="p-2 rounded-lg text-neutral-500 hover:text-brand-cyan hover:bg-white/5 transition-all" title="Edit Permission">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.permissions.destroy', $perm->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this permission?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-neutral-500 hover:text-red-400 hover:bg-red-500/5 transition-all" title="Delete Permission">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-12 text-center text-neutral-500">
                                    No permissions defined. Add one on the right.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Permission Form (1 col) -->
        <div class="glass-card rounded-2xl p-6 h-fit space-y-4">
            <h2 class="text-lg font-bold text-white tracking-tight">Create Permission</h2>
            <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-2">Permission Name</label>
                    <input type="text" name="name" id="name" required placeholder="e.g. manage users" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600 transition-colors">
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Add Permission
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
