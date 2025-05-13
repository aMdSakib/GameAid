<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Game') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition-colors duration-300">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Update Game Details</h3>
                <form method="POST" action="{{ route('admin.update.game_details', $game->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-300">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required class="w-full bg-gray-800 text-white rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full bg-gray-800 text-white rounded px-3 py-2">{{ old('description', $game->description) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="characters" class="block font-medium text-sm text-gray-300">Characters</label>
                        <textarea name="characters" id="characters" rows="4" class="w-full bg-gray-800 text-white rounded px-3 py-2">{{ old('characters', $game->characters) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="game_details" class="block font-medium text-sm text-gray-300">Game Details</label>
                        <textarea name="game_details" id="game_details" rows="4" class="w-full bg-gray-800 text-white rounded px-3 py-2">{{ old('game_details', $game->game_details) }}</textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update Details</button>
                </form>
            </div>

            <div class="bg-gray-900 shadow rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold mb-4 text-white">Update Game Image</h3>
                <div class="mb-4">
                    <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . str_replace(' ', '%20', $game->image_path)) }}" alt="{{ $game->name }}" class="w-48 h-48 object-cover rounded-md mb-4">
                </div>
                <form method="POST" action="{{ route('admin.update.game_image', $game->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 cursor-pointer focus:outline-none" />
                    </div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update Image</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
