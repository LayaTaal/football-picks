<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
    @foreach( $users as $user )
        <div class="flex flex-col odd:bg-gray-100">
            <h3 class="text-lg font-semibold bg-gray-300 px-4 py-1">
                @if( $user->id === request()->user()->id )
                    {{ __( 'My Picks') }}
                @else
                    {{ $user->name }}
                @endif
            </h3>
            <ul class="">
                <?php $correct_picks = 0; ?>
                @foreach( $user->picks_this_week as $pick )
                    <?php $correct_picks = $pick->game()->winning_team() === $pick->team()->id ? $correct_picks + 1 : $correct_picks; ?>
                    @if( $pick->game()->is_over() )
                        <li class="mx-4 my-1">{{ $pick->team()->name }}</li>
                    @endif
                @endforeach
                <li class="font-semibold bg-gray-300 px-4 py-1">{{ $correct_picks }} correct</li>
            </ul>
        </div>
    @endforeach
</div>
