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
<form method="POST" action="{{ route('add.game') }}" id="addGameForm">
                        @csrf
                        <label for="gameSelect" class="block text-sm font-medium text-gray-700">Select a Game:</label>
                        <select id="gameSelect" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">-- Select a Game --</option>
                            <option value="witcher3">The Witcher 3: Wild Hunt</option>
                            <option value="pokemonza">Pokemon Z-A</option>
                            <option value="gta6">GTA VI</option>
                            <option value="rdr2">Red Dead Redemption 2</option>
                            <option value="ac_black_flag">Assassin's Creed: Black Flag</option>
                            <option value="ghost_of_tsushima">Ghost of Tsushima</option>
                            <option value="zelda_tears_of_kingdom">The Legend of Zelda: Tears of the Kingdom</option>
                        </select>
                        <button type="submit" class="mt-2 bg-purple-500 hover:bg-purple-700 text-black font-bold py-2 px-4 rounded">
                            Add Game
                        </button>
                    </form>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Selected Games:</h3>
                    <table class="min-w-full divide-y divide-gray-200 mt-4 border border-black">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Game Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody id="gameTableBody">
                            <!-- Selected game details will be populated here -->
                        </tbody>
                    </table>
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

        gameSelect.addEventListener('change', function() {
            const selectedGame = this.value;
            if (selectedGame) {
                const gameImage = gameImages[selectedGame]; // Fetch the image from the mapping

                // Create a new row for the selected game
                const gameRow = document.createElement('tr');
                gameRow.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${selectedGame}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <img src="${gameImage}" alt="${selectedGame}" style="width: 300px; height: 400px;"> <!-- Set size to 300x400 -->
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
