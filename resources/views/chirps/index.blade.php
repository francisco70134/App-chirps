<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('chirps.store') }}">

                        @csrf

                        <textarea class="bg-transparent w-full rounded-md border border-gray-300 p-4 shadow-sm" name="message"
                            placeholder="{{ __('¿What on your mean?') }}">{{ old('message') }}</textarea>

                        {{-- mensaje de error --}}
                        <x-input-error class="mt-3" :messages="$errors->get('message')" />

                        <x-primary-button class="mt-5">Chirps</x-primary-button>
                    </form>

                </div>
            </div>

            {{-- chirps informacion --}}

            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">

                @foreach ($chirps as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chat-left-text dark:text-gray-200 mt-1" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                        </svg>

                        {{-- FLEX PARA LOS COMENTARIOS --}}

                        <div class="flex-1">
                            <div class="flex flex-col justify-between items-start mb-auto">


                                <div class="mb-2">
                                    <span class="text-gray-800 dark:text-gray-200">{{ $chirp->user->name }}</span>
                                    <small
                                        class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>

                                    @if ($chirp->created_at != $chirp->updated_at)
                                        <small class="ml-2 text-sm text-gray-600 dark:text-gray-400"> &middot;
                                            {{ __('edited') }}</small>
                                    @endif
                                </div>

                                {{-- PARRAFO --}}

                                <p class="text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>

                            </div>

                        </div>


                        {{-- condicionamos si el usuario autenticado es el mismo usaurio que esta en el chirp --}}
                        @can('update', $chirp)
                            <x-dropdown>

                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots dark:text-gray-300"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                        {{ __('Edit Chirps') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                        @csrf @method('DELETE')

                                        <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete Chirps') }}
                                        </x-dropdown-link>

                                    </form>


                                </x-slot>

                            </x-dropdown>
                        @endcan

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
