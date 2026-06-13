@extends('errors.layout')

@section('title', '429 — Too Many Requests')

@section('content')
<div class="w-full max-w-2xl mx-auto text-center space-y-8">

    <!-- Giant glowing code -->
    <div class="relative inline-block">
        <span class="text-[10rem] sm:text-[13rem] font-extrabold leading-none select-none"
              style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 60%, #ec4899 100%);
                     -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                     filter: drop-shadow(0 0 60px rgba(236,72,153,0.25));">
            429
        </span>
        <!-- Floating Traffic Light -->
        <div class="absolute -top-4 -right-4 h-14 w-14 rounded-2xl bg-pink-500/10 border border-pink-500/30
                    flex items-center justify-center text-2xl shadow-lg shadow-pink-500/10">
            🚦
        </div>
    </div>

    <!-- Glass card -->
    <div style="background: rgba(30,41,59,0.45); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255,255,255,0.07); box-shadow: 0 8px 32px rgba(0,0,0,0.4);"
         class="rounded-3xl p-8 space-y-5">

        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-400 text-xs font-bold uppercase tracking-wider">
                <span class="h-1.5 w-1.5 rounded-full bg-pink-400 animate-pulse"></span>
                Rate Limit Exceeded
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Slow down! Too much<br>traffic here
            </h1>
            <p class="text-neutral-400 text-sm leading-relaxed max-w-md mx-auto">
                You've made too many requests in a short period. Please wait a moment and try refreshing the page to clear the jam.
            </p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 pt-1">
            <a href="javascript:location.reload()"
               style="background: linear-gradient(135deg, #ec4899, #8b5cf6);"
               class="flex-1 text-center py-3 rounded-2xl text-white font-bold text-sm shadow-lg hover:opacity-90 transition-all">
                🔄 Try Refreshing
            </a>
            <a href="/"
               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"
               class="flex-1 text-center py-3 rounded-2xl text-neutral-300 font-semibold text-sm hover:text-white hover:bg-white/10 transition-all">
                🏠 Back to Home
            </a>
        </div>
    </div>

    <p class="text-xs text-neutral-600">
        Error 429 · Too Many Requests / Rate Limited
    </p>
</div>
@endsection
