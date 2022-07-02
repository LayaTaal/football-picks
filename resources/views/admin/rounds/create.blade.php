<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Round') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                <div class="w-full md:w-1/3">
                    <form method="POST" action="/admin/rounds" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label for="title">Round Name</label>

                            <input
                                type="text"
                                class="border border-gray-200 p-2 w-full rounded"
                                name="title"
                                id="title"
                                required
                            >

                            @error( 'title' )
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6 flex gap-6">

                            <div class="w-1/2">
                                <label for="start_date" class="block">Start Date:</label>

                                <input
                                    type="date"
                                    class="w-full border-gray-200 rounded"
                                    name="start_date"
                                    id="start_date"
                                    required
                                >

                                @error( 'start_date' )
                                <p>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-1/2">
                                <label for="end_date" class="block">End Date:</label>

                                <input
                                    type="date"
                                    class="w-full border-gray-200 rounded"
                                    name="end_date"
                                    id="end_date"
                                    required
                                >

                                @error( 'end_date' )
                                <p>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="text-white bg-blue-500 uppercase font-semibold px-10 py-2 rounded-2xl hover:bg-blue-600 text-xs">
                                Create Round
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
