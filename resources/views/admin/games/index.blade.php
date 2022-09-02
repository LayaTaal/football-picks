<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                @if ( $games->isNotEmpty() )
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Game
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Date
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Time
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Score
                                    </div>
                                </td>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($games as $game)
                            <?php $away_team = \App\Models\Team::find( $game->away_team ); ?>
                            <?php $home_team = \App\Models\Team::find( $game->home_team ); ?>


                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $away_team->name }} at {{ $home_team->name }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $game->formatted_date() }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $game->formatted_time() }} ET
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        @if( $game->has_score() )
                                            {{ $away_team->score() }} - {{ $home_team->score() }}
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/games/{{ $game->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/games/{{ $game->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No games for now.</p>
                @endif
            </div>
            <x-quicklinks class="mt-6">
                <x-button-link href="/admin/games/create">
                    Add New Game
                </x-button-link>
            </x-quicklinks>
        </div>
    </div>
</x-app-layout>
