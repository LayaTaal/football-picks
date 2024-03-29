<div {{ $attributes }}>
    <form method="POST" action="/dashboard" enctype="multipart/form-data">
        @csrf
        @method( 'PATCH' )

        <table class="min-w-full divide-y divide-gray-200 block overflow-x-auto md:table">
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

            @foreach ($games as $game)
                    <?php $away_team = \App\Models\Team::find( $game->away_team ); ?>
                    <?php $home_team = \App\Models\Team::find( $game->home_team ); ?>

                <input type="hidden" id="games[]" name="games[]" value="{{ $game->id }}">

                <tr>
                    @if( $game->has_score() && $away_team->id === $game->user_pick?->team_id )
                        <td class="px-6 py-4 whitespace-nowrap{{ ! $game->home_team_won()  ? ' bg-green-400' : ' bg-red-400' }}">
                            <div class="flex items-center">
                                <x-picks.game :game="$game" :team="$away_team"/>
                            </div>
                        </td>
                    @else
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <x-picks.game :game="$game" :team="$away_team"/>
                            </div>
                        </td>
                    @endif

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-sm font-medium text-gray-900">
                            @
                        </div>
                    </td>

                    @if( $game->has_score() && $home_team->id === $game->user_pick?->team_id )
                        <td class="px-6 py-4 whitespace-nowrap{{ $game->home_team_won() ? ' bg-green-400' : ' bg-red-400' }}">
                            <div class="flex items-center">
                                <x-picks.game :game="$game" :team="$home_team"/>
                            </div>
                        </td>
                    @else
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <x-picks.game :game="$game" :team="$home_team"/>
                            </div>
                        </td>
                    @endif

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

        <x-picks.survivor-picks />

        <div class="mt-6">
            <x-button type="submit">Make Picks</x-button>
        </div>
    </form>
</div>
