<div>
    <table class="min-w-full divide-y divide-gray-200 block overflow-x-auto md:table">

        @foreach( $table as $row_id => $row_data )
            @if( $row_id === 0 )
                <thead>
                <tr>
                    @foreach( $row_data as $col_id => $user )
                        @if( $col_id === 0 )
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $user->name }}</p>
                                        @if ( $user->survivor_status() > 0 )
                                            <p class="text-sm font-bold text-gray-900">Still Alive ({{ $user->survivor_status() }} left)</p>
                                        @else
                                            <p class="text-sm text-gray-900">Eliminated</p>
                                        @endif
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
                                    @if ( $col_data )
                                        <div class="text-sm font-bold {{ $col_data['team_won'] ? 'text-green-500' : 'text-red-500 line-through' }}">
                                            {{ $col_data['team']->name }}
                                        </div>
                                    @else
                                        <div class="text-sm font-bold text-gray-900 line-through">
                                            N/A
                                        </div>
                                    @endif
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
