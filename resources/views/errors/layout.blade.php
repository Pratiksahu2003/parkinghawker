<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error') | ParkingHawker</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#030712] text-slate-100 antialiased overflow-x-hidden">

    <!-- Ambient background glows -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 h-[600px] w-[600px] rounded-full bg-[#8b5cf6]/6 blur-[140px]"></div>
        <div class="absolute top-1/2 -right-40 h-[500px] w-[500px] rounded-full bg-[#06b6d4]/5 blur-[130px]"></div>
        <div class="absolute -bottom-40 left-1/3 h-[400px] w-[400px] rounded-full bg-[#8b5cf6]/4 blur-[120px]"></div>
        <!-- Dot grid -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(139,92,246,0.04)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
    </div>

    <!-- Minimal nav bar -->
    <header class="relative z-10 border-b border-white/5 bg-[#030712]/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2.5">
                <img src="{{ asset('logo/logo.png') }}" alt="ParkingHawker" class="h-10 w-auto object-contain">
            </a>
            <a href="/"
               class="px-5 py-2 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 text-sm font-semibold text-neutral-300 hover:text-white transition-all">
                ← Back to Home
            </a>
        </div>
    </header>

    <!-- Main error content -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-6 py-20">
        @yield('content')
    </main>

    <!-- Footer strip -->
    <footer class="relative z-10 border-t border-white/5 bg-[#030712]/60 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-neutral-600">
            <span>© {{ date('Y') }} ParkingHawker Inc. All rights reserved.</span>
            <div class="flex items-center gap-4">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <a href="/find-parking" class="hover:text-white transition-colors">Find Parking</a>
                <a href="/contact" class="hover:text-white transition-colors">Contact Support</a>
            </div>
        </div>
    </footer>

</body>
</html>
