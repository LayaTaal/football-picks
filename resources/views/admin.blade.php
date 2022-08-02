<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <div class="w-1/3 pr-4">
                            <h3 class="pb-2 border-b border-gray-200 mb-4 font-semibold text-l">
                                {{ __('Season Settings') }}
                            </h3>
                            <ul>
                                <li class="pb-1">
                                    <a href="admin/seasons" class="text-blue-500 hover:text-blue-600 text-sm">Manage Seasons</a>
                                </li>
                                <li class="pb-1">
                                    <a href="admin/seasons/create" class="text-blue-500 hover:text-blue-600 text-sm">Create a New Season</a>
                                </li>
                            </ul>
                        </div>

                        <div class="w-1/3 pr-4">
                            <h3 class="pb-2 border-b border-gray-200 mb-4 font-semibold text-l">
                                {{ __('Team Settings') }}
                            </h3>
                            <ul>
                                <li class="pb-1">
                                    <a href="admin/teams" class="text-blue-500 hover:text-blue-600 text-sm">Manage Teams</a>
                                </li>
                                <li class="pb-1">
                                    <a href="admin/teams/create" class="text-blue-500 hover:text-blue-600 text-sm">Create a New Team</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-1/3 pr-4">
                            <h3 class="pb-2 border-b border-gray-200 mb-4 font-semibold text-l">
                                {{ __('Team Settings') }}
                            </h3>
                            <ul>
                                <li class="pb-1">
                                    <a href="admin/teams" class="text-blue-500 hover:text-blue-600 text-sm">Manage Teams</a>
                                </li>
                                <li class="pb-1">
                                    <a href="admin/teams/create" class="text-blue-500 hover:text-blue-600 text-sm">Create a New Team</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
