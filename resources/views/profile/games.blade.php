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
<<<<<<< Updated upstream
<img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . ($game->image_path && $game->image_path !== '' ? str_replace(' ', '%20', $game->image_path) : 'no-image-available.png')) }}" alt="{{ $game->name }}" class="w-20 h-28 object-cover rounded-md">
=======
                                <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . ($game->image_path && $game->image_path !== '' ? str_replace(' ', '%20', $game->image_path) : 'no-image-available.png')) }}" alt="{{ $game->name }}" class="w-20 h-28 object-cover rounded-md">
>>>>>>> Stashed changes
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $game->name }}</h3>
                                    <div class="w-64 bg-gray-200 rounded-full h-4 mt-2">
                                        <div id="progress-bar-{{ $game->id }}" class="bg-blue-600 h-4 rounded-full" style="width: {{ $progressData[$game->id] ?? 0 }}%;"></div>
                                    </div>
                                    <p id="progress-text-{{ $game->id }}" class="text-sm text-gray-600 mt-1">{{ $progressData[$game->id] ?? 0 }}% completed</p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('missions.index', $game->id) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                    Missions
                                </a>
<<<<<<< Updated upstream
=======
                                <form method="POST" action="{{ route('profile.games.share') }}" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                                    <textarea name="content" placeholder="Share your progress..." required class="w-full mt-2 p-2 border rounded-md"></textarea>
                                    <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mt-2">
                                        Share Progress
                                    </button>
                                </form>
>>>>>>> Stashed changes
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        // Function to update progress bar and text for a game
        function updateProgress(gameId, progress) {
            const progressBar = document.getElementById(`progress-bar-${gameId}`);
            const progressText = document.getElementById(`progress-text-${gameId}`);
            if (progressBar && progressText) {
                progressBar.style.width = progress + '%';
                progressText.textContent = progress + '% completed';
            }
        }
    </script>
<<<<<<< Updated upstream
=======

    @if(session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
>>>>>>> Stashed changes
</x-app-layout>
