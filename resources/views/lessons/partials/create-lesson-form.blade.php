<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create Lesson') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create a new lesson.') }}
        </p>
    </header>



    <form method="post" action="{{ route('admin.lessons.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="slug" />
            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
        </div>

        <div>
            <x-input-label for="widget_html" :value="__('Widget HTML')" />

            <textarea id="widget_html" name="widget_html" x-data="{ html: `{{ old('widget_html', '') }}` }" x-model="html"
                @input="$refs.preview.srcdoc = html" rows="15"
                class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('widget_html', '') }}</textarea>

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
                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('topic_id')" />
        </div>

        <div>
            <x-input-label for="sources" :value="__('Sources')" />
            <x-text-input id="sources" name="sources" type="text" rows="10" class="mt-1 block w-full"
                autofocus autocomplete="sources" />
            <x-input-error class="mt-2" :messages="$errors->get('sources')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create Lesson') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

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
        background-color: #fff;
        color: #111827;
    }

    .dark .ck-editor__editable {
        background-color: #111827 !important;
        color: #d1d5db !important;
        border-color: #374151 !important;
    }

    .ck-editor__editable:focus {
        border-color: #6366f1 !important;
        ring: #6366f1 !important;
    }
</style>
