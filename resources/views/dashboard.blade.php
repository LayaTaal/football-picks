<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    <x-section :title="$active_round->title">
        @if ( $current_games->isNotEmpty() )
            <x-picks.user-picks :games="$current_games"/>
        @else
            <p>No games this week.</p>
        @endif
    </x-section>

    <x-section :title="$active_round->title . ' Standings'">
        <x-league-picks />
    </x-section>

    <x-section title="Season Standings">
        <x-season-stats />
    </x-section>

    <x-section title="Survivor Picks">
        <x-survivor-stats />
    </x-section>

</x-app-layout>
