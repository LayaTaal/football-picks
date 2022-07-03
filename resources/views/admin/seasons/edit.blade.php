<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Season: ') . $season->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-quicklinks />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <div class="w-full md:w-1/3">
                    <form method="POST" action="/admin/seasons/{{ $season->id }}" enctype="multipart/form-data">
                        @csrf
                        @method( 'PATCH' )

                        <div class="mb-6">
                            <x-label for="title" :value="__( 'Season Name' )" />

                            <x-input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old( 'title', $season->title ) }}"
                                required
                            />

                            @error( 'title' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-button type="submit">Edit Season</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
