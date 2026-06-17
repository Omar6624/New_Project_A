<x-app-homepage>

    <div class="max-w-3xl mx-auto px-5 py-10 pb-20">
        {{-- Title --}}
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 leading-snug mb-3">
            {{ $lesson->title }}
        </h1>

        {{-- Summary --}}
        @if ($lesson->summary)
            <p class="text-base text-gray-500 leading-relaxed border-l-2 border-gray-200 pl-4 mb-8">
                {{ $lesson->summary }}
            </p>
        @endif

        {{-- Widget --}}
        @if ($lesson->widget_html)
            <div class="rounded-2xl border border-gray-200 overflow-hidden bg-gray-50 mb-10 p-4">
                <iframe srcdoc="{{ $lesson->widget_html }}" sandbox="allow-scripts" loading="lazy"
                    class="w-full block border-none min-h-[500px]"></iframe>
            </div>
        @endif

        {{-- Content chunks --}}
        @if ($lesson->content)
            <div class="flex items-center gap-3 my-8">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">Explanation</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>
            <div>
                {!! $lesson->content !!}
            </div>
        @endif

        {{-- Sources --}}
        @if ($lesson->sources)
            <div class="mt-12 pt-6 border-t border-gray-100">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-2">Sources</p>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $lesson->sources }}</p>
            </div>
        @endif

    </div>


    <script>
        window.resizeWidget = function(iframe) {
            try {
                const h = iframe.contentDocument.body.scrollHeight;
                if (h > 100) iframe.style.minHeight = h + 'px';
            } catch (e) {}
        }
    </script>
</x-app-homepage>
