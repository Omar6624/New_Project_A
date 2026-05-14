<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('All Topic') }}
        </h2>
    </header>

    <div class="mt-6 space-y-6">
        @foreach ($topics as $topic)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $topic->name }}</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $topic->description }}</p>
                </div>

                <div>
                    <a href="{{ route('admin.topics.edit', $topic) }}"
                        class="text-sm text-blue-600 dark:text-blue-400 hover:underline">{{ __('Edit') }}</a>

                    <form method="post" action="{{ route('admin.topics.destroy', $topic) }}" class="inline">
                        @csrf
                        @method('delete')

                        <button type="submit"
                            class="text-sm text-red-600 dark:text-red-400 hover:underline ml-4">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>

            @if ($topic->lessons->isEmpty())
                <div class="ml-2 sm:ml-4 p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('No lessons found for this topic.') }}
                        </p>
                    </div>
                </div>
            @else
                @foreach ($topic->lessons as $lesson)
                    <div class="ml-2 sm:ml-4 p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $lesson->title }}</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}"
                                class="text-sm text-blue-600 dark:text-blue-400 hover:underline">{{ __('Edit') }}</a>

                            <form method="post" action="{{ route('admin.lessons.destroy', $lesson->id) }}"
                                class="inline">
                                @csrf
                                @method('delete')

                                <button type="submit"
                                    class="text-sm text-red-600 dark:text-red-400 hover:underline ml-4">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach

        @if ($topics->isEmpty())
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('No topics found.') }}</p>
                </div>
            </div>
        @endif
    </div>



</section>
