<x-public-layout>
    <x-slot name="seo">
        <x-seo 
            title="Admin Login" 
            description="Sign in to your ParkingHawker admin account to manage spots, bookings, and blog insights."
        />
    </x-slot>

    <div class="min-h-[75vh] flex items-center justify-center py-12 px-6 relative overflow-hidden">
        <!-- Decorative glowing blobs -->
        <div class="absolute top-1/4 left-1/4 h-80 w-80 rounded-full bg-brand-cyan/5 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 h-80 w-80 rounded-full bg-brand-purple/5 blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-md space-y-8 relative z-10">
            <!-- Header branding -->
            <div class="text-center space-y-3">
                <div class="inline-flex h-12 w-12 rounded-2xl bg-gradient-to-tr from-brand-cyan to-brand-purple p-0.5 items-center justify-center shadow-lg shadow-brand-cyan/25">
                    <div class="h-full w-full rounded-[14px] bg-dark-primary flex items-center justify-center">
                        <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-6 w-auto object-contain">
                    </div>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Welcome Back</h1>
                <p class="text-xs text-neutral-500">Sign in to access the ParkingHawker administration portal.</p>
            </div>

            <!-- Login Card -->
            <div class="glass-panel rounded-3xl p-8 border border-white/5 shadow-2xl">
                <!-- Session Errors -->
                @if($errors->any())
                    <div class="mb-5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="admin@parkinghawker.com" class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan focus:ring-1 focus:ring-brand-cyan placeholder:text-neutral-600 transition-colors">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-semibold text-neutral-400 uppercase tracking-wider">Password</label>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan focus:ring-1 focus:ring-brand-cyan placeholder:text-neutral-600 transition-colors">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" value="1" class="h-4.5 w-4.5 rounded bg-white/5 border-white/10 text-brand-cyan focus:ring-brand-cyan focus:ring-opacity-25 focus:ring-2">
                        <label for="remember" class="ml-2.5 text-xs text-neutral-400 cursor-pointer hover:text-white transition-colors">Keep me signed in</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-dark-primary font-bold text-sm hover:opacity-95 transition-opacity shadow-lg shadow-brand-cyan/25 mt-4">
                        Secure Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-public-layout>
