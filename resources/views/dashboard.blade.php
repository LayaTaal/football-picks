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

    <div class="pt-12 pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 overflow-scroll shadow-sm sm:rounded-lg">
                <h2 class="text-2xl mb-6">Survivor Picks</h2>
                <x-survivor-stats />
            </div>
        </div>
    </div>

</x-app-layout>
