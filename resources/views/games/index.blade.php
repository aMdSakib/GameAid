<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Games') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 text-white min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <ul class="space-y-4">
                @foreach ($games as $game)
                <li class="flex items-center space-x-4 p-4 bg-gray-800 rounded-md hover:bg-gray-700 transition">
                    <a href="{{ route('games.show', $game->id) }}">
                        <img src="{{ $game->image_path ? asset('Images/' . $game->image_path) : asset('Images/no-image-available.png') }}" alt="{{ $game->name }}" class="w-24 h-24 object-cover rounded-md">
                    </a>
                    <div>
                        <a href="{{ route('games.show', $game->id) }}" class="text-lg font-semibold hover:underline">
                            {{ $game->name }}
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <style>
        ul {
            list-style-type: none;
            padding-left: 0;
        }
    </style>
</x-app-layout>
