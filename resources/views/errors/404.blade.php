@extends('errors.layout')

@section('title', '404 — Page Not Found')

@section('content')
<div class="w-full max-w-2xl mx-auto text-center space-y-8">

    <!-- Giant glowing code -->
    <div class="relative inline-block">
        <span class="text-[10rem] sm:text-[13rem] font-extrabold leading-none select-none"
              style="background: linear-gradient(135deg, #06b6d4 0%, #8b5cf6 60%, #06b6d4 100%);
                     -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                     filter: drop-shadow(0 0 60px rgba(6,182,212,0.25));">
            404
        </span>
        <!-- Floating parking sign -->
        <div class="absolute -top-4 -right-4 h-14 w-14 rounded-2xl bg-[#06b6d4]/10 border border-[#06b6d4]/30
                    flex items-center justify-center text-2xl animate-bounce shadow-lg shadow-[#06b6d4]/10">
            🅿️
        </div>
    </div>

    <!-- Glass card -->
    <div style="background: rgba(30,41,59,0.45); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255,255,255,0.07); box-shadow: 0 8px 32px rgba(0,0,0,0.4);"
         class="rounded-3xl p-8 space-y-5">

        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold uppercase tracking-wider">
                <span class="h-1.5 w-1.5 rounded-full bg-red-400 animate-pulse"></span>
                Page Not Found
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                This parking spot<br>doesn't exist
            </h1>
            <p class="text-neutral-400 text-sm leading-relaxed max-w-md mx-auto">
                The page you're looking for may have been moved, renamed, or no longer exists.
                No worries — let's get you back on track.
            </p>
        </div>

        <!-- Quick links -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
            @foreach([
                ['icon' => '🏠', 'label' => 'Go Home',        'href' => '/'],
                ['icon' => '🚗', 'label' => 'Find Parking',   'href' => '/find-parking'],
                ['icon' => '📞', 'label' => 'Contact Support', 'href' => '/contact'],
            ] as $link)
            <a href="{{ $link['href'] }}"
               style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);"
               class="flex items-center justify-center gap-2 py-2.5 rounded-2xl text-sm font-semibold text-neutral-300
                      hover:text-white hover:border-white/20 hover:bg-white/8 transition-all">
                <span>{{ $link['icon'] }}</span>{{ $link['label'] }}
            </a>
            @endforeach
        </div>

        <!-- Primary CTA -->
        <a href="/"
           style="background: linear-gradient(135deg, #06b6d4, #8b5cf6);"
           class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl text-white font-bold text-sm
                  shadow-lg shadow-[#06b6d4]/20 hover:opacity-90 transition-all">
            🚀 Back to ParkingHawker
        </a>
    </div>

    <!-- Tip -->
    <p class="text-xs text-neutral-600">
        Error 404 · If you believe this is a mistake,
        <a href="/contact" class="text-[#06b6d4] hover:underline">let us know</a>.
    </p>
</div>
@endsection
