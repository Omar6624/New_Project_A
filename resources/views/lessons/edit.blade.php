<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-6xl">


                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Edit Lesson') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update the lesson details.') }}
                        </p>
                    </header>



                    <form method="post" action="{{ route('admin.lessons.update', $lesson) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="title" value="{{ old('title', $lesson->title) }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" :value="__('Slug')" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="slug" value="{{ old('slug', $lesson->slug) }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div>
                            <x-input-label for="widget_html" :value="__('Widget HTML')" />

                            <textarea id="widget_html" name="widget_html" x-data="{ html: `{{ old('widget_html', '') }}` }" x-model="html"
                                @input="$refs.preview.srcdoc = html" rows="15"
                                class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('widget_html', $lesson->widget_html) }}</textarea>

                            <iframe x-ref="preview" sandbox="allow-scripts" srcdoc="{{ old('widget_html', '') }}"
                                style="width:100%; min-height:400px; border:1px solid #ccc; border-radius:8px; margin-top:8px"></iframe>

                            <x-input-error class="mt-2" :messages="$errors->get('widget_html')" />
                        </div>


                        <div>
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="10">{{ old('content', $lesson->content ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>
                        <div>
                            <x-input-label for="topic_id" :value="__('Topic')" />
                            <select id="topic_id" name="topic_id"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">{{ __('Select a topic') }}</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}"
                                        {{ old('topic_id', $lesson->topic_id) == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('topic_id')" />
                        </div>

                        <div>
                            <x-input-label for="sources" :value="__('Sources')" />
                            <x-text-input id="sources" name="sources" type="text" rows="10"
                                class="mt-1 block w-full" autofocus autocomplete="sources"
                                value="{{ old('sources', $lesson->sources) }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('sources')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Lesson') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#content')).catch(console.error);
</script>

<style>
    .ck-editor__editable {
        min-height: 400px;
        width: 100%;
        border-color: #d1d5db !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05) !important;
        background-color: #111827 !important;
        color: #d1d5db !important;
    }
</style>
