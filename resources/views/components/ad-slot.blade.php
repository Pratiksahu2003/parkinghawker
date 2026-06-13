@props([
    'slot' => 'default',
    'format' => 'auto',
    'responsive' => 'true',
    'class' => 'my-6'
])

<div class="google-ad-container {{ $class }}">
    @if(app()->isProduction())
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-2075682642541479"
             data-ad-slot="{{ $slot === 'default' ? '8842795632' : $slot }}"
             data-ad-format="{{ $format }}"
             data-full-width-responsive="{{ $responsive }}"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    @else
        <!-- Beautiful premium glassmorphic ad slot placeholder in local/development environment -->
        <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-white/5 p-6 text-center backdrop-blur-md">
            <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-brand-cyan/10 blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-violet-600/10 blur-xl"></div>
            <div class="relative z-10 flex flex-col items-center justify-center py-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-brand-cyan mb-1 px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20">Advertisement</span>
                <p class="text-xs text-neutral-400">Google AdSense Responsive Unit</p>
                <p class="text-[10px] text-neutral-500 mt-1">Publisher: ca-pub-2075682642541479 | Slot: {{ $slot }}</p>
            </div>
        </div>
    @endif
</div>
