<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-black-800 leading-tight">
                {{ __('Welcome, ' . Auth::user()->name) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 text-green-600 rounded">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="mb-4 p-4 bg-red-600 text-white rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a href="{{ route('profile.games') }}" class="inline-block mb-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        View My Games
                    </a>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('add.game') }}" id="addGameForm">
                        @csrf
                        <label for="gameSelect" class="block text-sm font-medium text-gray-700">Select a Game:</label>
                        <select id="gameSelect" name="game_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">-- Select a Game --</option>
                            @foreach($allGames as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="imagePath" name="image_path" value="">
                        <button type="submit" class="mt-2 bg-purple-500 hover:bg-purple-700 text-black font-bold py-2 px-4 rounded">
                            Add Game
                        </button>
                    </form>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Selected Games:</h3>
                    @if($games->isEmpty())
                        <p class="text-gray-400">No games added yet.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 mt-4 border border-black">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Game Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($games as $game)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $game->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                                            <img src="{{ $game->image_path }}" alt="{{ $game->name }}" style="width: 300px; height: 400px;">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            <!-- Action buttons can be added here -->
=======
<img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . str_replace(' ', '%20', $game->image_path)) }}" alt="{{ $game->name }}" style="width: 300px; height: 400px;">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
=======
<img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . str_replace(' ', '%20', $game->image_path)) }}" alt="{{ $game->name }}" style="width: 300px; height: 400px;">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
>>>>>>> Stashed changes
                                            <form method="POST" action="{{ route('my_space.review_game', $game->id) }}">
                                                @csrf
                                                <select name="rating" class="bg-gray-700 text-white rounded px-2 py-1">
                                                    <option value="">Rate</option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}" {{ isset($userReviews[$game->id]) && $userReviews[$game->id]->rating == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                                    @endfor
                                                </select>
                                                <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Submit</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            <form method="POST" action="{{ route('my_space.delete_game', $game->id) }}" onsubmit="return confirm('Are you sure you want to delete this game?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Delete</button>
                                            </form>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!-- New section for user's community posts -->
                <div class="p-6 bg-gray-800 mt-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-white mb-4">My Community Posts</h3>

                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-white mb-2">My Posts</h4>
                        @if(isset($myPosts) && $myPosts->isNotEmpty())
                            @foreach($myPosts as $post)
                                <div class="mb-4 p-4 bg-gray-700 rounded">
                                    <p class="text-white"><strong>Game:</strong> {{ $post->game->name }}</p>
                                    <p class="text-white mt-1">{{ $post->content }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $post->created_at->diffForHumans() }}</p>
                                    <p class="text-white mt-1">Likes: {{ $post->likes }} | Dislikes: {{ $post->dislikes }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-400">You have not posted any experiences yet.</p>
                        @endif
                    </div>

                    <div>
                        <h4 class="text-md font-semibold text-white mb-2">My Questions</h4>
                        @if(isset($myQuestions) && $myQuestions->isNotEmpty())
                            @foreach($myQuestions as $post)
                                <div class="mb-4 p-4 bg-gray-700 rounded">
                                    <p class="text-white"><strong>Game:</strong> {{ $post->game->name }}</p>
                                    <p class="text-white mt-1">{{ $post->content }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $post->created_at->diffForHumans() }}</p>
                                    <p class="text-white mt-1">Likes: {{ $post->likes }} | Dislikes: {{ $post->dislikes }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-400">You have not asked any questions yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const gameSelect = document.getElementById('gameSelect');
        const gameTableBody = document.getElementById('gameTableBody');

        // Mapping of game identifiers to image paths
        const gameImages = {
            witcher3: '{{ asset('Images/witcher3.jpg') }}',
            pokemonza: '{{ asset('Images/pokemon_Za.jpg') }}',
            gta6: '{{ asset('Images/GTA VI.jpg') }}',
            rdr2: '{{ asset('Images/rdr2.jpg') }}',
            ac_black_flag: '{{ asset('Images/ac_black_flag.jpg') }}',
            ghost_of_tsushima: '{{ asset('Images/ghost_of_tsushima.jpg') }}',
            zelda_tears_of_kingdom: '{{ asset('Images/zelda_tears_of_kingdom.jpg') }}'
        };

        // Mapping of game identifiers to proper game names
        const gameNames = {
            witcher3: 'The Witcher 3: Wild Hunt',
            pokemonza: 'Pokemon Z-A',
            gta6: 'GTA VI',
            rdr2: 'Red Dead Redemption 2',
            ac_black_flag: "Assassin's Creed: Black Flag",
            ghost_of_tsushima: 'Ghost of Tsushima',
            zelda_tears_of_kingdom: 'The Legend of Zelda: Tears of the Kingdom'
        };

        gameSelect.addEventListener('change', function() {
            const selectedGame = this.value;
            if (selectedGame) {
                const gameImage = gameImages[selectedGame]; // Fetch the image from the mapping
                const gameName = gameNames[selectedGame]; // Fetch the proper game name

                // Update hidden input with image path
                document.getElementById('imagePath').value = gameImage;

                // Create a new row for the selected game
                const gameRow = document.createElement('tr');
                gameRow.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${gameName}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <img src="${gameImage}" alt="${gameName}" style="width: 300px; height: 400px;"> <!-- Set size to 300x400 -->
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <button class="delete-button text-red-500 hover:text-red-700">Delete</button>
                    </td>
                `;
                gameTableBody.appendChild(gameRow);

                // Disable the selected option in the dropdown
                this.querySelector(`option[value="${selectedGame}"]`).disabled = true;

                // Clear the selection
                this.value = '';

                // Add delete functionality
                const deleteButton = gameRow.querySelector('.delete-button');
                deleteButton.addEventListener('click', function() {
                    gameTableBody.removeChild(gameRow);
                    // Re-enable the option in the dropdown
                    gameSelect.querySelector(`option[value="${selectedGame}"]`).disabled = false;
                });
            }
        });
    </script>
    
</x-app-layout>
