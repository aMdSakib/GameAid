<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('community.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="game_id" class="block font-medium text-sm text-gray-700">Select Game</label>
                        <select name="game_id" id="game_id" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Select a Game --</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block font-medium text-sm text-gray-700">Post Type</label>
                        <select name="type" id="type" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            <option value="experience" {{ (isset($type) && $type == 'experience') ? 'selected' : '' }}>Experience</option>
                            <option value="question" {{ (isset($type) && $type == 'question') ? 'selected' : '' }}>Question</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">Content</label>
                        <textarea name="content" id="content" rows="6" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Post</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
