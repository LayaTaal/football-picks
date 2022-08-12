<div {{ $attributes->class(['flex flex-nowrap text-sm font-medium text-gray-900']) }}>
    <label for="team_{{ $team->id }}">
        <input
            type="radio"
            id="team_{{ $team->id }}"
            name="game_{{ $game->id }}[]"
            value="{{ $team->id }}"
            class="{{ $game->is_over() ? 'hidden' : '' }}"
            {{ $game->user_pick->team_id === $team->id ? 'checked' : '' }}
        >
        {{ $team->name }}
    </label>

    @if( $team->score() )
        <span class="ml-2 font-bold">({{ $team->score() }})</span>
    @endif
</div>
