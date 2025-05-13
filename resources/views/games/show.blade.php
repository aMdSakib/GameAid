<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $game->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 text-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <img src="{{ $game->image_path ? asset('Images/' . $game->image_path) : asset('Images/no-image-available.png') }}" alt="{{ $game->name }}" class="w-96 h-96 object-cover rounded-md mb-4" />
                <h3 class="text-3xl font-bold mb-4">{{ $game->name }}</h3>
                <p class="text-lg whitespace-pre-line">
                    {{ $game->description ?? 'No description available.' }}
                </p>

                <h3 class="text-2xl font-semibold mt-6 mb-2">Characters</h3>
                <p class="text-lg whitespace-pre-line">
                    {{ $game->characters ?? 'No character information available.' }}
                </p>

                <h3 class="text-2xl font-semibold mt-6 mb-2">Game Details</h3>
                <p class="text-lg whitespace-pre-line">
                    {{ $game->game_details ?? 'No additional game details available.' }}
                </p>

                <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
