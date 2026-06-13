@extends('errors.layout')

@section('title', '500 — Server Error')

@section('content')
<div class="w-full max-w-2xl mx-auto text-center space-y-8">

    <!-- Giant glowing code -->
    <div class="relative inline-block">
        <span class="text-[10rem] sm:text-[13rem] font-extrabold leading-none select-none"
              style="background: linear-gradient(135deg, #ef4444 0%, #f97316 60%, #ef4444 100%);
                     -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                     filter: drop-shadow(0 0 60px rgba(239,68,68,0.25));">
            500
        </span>
        <!-- Floating icon -->
        <div class="absolute -top-4 -right-4 h-14 w-14 rounded-2xl bg-orange-500/10 border border-orange-500/30
                    flex items-center justify-center text-2xl shadow-lg shadow-orange-500/10"
             style="animation: spin 4s linear infinite;">
            ⚙️
        </div>
    </div>

    <!-- Glass card -->
    <div style="background: rgba(30,41,59,0.45); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255,255,255,0.07); box-shadow: 0 8px 32px rgba(0,0,0,0.4);"
         class="rounded-3xl p-8 space-y-5">

        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-xs font-bold uppercase tracking-wider">
                <span class="h-1.5 w-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                Internal Server Error
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Something went<br>wrong on our end
            </h1>
            <p class="text-neutral-400 text-sm leading-relaxed max-w-md mx-auto">
                Our servers hit an unexpected bump. Our engineering team has been notified and
                is working to fix this as quickly as possible.
            </p>
        </div>

        <!-- Status indicators -->
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);"
             class="rounded-2xl p-4 space-y-3 text-left">
            <p class="text-[10px] font-bold text-neutral-500 uppercase tracking-widest">System Status</p>
            @foreach([
                ['label' => 'Database Servers',   'status' => 'investigating', 'color' => 'orange'],
                ['label' => 'Booking Service',     'status' => 'degraded',      'color' => 'orange'],
                ['label' => 'CDN & Static Assets', 'status' => 'operational',   'color' => 'green'],
                ['label' => 'Payment Gateway',     'status' => 'operational',   'color' => 'green'],
            ] as $svc)
            <div class="flex items-center justify-between text-xs">
                <span class="text-neutral-400">{{ $svc['label'] }}</span>
                <span class="flex items-center gap-1.5 font-semibold
                    {{ $svc['color'] === 'green' ? 'text-[#10b981]' : 'text-orange-400' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $svc['color'] === 'green' ? 'bg-[#10b981]' : 'bg-orange-400 animate-pulse' }}"></span>
                    {{ ucfirst($svc['status']) }}
                </span>
            </div>
            @endforeach
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 pt-1">
            <a href="javascript:location.reload()"
               style="background: linear-gradient(135deg, #f97316, #ef4444);"
               class="flex-1 text-center py-3 rounded-2xl text-white font-bold text-sm shadow-lg hover:opacity-90 transition-all">
                🔄 Try Again
            </a>
            <a href="/"
               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"
               class="flex-1 text-center py-3 rounded-2xl text-neutral-300 font-semibold text-sm hover:text-white hover:bg-white/10 transition-all">
                🏠 Back to Home
            </a>
        </div>
    </div>

    <p class="text-xs text-neutral-600">
        Error 500 · Timestamp: {{ now()->format('Y-m-d H:i:s T') }} ·
        <a href="/contact" class="text-[#06b6d4] hover:underline">Report this issue</a>
    </p>
</div>
@endsection
