<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Topic') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update the topic details.') }}
        </p>
    </header>



    <form method="post" action="{{ route('admin.topics.update', $topic->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name" :value="old('name', $topic->name)" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="slug" :value="old('slug', $topic->slug)" />
            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area-input id="description" name="description" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="description">
                {{ $topic->description }}
            </x-text-area-input>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update Topic') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
