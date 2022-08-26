<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->name }}
        </h1>
    </x-slot>

    <x-section title="Update Profile">
        <div class="w-full md:w-1/3">
            <form method="POST" action="/profile" enctype="multipart/form-data">
                @csrf
                @method( 'PATCH' )

                <div class="mb-6">
                    <x-label for="name" class="block">Display Name</x-label>

                    <x-input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old( 'name', auth()->user()->name ) }}"
                    />

                    @error( 'name' )
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <x-label for="name" class="block">Email</x-label>

                    <x-input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old( 'email', auth()->user()->email ) }}"
                    />

                    @error( 'email' )
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <x-label for="password" class="block">Password</x-label>

                    <x-input
                        type="password"
                        name="password"
                        id="password"
                        value="{{ old( 'password', auth()->user()->password ) }}"
                    />

                    @error( 'password' )
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <x-button type="submit">Update Profile</x-button>
                </div>
            </form>
        </div>
    </x-section>

</x-app-layout>
