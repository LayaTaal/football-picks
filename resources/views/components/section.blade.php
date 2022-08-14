<div {{ $attributes->class(['pt-12 pb-6']) }}>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
            <h2 class="text-2xl mb-6">{{ $title }}</h2>
            {{ $slot }}
        </div>
    </div>
</div>
