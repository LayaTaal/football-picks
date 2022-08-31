<script>

    function ConfirmDelete()
    {
        return  confirm( "Are you sure you want to delete?" );
    }

</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex">
                @if ( $users->isNotEmpty() )
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->email }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/user/{{ $user->id }}" onsubmit="ConfirmDelete()">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" value={{ $user->id }} name="user">
                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No users for now.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
