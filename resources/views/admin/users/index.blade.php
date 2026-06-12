<x-admin-layout>
    <x-slot name="title">Users Role Management</x-slot>
    <x-slot name="breadcrumb">
        <span class="text-white">Users</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Users Role Management</h1>
        <p class="text-sm text-neutral-500 mt-1">Configure and manage assigned roles for system users.</p>
    </div>

    <!-- Users Table -->
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-neutral-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="text-left px-6 py-3.5">User Details</th>
                        <th class="text-left px-6 py-3.5">Assigned Roles</th>
                        <th class="text-right px-6 py-3.5">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-neutral-300">
                    @forelse($users as $user)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-brand-cyan to-brand-purple flex items-center justify-center font-bold text-white text-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-neutral-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($user->roles as $role)
                                        <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 text-brand-cyan text-[10px] font-bold uppercase tracking-wider border border-brand-cyan/25">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-neutral-600">No roles assigned</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 rounded-lg text-neutral-500 hover:text-brand-cyan hover:bg-white/5 transition-all inline-flex" title="Manage Roles">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12.005 11.995a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zM20.25 18a8.25 8.25 0 00-16.5 0"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-neutral-500">
                                No registered users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-white/5">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
