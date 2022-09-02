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
    </label>

    @if( $game->has_score() && $team->score() ) {
        <span class="ml-2 font-bold">({{ $team->score() }})</span>
    @endif
</div>
