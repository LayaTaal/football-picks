<div class="flex justify-items-stretch w-full gap-6">
    @foreach( $users as $user )
        <div class="flex flex-col w-1/6 odd:bg-gray-100">
            <h3 class="text-lg font-semibold bg-gray-300 px-4 py-1">
                @if( $user->id === request()->user()->id )
                    {{ __( 'My Picks') }}
                @else
                    {{ $user->name }}
                @endif
            </h3>
            <ul class="">
                @foreach( $user->picks_this_week as $pick )
                    @if( $pick->game()->is_over() )
                        <li class="mx-4 my-1">{{ $pick->team()->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
