<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('chirps.update', $chirp) }}">

                        @csrf @method('PUT')

                        <textarea class="bg-transparent w-full rounded-md border border-gray-300 p-4 shadow-sm" name="message"
                            placeholder="{{ __('¿What on your mean?') }}">{{ old('message', $chirp->message) }}</textarea>

                        {{-- mensaje de error --}}
                        <x-input-error class="mt-3" :messages="$errors->get('message')" />

                        <x-primary-button class="mt-5">{{ __('Update Chirp') }}</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
