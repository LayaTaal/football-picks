<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $round->title }}
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
                                    Away Team
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">
                                    Home Team
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">
                                    Date
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="text-right">
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
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    Team 1
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="text-sm font-medium text-gray-900">
                                    Team 2
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="text-sm font-medium text-gray-900">
                                    7-14-2022
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="text-sm font-medium text-gray-900">
                                    31 - 10
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="#">Edit</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
