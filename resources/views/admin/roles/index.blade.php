<x-admin-layout>
    <x-slot name="title">Roles Management</x-slot>
    <x-slot name="breadcrumb">
        <span class="text-white">Roles</span>
    </x-slot>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Roles Management</h1>
            <p class="text-sm text-neutral-500 mt-1">Configure user roles and associated permissions.</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="px-5 py-2.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors flex items-center gap-2 shrink-0">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Role
        </a>
    </div>

    <!-- Roles Table -->
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-neutral-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="text-left px-6 py-3.5">Role Name</th>
                        <th class="text-left px-6 py-3.5">Assigned Permissions</th>
                        <th class="text-right px-6 py-3.5">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-neutral-300">
                    @forelse($roles as $role)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4 font-semibold text-white">
                                {{ $role->name }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($role->permissions as $perm)
                                        <span class="px-2 py-0.5 rounded-md bg-brand-purple/10 text-brand-purple text-[10px] font-medium border border-brand-purple/20">
                                            {{ $perm->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-neutral-600">No permissions assigned</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="p-2 rounded-lg text-neutral-500 hover:text-brand-cyan hover:bg-white/5 transition-all" title="Edit Role">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @if($role->name !== 'admin')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-neutral-500 hover:text-red-400 hover:bg-red-500/5 transition-all" title="Delete Role">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-neutral-500">
                                No roles defined. Click "New Role" to configure one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
