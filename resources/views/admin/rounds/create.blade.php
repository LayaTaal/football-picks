<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Round') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <div class="w-full md:w-1/3">
                    <form method="POST" action="/admin/rounds" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <x-label for="title">Round Name</x-label>

                            <x-input
                                type="text"
                                name="title"
                                id="title"
                                required
                                value="{{ old( 'title' ) }}"
                            />

                            @error( 'title' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="start_date">Start Date:</x-label>

                            <x-input
                                type="date"
                                name="start_date"
                                id="start_date"
                                required
                                value="{{ old( 'start_date' ) }}"
                            />

                            @error( 'start_date' )
                            <p>{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="mb-6">
                            <x-label for="end_date" class="block">End Date:</x-label>

                            <x-input
                                type="date"
                                name="end_date"
                                id="end_date"
                                required
                                value="{{ old( 'end_date' ) }}"
                            />

                            @error( 'end_date' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="season_id">Season</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="season_id"
                                id="season_id"
                                required>
                                <option value="">Select a Season</option>

                                @foreach( $seasons as $season )
                                    <option value="{{ $season->id }}" {{ old( 'season_id' ) === $season->id ? 'selected' : '' }}>{{ $season->title }}</option>
                                @endforeach
                            </select>

                            @error( 'season_id' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-button type="submit">Create Round</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
