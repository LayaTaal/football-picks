<div>
    <table class="min-w-full divide-y divide-gray-200 block overflow-x-auto md:table">

                @foreach( $stats as $row_id => $stats_row )
                    @if( $row_id === 0 )
                        <thead>
                            <tr>
                                @foreach( $stats_row as $stat_id => $stat )
                                    @if( $stat_id === 0 )
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-bold text-gray-900">
                                                    {{ $stat }}
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
                    @endif
                @endforeach

    </table>
</div>
