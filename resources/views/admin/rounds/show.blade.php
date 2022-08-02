<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $round->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-quicklinks>
                <a href="{{ url()->previous() }}">{{ __( 'Back to Previous' ) }}</a>
            </x-quicklinks>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white divide-y divide-gray-200">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-semibold text-gray-900">
                                    Game
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-left">
                                <div class="text-sm font-semibold text-gray-900">
                                    Date
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-left">
                                <div class="text-sm font-semibold text-gray-900">
                                    Time
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-left">
                                <div class="text-sm font-semibold text-gray-900">
                                    Score
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">
                                    Actions
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach( $round->games as $game )
                            <?php $away_team = \App\Models\Team::find( $game->away_team ); ?>
                            <?php $home_team = \App\Models\Team::find( $game->home_team ); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $away_team->name }} at {{ $home_team->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse( $game->date )->format( 'D F j, Y' ) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse( $game->date )->format( 'g:i a' ) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $game->away_team_score }} - {{ $game->home_team_score }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="/admin/games/{{ $game->id }}/edit">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <x-quicklinks class="mt-6">
                <x-button-link href="/admin/games/create?round={{ $round->id }}">
                    Add Game
                </x-button-link>
            </x-quicklinks>
        </div>
    </div>
</x-app-layout>
