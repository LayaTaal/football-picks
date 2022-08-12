<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl mb-6">{{ $active_round->title }} Picks</h1>
                    @if ( $current_games->isNotEmpty() )

                        <form method="POST" action="/dashboard/" enctype="multipart/form-data">
                            @csrf
                            @method( 'PATCH' )

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-bold text-gray-900">
                                                <div class="">
                                                    Away Team
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-bold text-gray-900">
                                                <div class="">
                                                    Home Team
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-bold text-gray-900">
                                                <div class="">
                                                    Date
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-bold text-gray-900">
                                                <div class="">
                                                    Time
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($current_games as $game)
                                        <?php $away_team = \App\Models\Team::find( $game->away_team ); ?>
                                        <?php $home_team = \App\Models\Team::find( $game->home_team ); ?>

                                    <input type="hidden" id="games[]" name="games[]" value="{{ $game->id }}">

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap{{ $game->has_score() && $game->winning_team()->id === $away_team->id ? ' winning-team' : '' }}">
                                            <div class="flex items-center">
                                                <x-picks.game :game="$game" :team="$away_team" />
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <div class="">@</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap{{ $game->has_score() && $game->winning_team()->id === $home_team->id ? ' bg-green-400' : '' }}">
                                            <div class="flex items-center">
                                                <x-picks.game :game="$game" :team="$home_team" />
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $game->formatted_date() }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $game->formatted_time() }} ET
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                            <div class="mt-6">
                                <x-button type="submit">Make Picks</x-button>
                            </div>
                        </form>

                    @else
                        <p>No games this week.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
