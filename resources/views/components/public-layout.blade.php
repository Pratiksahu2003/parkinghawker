<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="scroll-smooth bg-dark-primary text-slate-100 antialiased">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P9XD2BB34G"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-P9XD2BB34G');
    </script>

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('services.google_adsense.client', 'ca-pub-2075682642541479') }}"
         crossorigin="anonymous"></script>
    <meta name="google-adsense-account" content="{{ config('services.google_adsense.client', 'ca-pub-2075682642541479') }}">

    <meta charset="utf-8">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- SEO & Metadata -->
    {{ $seo ?? '' }}

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inline script for initial scroll detection to avoid layout shifts -->
    <script>
        window.addEventListener('scroll', function () {
            const nav = document.getElementById('main-nav');
            if (nav) {
                if (window.scrollY > 50) {
                    nav.classList.add('py-1.5', 'glass-panel', 'shadow-lg');
                    nav.classList.remove('py-3', 'border-transparent');
                } else {
                    nav.classList.remove('py-1.5', 'glass-panel', 'shadow-lg');
                    nav.classList.add('py-3', 'border-transparent');
                }
            }
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon.png') }}">
</head>

<body
    class="min-h-screen flex flex-col font-sans overflow-x-hidden selection:bg-brand-cyan/30 selection:text-brand-cyan">

    <!-- Main Navigation Header -->
    <header id="main-nav" class="fixed top-0 left-0 right-0 z-40 border-b border-transparent py-3 transition-all duration-300 bg-dark-primary/90 backdrop-blur-md"
        x-data="{ mobileMenuOpen: false, searchOpen: false, activeMegamenu: null }">
        <div class="max-w-7xl mx-auto px-6 md:px-8 flex items-center justify-between">
            <!-- Animated Logo -->
            <a href="{{ route('home') }}" class="group z-50">
                <img src="{{ asset('logo/logo.png') }}" alt="Logo"
                    class="h-11 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-5">
                <a href="{{ route('home') }}"
                    class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 group">
                    Home
                    <span
                        class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('home') ? 'scale-x-100' : '' }}"></span>
                </a>

                <!-- Mega Menu Trigger -->
                <div class="relative" @mouseenter="activeMegamenu = 'parking'" @mouseleave="activeMegamenu = null">
                    <button
                        class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 flex items-center gap-1 group">
                        Locations
                        <svg class="h-4 w-4 transform transition-transform duration-200"
                            :class="activeMegamenu === 'parking' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('parking.*') ? 'scale-x-100' : '' }}"></span>
                    </button>

                    <!-- Megamenu panel -->
                    <div x-show="activeMegamenu === 'parking'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-1/2 -translate-x-1/2 pt-4 w-[600px] z-50" style="display: none;">
                        <div class="glass-panel rounded-2xl p-6 grid grid-cols-2 gap-6 shadow-2xl">
                            <div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-3">Indian
                                    Locations</h4>
                                <ul class="space-y-2">
                                    <li>
                                        <a href="{{ route('parking.index', ['city' => 'Mumbai']) }}"
                                            class="flex items-center gap-2 text-sm text-neutral-300 hover:text-brand-cyan transition-colors">
                                            <span class="h-1.5 w-1.5 rounded-full bg-brand-cyan"></span>
                                            Mumbai, MH
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parking.index', ['city' => 'New Delhi']) }}"
                                            class="flex items-center gap-2 text-sm text-neutral-300 hover:text-brand-cyan transition-colors">
                                            <span class="h-1.5 w-1.5 rounded-full bg-brand-purple"></span>
                                            New Delhi, DL
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parking.index', ['city' => 'Bengaluru']) }}"
                                            class="flex items-center gap-2 text-sm text-neutral-300 hover:text-brand-cyan transition-colors">
                                            <span class="h-1.5 w-1.5 rounded-full bg-brand-accent"></span>
                                            Bengaluru, KA
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parking.index', ['city' => 'Hyderabad']) }}"
                                            class="flex items-center gap-2 text-sm text-neutral-300 hover:text-brand-cyan transition-colors">
                                            <span class="h-1.5 w-1.5 rounded-full bg-brand-cyan"></span>
                                            Hyderabad, TS
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="border-l border-white/5 pl-6 flex flex-col justify-between">
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                        Smart Features</h4>
                                    <p class="text-xs text-neutral-400 mb-3">Reserve premium decks equipped with
                                        high-speed EV chargers, secure surveillance, and automated entry gates.</p>
                                </div>
                                <a href="{{ route('parking.index') }}"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-brand-cyan hover:text-brand-purple transition-colors">
                                    Browse All Garages
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('about') }}"
                    class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 group">
                    About
                    <span
                        class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('about') ? 'scale-x-100' : '' }}"></span>
                </a>
                <a href="{{ route('faq') }}"
                    class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 group">
                    FAQs
                    <span
                        class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('faq') ? 'scale-x-100' : '' }}"></span>
                </a>
                <a href="{{ route('blog.index') }}"
                    class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 group">
                    Insights
                    <span
                        class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('blog.*') ? 'scale-x-100' : '' }}"></span>
                </a>
                <a href="{{ route('contact') }}"
                    class="relative text-sm font-medium tracking-wide text-neutral-400 hover:text-white transition-colors py-2 group">
                    Contact
                    <span
                        class="absolute bottom-0 left-0 right-0 h-0.5 bg-brand-cyan origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('contact') ? 'scale-x-100' : '' }}"></span>
                </a>
            </nav>

            <!-- Actions (Search & CTA) -->
            <div class="hidden md:flex items-center gap-2.5">
                <button @click="searchOpen = true"
                    class="p-2 rounded-full bg-white/5 border border-white/5 hover:border-white/15 text-neutral-300 hover:text-white hover:bg-white/10 transition-all focus:outline-none"
                    aria-label="Search">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <a href="{{ route('parking.index') }}"
                    class="magnetic-btn px-4 py-2 rounded-full bg-white text-dark-primary font-semibold text-xs hover:bg-neutral-100 hover:shadow-xl hover:shadow-white/5 transition-all duration-300">
                    Find Parking
                </a>
            </div>

            <!-- Mobile Menu Burger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2.5 rounded-xl bg-white/5 text-neutral-400 hover:text-white focus:outline-none z-50"
                aria-label="Toggle mobile menu">
                <svg class="h-6 w-6 transition-transform duration-300" :class="mobileMenuOpen ? 'rotate-90' : ''"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" style="display: none;" />
                </svg>
            </button>
        </div>

        <!-- Mobile Drawer Navigation Overlay -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-md md:hidden"
            style="display: none;" @click="mobileMenuOpen = false"></div>

        <!-- Mobile Drawer Navigation Content -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed top-0 right-0 bottom-0 z-40 w-80 max-w-full bg-dark-secondary border-l border-white/5 px-6 pt-24 pb-8 flex flex-col justify-between md:hidden"
            style="display: none;">
            <div class="flex flex-col gap-6">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">Home</a>
                <a href="{{ route('parking.index') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">Locations</a>
                <a href="{{ route('about') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">About</a>
                <a href="{{ route('faq') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">FAQs</a>
                <a href="{{ route('blog.index') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">Insights</a>
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                    class="text-lg font-medium text-neutral-300 hover:text-brand-cyan transition-colors">Contact</a>
            </div>

            <div class="flex flex-col gap-4">
                <button @click="mobileMenuOpen = false; searchOpen = true"
                    class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border border-white/10 text-neutral-300 hover:text-white transition-colors">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Quick Search
                </button>
                <a href="{{ route('parking.index') }}" @click="mobileMenuOpen = false"
                    class="w-full text-center py-3.5 rounded-xl bg-gradient-to-r from-brand-cyan to-brand-purple text-white font-semibold text-sm shadow-lg shadow-brand-cyan/20">
                    Find Parking Space
                </a>
            </div>
        </div>

        <!-- Search Overlay Modal -->
        <div x-show="searchOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-6"
            style="display: none;" @keydown.escape.window="searchOpen = false">
            <div class="glass-panel rounded-2xl w-full max-w-xl p-6 shadow-2xl relative"
                @click.away="searchOpen = false">
                <button @click="searchOpen = false" class="absolute top-4 right-4 text-neutral-500 hover:text-white"
                    aria-label="Close search">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h3 class="text-md font-semibold text-white mb-4">Quick City Search</h3>
                <form action="{{ route('parking.index') }}" method="GET" class="flex gap-3">
                    <input type="text" name="city" placeholder="Type Mumbai, New Delhi, Bengaluru..."
                        class="flex-1 px-4 py-3 rounded-xl bg-dark-primary/60 border border-white/10 text-white focus:outline-none focus:border-brand-cyan text-sm"
                        required autofocus>
                    <button type="submit"
                        class="px-5 py-3 rounded-xl bg-brand-cyan text-dark-primary font-semibold text-sm hover:bg-brand-cyan/90 transition-colors">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Global App Content -->
    <main class="flex-grow pt-16">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-dark-secondary border-t border-white/5 relative z-10 pt-12 pb-6 overflow-hidden">
        <!-- Background decorative ambient lights -->
        <div
            class="absolute -bottom-80 -left-80 h-160 w-160 rounded-full bg-brand-cyan/5 blur-[150px] pointer-events-none">
        </div>
        <div
            class="absolute -bottom-80 -right-80 h-160 w-160 rounded-full bg-brand-purple/5 blur-[150px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-6 mb-10 relative z-10">
            <!-- Col 1: About -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-11 w-auto object-contain">
                </a>
                <p class="text-sm text-neutral-400 mt-2 leading-relaxed">
                    Pioneering seamless urban mobility with premium, Apple-level automated booking decks. Smart
                    tracking, EV charging, and 24/7 high security.
                </p>
                <div class="flex items-center gap-3 mt-2">
                    <a href="#"
                        class="p-2 rounded-lg bg-white/5 hover:bg-white/10 hover:text-brand-cyan text-neutral-400 transition-colors"
                        aria-label="Twitter">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="p-2 rounded-lg bg-white/5 hover:bg-white/10 hover:text-brand-cyan text-neutral-400 transition-colors"
                        aria-label="Instagram">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="p-2 rounded-lg bg-white/5 hover:bg-white/10 hover:text-brand-cyan text-neutral-400 transition-colors"
                        aria-label="LinkedIn">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="flex flex-col gap-4">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-300">Quick Links</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="text-neutral-400 hover:text-white transition-colors">Home
                            Dashboard</a></li>
                    <li><a href="{{ route('parking.index') }}"
                            class="text-neutral-400 hover:text-white transition-colors">Find Parking Spot</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-neutral-400 hover:text-white transition-colors">Company Story</a></li>
                    <li><a href="{{ route('faq') }}" class="text-neutral-400 hover:text-white transition-colors">Help &
                            FAQs</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-neutral-400 hover:text-white transition-colors">Contact Support</a></li>
                </ul>
            </div>

            <!-- Col 3: Parking Cities -->
            <div class="flex flex-col gap-4">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-300">Parking Cities</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('parking.index', ['city' => 'Mumbai']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">Mumbai, MH</a></li>
                    <li><a href="{{ route('parking.index', ['city' => 'New Delhi']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">New Delhi, DL</a></li>
                    <li><a href="{{ route('parking.index', ['city' => 'Bengaluru']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">Bengaluru, KA</a></li>
                    <li><a href="{{ route('parking.index', ['city' => 'Hyderabad']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">Hyderabad, TS</a></li>
                    <li><a href="{{ route('parking.index', ['city' => 'Pune']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">Pune, MH</a></li>
                    <li><a href="{{ route('parking.index', ['city' => 'Gurugram']) }}"
                            class="text-neutral-400 hover:text-white transition-colors">Gurugram, HR</a></li>
                </ul>
            </div>

            <!-- Col 4: Newsletter -->
            <div class="flex flex-col gap-4" x-data="{ subscribed: false }">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-300">Newsletter</h3>
                <p class="text-sm text-neutral-400 leading-relaxed">
                    Get regular updates on smart parking expansions and special discount tokens.
                </p>
                <div x-show="subscribed" x-transition
                    class="text-xs font-medium text-brand-cyan bg-brand-cyan/10 border border-brand-cyan/20 px-3.5 py-2.5 rounded-xl">
                    ✓ Subscribed successfully! Thank you.
                </div>
                <form @submit.prevent="subscribed = true" x-show="!subscribed" class="flex gap-2 mt-1">
                    <input type="email" placeholder="name@email.com"
                        class="flex-1 px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-xs focus:outline-none focus:border-brand-cyan focus:ring-1 focus:ring-brand-cyan"
                        required>
                    <button type="submit"
                        class="px-4.5 rounded-xl bg-brand-cyan text-dark-primary font-bold text-xs hover:bg-brand-cyan/90 transition-colors">
                        Join
                    </button>
                </form>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto px-6 border-t border-white/5 pt-5 relative z-10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-neutral-500">
            <span>&copy; {{ date('Y') }} ParkingHawker Inc. All rights reserved.</span>
            <div class="flex items-center gap-6">
                <a href="{{ route('legal.privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('legal.terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('legal.refund') }}" class="hover:text-white transition-colors">Refund Policy</a>
            </div>
        </div>
    </footer>

</body>

</html>