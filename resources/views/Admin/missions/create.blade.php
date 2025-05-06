<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Mission for {{ $game->name }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.missions.store', $game->id) }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700">Mission Name</label>
                <input type="text" name="name" id="name" required class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" />
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block font-medium text-sm text-gray-700">Mission Type</label>
                <select name="type" id="type" required class="border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Select Type</option>
                    <option value="main">Main</option>
                    <option value="side">Side</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="order" class="block font-medium text-sm text-gray-700">Order</label>
                <input type="number" name="order" id="order" required class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" />
                @error('order')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-300">Add Mission</button>
            <a href="{{ route('admin.missions.index', $game->id) }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
        </form>
    </div>
</x-app-layout>
