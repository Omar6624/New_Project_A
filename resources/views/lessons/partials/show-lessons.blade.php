<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('All Lessons') }}
        </h2>
    </header>

    <div class="mt-6 space-y-6">

        @foreach ($lessons as $lesson)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $lesson->title }}</h3>
                </div>

                <div>
                    <a href="{{ route('admin.lessons.edit', $lesson) }}"
                        class="text-sm text-blue-600 dark:text-blue-400 hover:underline">{{ __('Edit') }}</a>

                    <form method="post" action="{{ route('admin.lessons.destroy', $lesson) }}" class="inline">
                        @csrf
                        @method('delete')

                        <button type="submit"
                            class="text-sm text-red-600 dark:text-red-400 hover:underline ml-4">{{ __('Delete') }}</button>
                    </form>


                    <form method="post" action="{{ route('admin.lessons.publish', $lesson) }}" class="inline">
                        @csrf
                        @method('post')

                        <button type="submit"
                            class="text-sm {{ $lesson->is_published ? 'text-purple-600 dark:text-purple-400' : 'text-green-600 dark:text-green-400' }} hover:underline ml-4">
                            {{ $lesson->is_published ? __('Unpublish') : __('Publish') }}</button>

                    </form>
                </div>
            </div>
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
