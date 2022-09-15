<div>
    <table class="min-w-full divide-y divide-gray-200 block overflow-x-auto md:table">

        @foreach( $table as $row_id => $row_data )
            @if( $row_id === 0 )
                <thead>
                <tr>
                    @foreach( $row_data as $col_id => $col_data )
                        @if( $col_id === 0 )
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $col_data }}
                                    </div>
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
                </thead>
            @else
                <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    @foreach( $row_data as $col_id => $col_data )
                        @if( $col_id === 0 )
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $col_data }}
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $col_data->name }}
                                    </div>
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
                </tbody>
            @endif
        @endforeach

    </table>
</div>
