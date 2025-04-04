<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Welcome to GameAid') }}
                </h2>
                @if (Route::has('login'))
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Register
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold mb-6">Featured Games</h2>
            <div class="flex space-x-6 overflow-x-auto mb-12"> <!-- Increased space between images -->
                <div class="game-card">
                    <a href="{{ route('game.witcher3') }}">
                        <img src="{{ asset('Images/witcher3.jpg') }}" alt="The Witcher 3: Wild Hunt" class="game-image">
                    </a>
                    <h3 class="font-bold">The Witcher 3: Wild Hunt</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.pokemonza') }}">
                        <img src="{{ asset('Images/pokemon_Za.jpg') }}" alt="Pokemon Z-A" class="game-image">
                    </a>
                    <h3 class="font-bold">Pokemon Z-A</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.gta6') }}">
                        <img src="{{ asset('Images/GTA VI.jpg') }}" alt="GTA VI" class="game-image">
                    </a>
                    <h3 class="font-bold">GTA VI</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.rdr2') }}">
                        <img src="{{ asset('Images/rdr2.jpg') }}" alt="Red Dead Redemption 2" class="game-image">
                    </a>
                    <h3 class="font-bold">Red Dead Redemption 2</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.ac_black_flag') }}">
                        <img src="{{ asset('Images/ac_black_flag.jpg') }}" alt="Assassin's Creed: Black Flag" class="game-image">
                    </a>
                    <h3 class="font-bold">Assassin's Creed: Black Flag</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.ghost_of_tsushima') }}">
                        <img src="{{ asset('Images/ghost_of_tsushima.jpg') }}" alt="Ghost of Tsushima" class="game-image">
                    </a>
                    <h3 class="font-bold">Ghost of Tsushima</h3>
                </div>
                <div class="game-card">
                    <a href="{{ route('game.zelda_tears_of_kingdom') }}">
                        <img src="{{ asset('Images/zelda_tears_of_kingdom.jpg') }}" alt="The Legend of Zelda: Tears of the Kingdom" class="game-image">
                    </a>
                    <h3 class="font-bold">The Legend of Zelda: Tears of the Kingdom</h3>
                </div>
            </div>

            <!-- New News Section -->
            <h2 class="text-2xl font-semibold mb-6">Latest News</h2>
            <div class="grid grid-cols-3 gap-8 mt-4"> <!-- Grid layout for news items -->
                <div class="news-card">
                    <a href="#">
                        <img src="{{ asset('Images/news1.jpg') }}" alt="News Title 1" class="news-image">
                    </a>
                    <h3 class="font-bold">News Title 1</h3>
                </div>
                <div class="news-card">
                    <a href="#">
                        <img src="{{ asset('Images/news2.jpg') }}" alt="News Title 2" class="news-image">
                    </a>
                    <h3 class="font-bold">News Title 2</h3>
                </div>
                <div class="news-card">
                    <a href="#">
                        <img src="{{ asset('Images/news3.jpg') }}" alt="News Title 3" class="news-image">
                    </a>
                    <h3 class="font-bold">News Title 3</h3>
                </div>
                <!-- Add more news items as needed -->
            </div>
        </div>
    </div>

    <style>
        .game-image {
            width: 250px; /* Increased width */
            height: 250px; /* Increased height */
            transition: transform 0.3s ease;
            margin: 15px; /* Increased margin for more spacing */
        }

        .game-image:hover {
            transform: scale(1.1); /* Enlarge image on hover */
        }

        .news-image {
            width: 250px; /* Set width for news images */
            height: 250px; /* Set height for news images */
            transition: transform 0.3s ease;
        }

        .news-image:hover {
            transform: scale(1.1); /* Enlarge image on hover */
        }
    </style>
</x-app-layout>