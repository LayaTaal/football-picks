<div class="border-t pt-10 pb-2">
    <h2 class="text-2xl mb-6">Are you a survivor?</h2>

    @if( $round_started )
        @foreach( $user_picks as $pick )
            This week's survivor pick: <span class="font-semibold text-green-600">{{ \App\Models\Team::find( $pick->team_id )->name }}</span>
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
                    <option value="{{ $team->id }}" {{ old( 'survivor_pick' ) === $team->id || $team->id === $this_weeks_pick ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>

            @error( 'survivor_pick' )
                <p>{{ $message }}</p>
            @enderror
        </div>

    @endif

    <div class="text-sm mt-6 mb-2">Remaining tries: <span class="text-red-600">2</span></div>
    <div class="text-sm md:flex md:flex-nowrap gap-2 mb-2">
        <p class="mb-2 md:mb-0">Teams already picked:</p>
        <p class="md:w-3/5">
            @foreach( $previous_picks as $previous_pick )
                <span class="bg-gray-200 px-2 py-1 text-xs mr-2 rounded-xl">{{ \App\Models\Team::find( $previous_pick )->name }}</span>
            @endforeach
        </p>
    </div>

    <!--<div>Show a message if you are already eliminated from survivor</div>-->
    <!--<div>Show who else is still alive</div>-->


</div>