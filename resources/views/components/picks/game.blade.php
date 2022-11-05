<div {{ $attributes->class(['flex flex-nowrap text-sm font-medium text-gray-900']) }}>
    <label for="team_{{ $team->id }}">
        <input
            type="radio"
            id="team_{{ $team->id }}"
            name="game_{{ $game->id }}[]"
            value="{{ $team->id }}"
            class="{{ $game->is_over() ? 'hidden' : '' }}"
            @if ( $game->user_pick )
                {{ $game->user_pick->team_id === $team->id ? 'checked' : '' }}
            @endif
        >
        {{ $team->name }}
        @if( ( $game->is_over() && ! $game->has_score() ) )
            @if ( $game->user_pick )
                @if( $game->user_pick->team_id === $team->id )
                    <span><x-gmdi-check-circle class="text-green-600 w-4 h-4 inline-block align-middle"/></span>
                @endif
            @endif
        @endif
    </label>
    @if( $game->has_score() )
        <span class="ml-2 font-bold">({{ $team->score( $game ) }})</span>
    @endif
</div>
