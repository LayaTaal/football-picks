<div>
    <table class="min-w-full divide-y divide-gray-200 block overflow-x-auto md:table">

        <thead>
            <tr>
                @foreach( $header as $id => $col )
                    @if( $id === 0 )
                        <td class="px-6 py-4 whitespace-nowrap"></td>
                    @else
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $col }}
                                </div>
                            </div>
                        </td>
                    @endif
                @endforeach
            </tr>
        </thead>

        @foreach( $stats as $row_id => $stats_row )
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    @foreach( $stats_row as $stat )
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $stat }}
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        @endforeach

        <tfoot>
            <tr>
                @foreach( $footer as $id => $col )
                        <td class="px-6 py-4 whitespace-nowrap bg-gray-100">
                            <div class="flex items-center">
                                <div class="text-sm font-bold {{ $id === 0 ? '' : 'text-green-600' }}">
                                    {{ $col }}
                                </div>
                            </div>
                        </td>
                @endforeach
            </tr>
        </tfoot>

    </table>
</div>
