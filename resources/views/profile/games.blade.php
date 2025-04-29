<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Games') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($games->isEmpty())
            <p class="text-gray-600">You are not playing any games currently.</p>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <ul>
                    @foreach($games as $game)
                        <li class="border-b border-gray-200 p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('Images/' . ($game->image_path ?? 'no-image-available.png')) }}" alt="{{ $game->name }}" class="w-20 h-28 object-cover rounded-md">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $game->name }}</h3>
                                    <div class="w-64 bg-gray-200 rounded-full h-4 mt-2">
                                        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $game->progress ?? 0 }}%;"></div>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">{{ $game->progress ?? 0 }}% completed</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
