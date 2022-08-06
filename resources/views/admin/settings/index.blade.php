<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Global Settings: ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-quicklinks />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <div class="w-full md:w-1/3">
                    <form method="POST" action="/admin/settings/" enctype="multipart/form-data">
                        @csrf
                        @method( 'PATCH' )

                        <div class="mb-6">
                            <x-label for="active_season">Active Season</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="active_season"
                                id="active_season"
                                required>
                                <option value="">Select a Season</option>

                                @foreach( $seasons as $season )
                                    <option value="{{ $season->id }}" {{ $season->id === $active_season->id ? 'selected' : '' }}>{{ $season->title }}</option>
                                @endforeach
                            </select>

                            @error( 'active_season' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="active_round">Active Round</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="active_round"
                                id="active_round"
                                required>
                                <option value="">Select a Round</option>

                                @foreach( $rounds as $round )
                                    <option value="{{ $round->id }}" {{ $round->id === $active_round->id ? 'selected' : '' }}>{{ $round->title }}</option>
                                @endforeach
                            </select>

                            @error( 'active_round' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-button type="submit">Update Settings</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
