<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Rounds') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-quicklinks>
                <a
                    href="/admin/rounds/create"
                    class="text-white bg-blue-500 uppercase font-semibold px-5 py-2 rounded-2xl hover:bg-blue-600 text-xs">
                    Add New Round
                </a>
            </x-quicklinks>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                @if ( $rounds->isNotEmpty() )
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($rounds as $round)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $round->title  }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $round->start_date }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $round->end_date }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/rounds/{{ $round->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/rounds/{{ $round->id }}">
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
                    <p>No rounds yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
