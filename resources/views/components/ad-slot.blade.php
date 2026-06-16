@props([
    'slot' => 'default',
    'format' => 'auto',
    'responsive' => 'true',
    'class' => 'my-6'
])

@php
    $uniqueId = 'ad-' . ($slot === 'default' ? rand(100000, 999999) : Str::slug($slot));
    
    $clientId = config('services.google_adsense.client', 'ca-pub-2075682642541479');
    $defaultSlot = config('services.google_adsense.default_slot', '8842795632');
    $forceShow = config('services.google_adsense.force_show', false);
    
    // Resolve string slot to numeric AdSense slot ID
    $numericSlot = $slot;
    if (!is_numeric($slot)) {
        $numericSlot = config('services.google_adsense.slots.' . $slot, $defaultSlot);
    }
    
    if (!is_numeric($numericSlot)) {
        $numericSlot = $defaultSlot;
    }
    
    $shouldRenderAds = app()->isProduction() || $forceShow;
@endphp

<div class="google-ad-container {{ $class }}">
    @if($shouldRenderAds)
        <ins class="adsbygoogle"
             id="{{ $uniqueId }}"
             style="display:block"
             data-ad-client="{{ $clientId }}"
             data-ad-slot="{{ $numericSlot }}"
             data-ad-format="{{ $format }}"
             data-full-width-responsive="{{ $responsive }}"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
             
             // Check if the ad failed to load or was blocked, and collapse space if so
             setTimeout(function() {
                 var ins = document.getElementById('{{ $uniqueId }}');
                 if (ins) {
                     var isUnfilled = ins.getAttribute('data-ad-status') === 'unfilled';
                     var isBlocked = ins.offsetHeight === 0;
                     if (isUnfilled || isBlocked) {
                         var container = ins.closest('.google-ad-container');
                         if (container) {
                             container.style.setProperty('display', 'none', 'important');
                         }
                     }
                 }
             }, 2000);
        </script>
    @else
        <!-- Beautiful premium glassmorphic ad slot placeholder in local/development environment -->
        <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-white/5 p-6 text-center backdrop-blur-md">
            <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-brand-cyan/10 blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-violet-600/10 blur-xl"></div>
            <div class="relative z-10 flex flex-col items-center justify-center py-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-brand-cyan mb-1 px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20">Advertisement</span>
                <p class="text-xs text-neutral-400">Google AdSense Responsive Unit</p>
                <p class="text-[10px] text-neutral-500 mt-1">Publisher: {{ $clientId }} | Slot Name: {{ $slot }} | Resolved Slot ID: {{ $numericSlot }}</p>
            </div>
        </div>
    @endif
</div>
