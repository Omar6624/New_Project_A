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
            <div class="rounded-2xl border border-gray-200 overflow-hidden bg-gray-50 mb-10">
                <iframe srcdoc="{{ $lesson->widget_html }}" sandbox="allow-scripts" loading="lazy"
                    class="w-full block border-none min-h-96" x-data x-ref="widgetframe"
                    @load="
                        try {
                            const h = $refs.widgetframe.contentDocument.body.scrollHeight;
                            if (h > 100) $refs.widgetframe.style.minHeight = h + 'px';
                        } catch(e) {}
                    "></iframe>
            </div>
        @endif

        {{-- Content chunks --}}
        @if ($lesson->content)
            <div class="flex items-center gap-3 my-8">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">Explanation</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <div x-data="chunkReader(@json($lesson->content))" x-cloak>
                {{-- Chunk content --}}
                <div class="min-h-48">
                    <template x-for="(chunk, i) in chunks" :key="i">
                        <div x-show="current === i" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0" x-html="chunk"
                            class="text-base text-gray-700 leading-[1.85] space-y-4"></div>
                    </template>
                </div>

                {{-- Pagination bar --}}
                <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">

                    <button @click="prev()" :disabled="current === 0"
                        class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 disabled:opacity-30 disabled:cursor-not-allowed transition">
                        ← Prev
                    </button>

                    <div class="flex-1 flex justify-center gap-2">
                        <template x-for="(chunk, i) in chunks" :key="i">
                            <button @click="goTo(i)"
                                :class="current === i ? 'bg-indigo-500 scale-125' : 'bg-gray-300 hover:bg-gray-400'"
                                class="w-2 h-2 rounded-full transition-all duration-150"
                                :aria-label="'Go to section ' + (i + 1)"></button>
                        </template>
                    </div>

                    <span class="text-xs text-gray-400 tabular-nums"
                        x-text="(current + 1) + ' / ' + chunks.length"></span>

                    <button @click="next()" :disabled="current === chunks.length - 1"
                        class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 disabled:opacity-30 disabled:cursor-not-allowed transition">
                        Next →
                    </button>

                </div>
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
        document.addEventListener('alpine:init', () => {
            Alpine.data('chunkReader', (raw) => ({
                current: 0,
                chunks: [],

                init() {
                    this.chunks = this.split(raw, 800);
                },

                split(text, size) {
                    const paragraphs = text.split(/\n{2,}/);
                    const chunks = [];
                    let buf = '';
                    for (const p of paragraphs) {
                        if (buf.length + p.length > size && buf.length > 0) {
                            chunks.push(this.render(buf.trim()));
                            buf = p;
                        } else {
                            buf += (buf ? '\n\n' : '') + p;
                        }
                    }
                    if (buf.trim()) chunks.push(this.render(buf.trim()));
                    return chunks;
                },

                render(text) {
                    return text
                        .replace(/^### (.+)$/gm,
                            '<h3 class="text-base font-semibold mt-5 mb-2 text-gray-800">$1</h3>')
                        .replace(/^## (.+)$/gm,
                            '<h2 class="text-lg font-semibold mt-6 mb-3 text-gray-900">$1</h2>')
                        .replace(/\*\*(.+?)\*\*/g,
                            '<strong class="font-semibold text-gray-900">$1</strong>')
                        .replace(/`([^`]+)`/g,
                            '<code class="text-sm bg-gray-100 text-gray-800 px-1.5 py-0.5 rounded font-mono">$1</code>'
                        )
                        .replace(/\n/g, '<br>');
                },

                goTo(i) {
                    this.current = i;
                    this.$el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                },

                prev() {
                    if (this.current > 0) this.goTo(this.current - 1);
                },
                next() {
                    if (this.current < this.chunks.length - 1) this.goTo(this.current + 1);
                },
            }));
        });
    </script>

</x-app-homepage>
