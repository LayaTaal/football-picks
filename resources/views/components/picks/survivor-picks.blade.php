<div class="border-t pt-10 pb-2">
    @if( $round_started )
        @foreach( $user_picks as $pick )
            This week's survivor pick: {{ \App\Models\Team::find( $pick->team_id )->name }}
        @endforeach
    @else

        <div class="mb-6 md:flex md:justify-start md:flex-nowrap md:items-center md:gap-4">
            <x-label for="survivor_pick" class="font-bold">Select a team for survivor: </x-label>

            <select
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="survivor_pick"
                id="survivor_pick"
                required>
                <option value="">Select Team</option>

                @foreach( $teams as $team )
                    <option value="{{ $team->id }}" {{ old( 'survivor_pick' ) === $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>

            @error( 'survivor_pick' )
                <p>{{ $message }}</p>
            @enderror
        </div>

    @endif
</div>
