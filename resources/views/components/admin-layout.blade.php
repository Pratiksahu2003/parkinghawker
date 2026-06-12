<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-dark-primary text-slate-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>{{ $title ?? 'Admin' }} — ParkingHawker Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon.png') }}">
</head>
<body class="min-h-screen font-sans overflow-x-hidden selection:bg-brand-cyan/30 selection:text-brand-cyan" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    <div class="flex min-h-screen">
        <!-- ═══ Sidebar ═══ -->
        <!-- Mobile overlay -->
        <div x-show="mobileSidebar" x-transition.opacity class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm lg:hidden" style="display: none;" @click="mobileSidebar = false"></div>

        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-dark-secondary border-r border-white/5 flex flex-col transition-transform duration-300 lg:translate-x-0" :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <!-- Logo -->
            <div class="h-16 flex items-center gap-2.5 px-6 border-b border-white/5">
                <div class="h-8 w-8 rounded-lg bg-gradient-to-tr from-brand-cyan to-brand-purple p-0.5 flex items-center justify-center">
                    <div class="h-full w-full rounded-[6px] bg-dark-primary flex items-center justify-center p-1">
                        <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-full w-auto object-contain">
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-neutral-600 block mb-3">Main</span>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>

                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-neutral-600 block mt-6 mb-3">Blog</span>

                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.posts.*') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Blog Posts
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Categories
                </a>

                @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->is_admin))
                    <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-neutral-600 block mt-6 mb-3">Security & Access</span>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.users.*') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.35v15.3m0-15.3L6.3 9.75M12 4.35l5.7 5.4"/></svg>
                        Users Role
                    </a>

                    <a href="{{ route('admin.roles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.roles.*') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/></svg>
                        Roles
                    </a>

                    <a href="{{ route('admin.permissions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.permissions.*') ? 'bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/20' : 'text-neutral-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        Permissions
                    </a>
                @endif

                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-neutral-600 block mt-6 mb-3">Quick Actions</span>

                <a href="{{ route('admin.posts.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-brand-accent hover:bg-brand-accent/10 transition-all">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    New Post
                </a>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-500 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Site
                </a>

                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-400/80 hover:text-red-400 hover:bg-red-500/5 transition-all text-left">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Log Out
                    </button>
                </form>
            </nav>

            <!-- Footer branding -->
            <div class="px-6 py-4 border-t border-white/5">
                <p class="text-[10px] text-neutral-600 uppercase tracking-wider">Admin Panel v1.0</p>
            </div>
        </aside>

        <!-- ═══ Main Content Area ═══ -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Bar -->
            <header class="sticky top-0 z-30 h-16 bg-dark-primary/80 backdrop-blur-xl border-b border-white/5 flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <!-- Mobile menu toggle -->
                    <button @click="mobileSidebar = !mobileSidebar" class="lg:hidden p-2 rounded-lg bg-white/5 text-neutral-400 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <!-- Breadcrumb -->
                    <nav class="text-xs text-neutral-500 hidden sm:block">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                        @if(isset($breadcrumb))
                            <span class="mx-1.5">/</span>
                            {!! $breadcrumb !!}
                        @endif
                    </nav>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-medium text-neutral-400">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-brand-cyan to-brand-purple flex items-center justify-center text-xs font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                    <div class="h-5 w-px bg-white/10 hidden sm:block"></div>
                    <form action="{{ route('logout') }}" method="POST" class="hidden sm:inline">
                        @csrf
                        <button type="submit" class="text-neutral-500 hover:text-red-400 text-xs font-bold transition-colors flex items-center gap-1.5 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 lg:p-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="mb-6 px-5 py-3.5 rounded-xl bg-brand-accent/10 border border-brand-accent/20 text-brand-accent text-sm font-medium flex items-center justify-between">
                        <span>✓ {{ session('success') }}</span>
                        <button @click="show = false" class="text-brand-accent/60 hover:text-brand-accent">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="mb-6 px-5 py-3.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium flex items-center justify-between">
                        <span>✕ {{ session('error') }}</span>
                        <button @click="show = false" class="text-red-500/60 hover:text-red-400">&times;</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 px-5 py-3.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <p class="font-bold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
