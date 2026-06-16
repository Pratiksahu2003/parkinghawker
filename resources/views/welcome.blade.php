<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Parking Hawker - Premium Smart Parking Solutions</title>

        <!-- Google Fonts: Plus Jakarta Sans for UI, Outfit for Headings -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .font-display {
                font-family: 'Outfit', sans-serif;
            }
        </style>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo/favicon.png') }}">
    </head>
    <body class="bg-slate-950 text-slate-100 min-h-screen selection:bg-teal-500 selection:text-slate-950 overflow-x-hidden">
        
        <!-- Background decorative glows -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute top-1/3 right-1/4 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-indigo-600/15 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <!-- Header -->
        <header class="sticky top-0 z-50 backdrop-blur-md border-b border-slate-900 bg-slate-950/80 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="group z-50">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-400">
                    <a href="#features" class="hover:text-teal-400 transition-colors duration-200">Features</a>
                    <a href="#simulator" class="hover:text-teal-400 transition-colors duration-200">Live Simulator</a>
                    <a href="#monetize" class="hover:text-teal-400 transition-colors duration-200">Renting driveway</a>
                    <a href="#faq" class="hover:text-teal-400 transition-colors duration-200">FAQ</a>
                </nav>

                <!-- Auth Buttons / CTA -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-850 text-sm font-semibold border border-slate-800 hover:border-slate-700 transition-all duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-teal-400 to-teal-500 hover:from-teal-300 hover:to-teal-400 text-slate-950 font-bold text-sm shadow-lg shadow-teal-500/20 hover:shadow-teal-500/35 hover:-translate-y-0.5 transition-all duration-200">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @else
                        <a href="#simulator" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-teal-400 to-teal-500 hover:from-teal-300 hover:to-teal-400 text-slate-950 font-bold text-sm shadow-lg shadow-teal-500/20 hover:shadow-teal-500/35 hover:-translate-y-0.5 transition-all duration-200">
                            Book Spot Now
                        </a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20 lg:pt-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Left Info -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full bg-teal-500/10 border border-teal-500/30 text-teal-400 text-xs font-semibold tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                        <span>Introducing Live Smart Booking v2.0</span>
                    </div>

                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-none text-white">
                        Never circle the <span class="bg-gradient-to-r from-teal-400 via-emerald-400 to-violet-500 bg-clip-text text-transparent">block</span> again.
                    </h1>

                    <p class="text-slate-400 text-lg sm:text-xl max-w-2xl mx-auto lg:mx-0 leading-relaxed font-light">
                        Find, reserve, and pay for premium parking spots in seconds. Access private driveways, commercial garages, and street-level smart spots instantly.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#simulator" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-teal-400 to-violet-600 hover:from-teal-300 hover:to-violet-500 text-white font-bold text-center shadow-lg shadow-teal-500/15 hover:shadow-teal-500/30 transition-all duration-300">
                            Try Live Simulator
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-slate-900/60 hover:bg-slate-900 text-slate-300 font-semibold text-center border border-slate-800 hover:border-slate-700 transition-all duration-300">
                            Explore Features
                        </a>
                    </div>

                    <!-- Micro-Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-4 border-t border-slate-900/80 max-w-md mx-auto lg:mx-0">
                        <div>
                            <div class="font-display text-2xl font-bold text-white">12,000+</div>
                            <div class="text-xs text-slate-500">Spots Available</div>
                        </div>
                        <div>
                            <div class="font-display text-2xl font-bold text-white">4.9★</div>
                            <div class="text-xs text-slate-500">User Rating</div>
                        </div>
                        <div>
                            <div class="font-display text-2xl font-bold text-white">&lt; 3 mins</div>
                            <div class="text-xs text-slate-500">Avg. Find Time</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Right Widget (Interactive Live Booking Simulator) -->
                <div id="simulator" class="lg:col-span-5 relative">
                    <!-- Glow behind card -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-teal-500 to-violet-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                    
                    <div class="relative bg-slate-900/90 border border-slate-800/80 rounded-3xl p-6 shadow-2xl backdrop-blur-xl">
                        <!-- Simulator Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                            <div>
                                <h3 class="font-display text-lg font-bold text-white">Smart Hub Simulator</h3>
                                <p class="text-xs text-slate-500">Click a parking spot to inspect details</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xxs font-bold uppercase tracking-wider border border-emerald-500/20">
                                Live GPS Feed
                            </span>
                        </div>

                        <!-- Lot Grid Simulation -->
                        <div class="my-6">
                            <div class="grid grid-cols-4 gap-3">
                                <!-- Spot 1 -->
                                <button onclick="selectSpot(1, 'A-12', 'Garage Deck B', '$4.50', 'Available', '98m')" class="spot-btn group relative p-4 rounded-xl border transition-all duration-300 text-center bg-slate-950/60 border-teal-500/30 hover:border-teal-400 focus:outline-none focus:ring-2 focus:ring-teal-400">
                                    <span class="block text-xs font-semibold text-slate-400 group-hover:text-white transition-colors">A-12</span>
                                    <span class="block mt-1 w-2.5 h-2.5 rounded-full bg-teal-400 mx-auto shadow-md shadow-teal-400/40"></span>
                                </button>

                                <!-- Spot 2 -->
                                <button onclick="selectSpot(2, 'B-04', 'Private Driveway', '$3.00', 'Available', '140m')" class="spot-btn group relative p-4 rounded-xl border transition-all duration-300 text-center bg-slate-950/60 border-teal-500/30 hover:border-teal-400 focus:outline-none focus:ring-2 focus:ring-teal-400">
                                    <span class="block text-xs font-semibold text-slate-400 group-hover:text-white transition-colors">B-04</span>
                                    <span class="block mt-1 w-2.5 h-2.5 rounded-full bg-teal-400 mx-auto shadow-md shadow-teal-400/40"></span>
                                </button>

                                <!-- Spot 3 -->
                                <button onclick="selectSpot(3, 'C-19', 'Downtown Mall', '$6.00', 'Occupied', '210m')" class="spot-btn group relative p-4 rounded-xl border transition-all duration-300 text-center bg-slate-900/30 border-red-500/20 cursor-not-allowed opacity-60">
                                    <span class="block text-xs font-semibold text-slate-500">C-19</span>
                                    <span class="block mt-1 w-2.5 h-2.5 rounded-full bg-red-500/80 mx-auto"></span>
                                </button>

                                <!-- Spot 4 -->
                                <button onclick="selectSpot(4, 'A-08', 'Valet Parking', '$8.00', 'Available', '45m')" class="spot-btn group relative p-4 rounded-xl border transition-all duration-300 text-center bg-slate-950/60 border-teal-500/30 hover:border-teal-400 focus:outline-none focus:ring-2 focus:ring-teal-400">
                                    <span class="block text-xs font-semibold text-slate-400 group-hover:text-white transition-colors">A-08</span>
                                    <span class="block mt-1 w-2.5 h-2.5 rounded-full bg-teal-400 mx-auto shadow-md shadow-teal-400/40"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Spot Inspection Details Card -->
                        <div id="inspector-card" class="bg-slate-950/70 border border-slate-800/80 rounded-2xl p-4 transition-all duration-350 transform opacity-0 scale-95 hidden">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span id="spot-type" class="text-xxs uppercase tracking-wider bg-violet-500/10 text-violet-400 px-2 py-0.5 rounded-md border border-violet-500/20">Garage Deck B</span>
                                    <h4 class="font-display text-xl font-bold text-white mt-1.5" id="spot-name">Spot A-12</h4>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-slate-500">Hourly Rate</div>
                                    <div class="font-display text-lg font-bold text-teal-400" id="spot-rate">$4.50</div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-4 text-xs text-slate-400 border-t border-slate-800/60 pt-3">
                                <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-teal-400 mr-1.5"></span> Distance: <strong class="text-white ml-1" id="spot-distance">98m</strong></span>
                                <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5"></span> Status: <strong class="text-emerald-400 ml-1" id="spot-status">Available</strong></span>
                            </div>

                            <button onclick="bookSpot()" class="w-full mt-4 py-3 rounded-xl bg-gradient-to-r from-teal-400 to-teal-500 hover:from-teal-300 hover:to-teal-400 text-slate-950 font-bold text-sm shadow-md transition-all duration-200">
                                Confirm Reservation
                            </button>
                        </div>

                        <!-- Success Alert Modal Simulator -->
                        <div id="success-alert" class="bg-teal-500/10 border border-teal-500/30 rounded-2xl p-5 text-center hidden transform transition-all duration-300">
                            <div class="w-12 h-12 rounded-full bg-teal-500/20 text-teal-400 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </div>
                            <h4 class="font-display text-lg font-bold text-white">Spot Secured!</h4>
                            <p class="text-xs text-slate-400 mt-1">Your parking pass code is: <strong class="text-teal-400">PK-8842-HW</strong>. Access instructions sent to mobile.</p>
                            <button onclick="resetSimulator()" class="mt-4 px-4 py-2 bg-slate-900 border border-slate-800 rounded-lg text-xs font-semibold text-slate-400 hover:text-white transition-colors duration-200">
                                Book Another Spot
                            </button>
                        </div>

                        <!-- Default Prompt Card -->
                        <div id="default-prompt" class="py-10 text-center border-2 border-dashed border-slate-800/80 rounded-2xl flex flex-col items-center justify-center">
                            <svg class="w-10 h-10 text-slate-700 animate-bounce" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286.728ZM12 2.25V4.5m5.303.197-1.591 1.591M21.75 12h-2.25m-.197 5.303-1.591-1.591M12 19.5v2.25m-5.303-.197 1.591-1.591M2.25 12h2.25m-.197-5.303 1.591 1.591"/>
                            </svg>
                            <p class="text-sm text-slate-500 mt-3 font-medium">Select a spot in the grid above to book</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-slate-900">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-white">
                    Engineered for modern city parking
                </h2>
                <p class="text-slate-400 font-light leading-relaxed">
                    Say goodbye to paper tickets, broken meters, and endless driving. Welcome to fully integrated smart parking.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-teal-500/20 hover:bg-slate-900/60 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center mb-6 border border-teal-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Real-time GPS Availability</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Our smart sensor grid updates in real-time, mapping active vacant spots. Guaranteed parking ready when you arrive.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-violet-500/20 hover:bg-slate-900/60 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-violet-500/10 text-violet-400 flex items-center justify-center mb-6 border border-violet-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Instant Mobile Payments</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Securely link your card, Apple Pay, or Google Pay. Automated billing means you just park and walk away.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-teal-500/20 hover:bg-slate-900/60 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center mb-6 border border-teal-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Secure Gate Access</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Access gates and smart bollards open automatically via secure Bluetooth token or licence plate recognition technology.
                    </p>
                </div>
            </div>
        </section>

        <!-- Rent Driveway Section -->
        <section id="monetize" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-slate-900">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-slate-900 to-indigo-950/80 border border-slate-800 p-8 sm:p-12 lg:p-16">
                <!-- Glowing effect -->
                <div class="absolute top-0 right-0 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-6">
                        <span class="text-teal-400 font-bold text-sm tracking-widest uppercase">Monetize Your Space</span>
                        <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                            Have an empty driveway? <br class="hidden sm:block">
                            Start earning passive income.
                        </h2>
                        <p class="text-slate-400 max-w-xl leading-relaxed font-light">
                            List your private parking space, driveway, or garage spot on Parking Hawker when you aren't using it and watch the extra cash flow in.
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right">
                        <a href="#simulator" class="inline-block px-8 py-4 rounded-2xl bg-teal-400 hover:bg-teal-300 text-slate-950 font-bold shadow-lg shadow-teal-500/25 transition-all duration-200">
                            Calculate Earnings
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Ad Slot -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
            <x-ad-slot slot="welcome_bottom_banner" class="my-6" />
        </div>

        <!-- Footer -->
        <footer class="border-t border-slate-900 bg-slate-950/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
                </a>
                <p class="text-xs text-slate-500">
                    &copy; 2026 Parking Hawker. All rights reserved. Created for verification.
                </p>
            </div>
        </footer>

        <!-- Interactive Javascript Code -->
        <script>
            let currentSelected = null;

            function selectSpot(id, name, type, rate, status, distance) {
                // Remove border from all buttons, add to current
                const buttons = document.querySelectorAll('.spot-btn');
                buttons.forEach(btn => {
                    btn.classList.remove('border-teal-400');
                    btn.classList.add('border-teal-500/30');
                });

                // Highlight selected button
                const activeBtn = event.currentTarget;
                activeBtn.classList.remove('border-teal-500/30');
                activeBtn.classList.add('border-teal-400');

                // Update Inspector details
                document.getElementById('spot-name').innerText = 'Spot ' + name;
                document.getElementById('spot-type').innerText = type;
                document.getElementById('spot-rate').innerText = rate;
                document.getElementById('spot-distance').innerText = distance;
                document.getElementById('spot-status').innerText = status;

                // Toggle visibility
                document.getElementById('default-prompt').classList.add('hidden');
                document.getElementById('success-alert').classList.add('hidden');
                
                const inspector = document.getElementById('inspector-card');
                inspector.classList.remove('hidden');
                setTimeout(() => {
                    inspector.classList.remove('opacity-0', 'scale-95');
                    inspector.classList.add('opacity-100', 'scale-100');
                }, 50);

                currentSelected = { id, name, type, rate, status, distance };
            }

            function bookSpot() {
                if(!currentSelected) return;

                // Hide inspector
                const inspector = document.getElementById('inspector-card');
                inspector.classList.add('opacity-0', 'scale-95');
                
                setTimeout(() => {
                    inspector.classList.add('hidden');
                    
                    // Show success
                    const success = document.getElementById('success-alert');
                    success.classList.remove('hidden');
                    setTimeout(() => {
                        success.classList.remove('opacity-0', 'scale-95');
                        success.classList.add('opacity-100', 'scale-100');
                    }, 50);
                }, 200);
            }

            function resetSimulator() {
                // Reset buttons
                const buttons = document.querySelectorAll('.spot-btn');
                buttons.forEach(btn => {
                    btn.classList.remove('border-teal-400');
                    btn.classList.add('border-teal-500/30');
                });

                // Hide success
                document.getElementById('success-alert').classList.add('hidden');
                // Show default prompt
                document.getElementById('default-prompt').classList.remove('hidden');
                
                currentSelected = null;
            }
        </script>
    </body>
</html>
