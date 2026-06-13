@extends('errors.layout')

@section('title', '503 — Service Unavailable')

@section('content')
<div class="w-full max-w-2xl mx-auto text-center space-y-8">

    <!-- Giant glowing code -->
    <div class="relative inline-block">
        <span class="text-[10rem] sm:text-[13rem] font-extrabold leading-none select-none"
              style="background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 60%, #3b82f6 100%);
                     -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                     filter: drop-shadow(0 0 60px rgba(59,130,246,0.25));">
            503
        </span>
        <!-- Floating Under Construction -->
        <div class="absolute -top-4 -right-4 h-14 w-14 rounded-2xl bg-blue-500/10 border border-blue-500/30
                    flex items-center justify-center text-2xl shadow-lg shadow-blue-500/10">
            🚧
        </div>
    </div>

    <!-- Glass card -->
    <div style="background: rgba(30,41,59,0.45); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255,255,255,0.07); box-shadow: 0 8px 32px rgba(0,0,0,0.4);"
         class="rounded-3xl p-8 space-y-5">

        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider">
                <span class="h-1.5 w-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                Under Maintenance
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Parking lot temporarily<br>closed for maintenance
            </h1>
            <p class="text-neutral-400 text-sm leading-relaxed max-w-md mx-auto">
                We are currently upgrading our systems to make your parking experience even better. We'll be back online in just a few minutes.
            </p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 pt-1">
            <a href="javascript:location.reload()"
               style="background: linear-gradient(135deg, #3b82f6, #06b6d4);"
               class="flex-1 text-center py-3 rounded-2xl text-white font-bold text-sm shadow-lg hover:opacity-90 transition-all">
                🔄 Refresh Page
            </a>
            <a href="/contact"
               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"
               class="flex-1 text-center py-3 rounded-2xl text-neutral-300 font-semibold text-sm hover:text-white hover:bg-white/10 transition-all">
                📞 Contact Support
            </a>
        </div>
    </div>

    <p class="text-xs text-neutral-600">
        Error 503 · Service Temporarily Unavailable
    </p>
</div>
@endsection
