<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Season: ') . $season->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-quicklinks />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white divide-y divide-gray-200">
                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Round
                                    </div>
                                </div>
                            </th>
                            <th class="px-6 py-4 whitespace-nowrap">
                                <div class="text-right">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Start Date
                                    </div>
                                </div>
                            </th>
                            <th class="px-6 py-4 whitespace-nowrap">
                                <div class="text-right">
                                    <div class="text-sm font-semibold text-gray-900">
                                        End Date
                                    </div>
                                </div>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($rounds as $round)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/rounds/{{ $round->id }}">
                                                {{ $round->title }}
                                            </a>
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
            </div>
            <x-quicklinks class="mt-6">
                <x-button-link href="/admin/rounds/create">
                    Add Round
                </x-button-link>
            </x-quicklinks>
        </div>
    </div>
</x-app-layout>
