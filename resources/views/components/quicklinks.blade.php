<div {{ $attributes->merge([ 'class' => 'flex justify-end mb-6' ]) }}>
    @if( $slot->isNotEmpty() )
        {{ $slot }}
    @else
        <a href="/admin/seasons">Back to All Seasons</a>
    @endif
</div>
