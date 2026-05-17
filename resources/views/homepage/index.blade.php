<x-app-homepage>

    <div class="max-w-4xl mx-auto px-5 py-12">

        @if ($lessons->isEmpty())
            <div class="text-center py-24">
                <p class="text-gray-400 text-sm">No lessons yet. Add one from the admin panel.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($lessons as $index => $lesson)
                    <a href="{{ route('lessons.show', $lesson->slug) }}"
                        class="group relative flex flex-col justify-between rounded-2xl border border-gray-200 bg-white p-5 hover:border-indigo-300 hover:shadow-sm transition-all duration-150"
                        style="animation: fadeUp .3s ease both; animation-delay: {{ $index * 60 }}ms">

                        {{-- Number badge --}}
                        <span
                            class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gray-100 text-gray-400 text-xs font-semibold mb-4 group-hover:bg-indigo-50 group-hover:text-indigo-500 transition">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        {{-- Title + summary --}}
                        <div class="flex-1">
                            <h3
                                class="text-base font-semibold text-gray-900 leading-snug mb-1.5 group-hover:text-indigo-700 transition">
                                {{ $lesson->title }}
                            </h3>
                            @if ($lesson->summary)
                                <p class="text-sm text-gray-400 leading-relaxed line-clamp-2">
                                    {{ $lesson->summary }}
                                </p>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            @if ($lesson->read_time_minutes)
                                <span class="text-xs text-gray-400">{{ $lesson->read_time_minutes }} min</span>
                            @else
                                <span></span>
                            @endif
                            <span
                                class="text-xs font-medium text-indigo-500 group-hover:translate-x-0.5 transition-transform duration-150">
                                Read →
                            </span>
                        </div>

                        {{-- Widget indicator dot --}}
                        @if ($lesson->widget_html)
                            <span class="absolute top-4 right-4 w-1.5 h-1.5 rounded-full bg-indigo-400"
                                title="Has interactive widget"></span>
                        @endif

                    </a>
                @endforeach
            </div>
        @endif

    </div>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</x-app-homepage>
