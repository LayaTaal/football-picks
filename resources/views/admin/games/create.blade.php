<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Game') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <div class="w-full md:w-1/3">
                    <form method="POST" action="/admin/games" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <x-label for="away_team">Away Team</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="away_team"
                                id="away_team"
                                required>
                                <option value="">Select Team</option>

                                @foreach( $teams as $team )
                                    <option value="{{ $team->id }}" {{ old( 'away_team' ) === $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>

                            @error( 'away_team' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="home_team">Home Team</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="home_team"
                                id="home_team"
                                required>
                                <option value="">Select Team</option>

                                @foreach( $teams as $team )
                                    <option value="{{ $team->id }}" {{ old( 'home_team' ) === $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>

                            @error( 'home_team' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="round_id">Round</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="round_id"
                                id="round_id">
                                <option value="">Select Round</option>

                                @foreach( $rounds as $round )
                                    <option
                                        value="{{ $round->id }}"
                                        {{ old( 'round_id' ) === $team->id || $round->id == request()->get( 'round' ) ? 'selected' : '' }}
                                    >
                                        {{ $round->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error( 'round_id' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="season_id">Season</x-label>

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="season_id"
                                id="season_id">
                                <option value="">Select Season</option>

                                @foreach( $seasons as $season )
                                    <option
                                        value="{{ $season->id }}"
                                        {{ old( 'season_id' ) === $team->id || $season->id == request()->get( 'season' ) ? 'selected' : '' }}
                                    >
                                        {{ $season->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error( 'season_id' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="date" class="block">Game Date:</x-label>

                            <x-input
                                type="datetime-local"
                                name="date"
                                id="date"
                                value="{{ old( 'date' ) }}"
                            />

                            @error( 'date' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="away_team_score" class="block">Away Team Score</x-label>

                            <x-input
                                type="number"
                                min="0"
                                max="100"
                                name="away_team_score"
                                id="away_team_score"
                                value="{{ old( 'away_team_score' ) }}"
                            />

                            @error( 'away_team_score' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="home_team_score" class="block">Home Team Score</x-label>

                            <x-input
                                type="number"
                                min="0"
                                max="100"
                                name="home_team_score"
                                id="home_team_score"
                                value="{{ old( 'home_team_score' ) }}"
                            />

                            @error( 'home_team_score' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-button type="submit">Add Game</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
