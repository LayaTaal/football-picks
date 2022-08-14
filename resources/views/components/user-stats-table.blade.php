<ul>
    @foreach( $users as $user )
        <x-simple-user-stats :user="$user" />
    @endforeach
</ul>
