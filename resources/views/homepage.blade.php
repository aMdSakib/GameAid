<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-300 text-white px-6 py-4 rounded">
            <div class="flex justify-between items-center w-full">
                <h2 class="font-semibold text-xl leading-tight">
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

    <div class="py-12 bg-gray-900 text-white min-h-screen"> <!-- Updated here -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


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
                        <img src="{{ asset('Images/switch2.jpg') }}" alt="News Title 1" class="news-image" style="width: 330px;">
                    </a>
                    <h3 class="font-bold">Switch 2 Hands-On: More Of The Same, But It Can Still Surprise You</h3>
                </div>
                <div class="news-card">
                    <a href="#">
                        <img src="{{ asset('Images/lastofus.webp') }}" alt="News Title 2" class="news-image" style="width: 330px;">
                    </a>
                    <h3 class="font-bold text-black text-3xl">The Last of Us Part II Remastered Officially comes to PC</h3>
                    </div>
                <div class="news-card">
                    <a href="#">
                        <img src="{{ asset('Images/marvel.avif') }}" alt="News Title 3" class="news-image" style= "width: 330px;">
                    </a>
                    <h3 class="font-bold">Marvel Rivals to Release Characters Faster</h3>
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

<footer class="global-footer bg-gray-800 text-white py-6">
    <div class="global-footer__content max-w-6xl mx-auto">
        <div>
            <h2 class="global-footer__header text-lg font-bold">About Us</h2>
            <p class="mb-4">
                GameAid is your trusted companion in the world of gaming. Whether you're a casual player or a competitive gamer, we provide tools, guides, and support to enhance your gaming experience. From game strategy tips and performance boosters to community support and mental wellness resources, GameAid is built to help gamers play smarter and feel better.
            </p>
            <h3 class="global-footer__section-header">Our Mission</h3>
            <p class="mb-4">
                To empower gamers by offering accessible, helpful, and reliable tools that improve gameplay, promote healthy gaming habits, and build a stronger gaming community.
            </p>
            <h3 class="global-footer__section-header">Why GameAid?</h3>
            <ul class="global-footer__links mb-4">
                <li>Expert-curated gaming guides</li>
                <li>In-game performance tools</li>
                <li>Gamer wellness and support</li>
                <li>Active community forums and updates</li>
            </ul>
            <p>Join us and level up your game — the GameAid way.</p>
        </div>
        <div>
            <h3 class="global-footer__section-header">Follow Us</h3>
            <ul class="global-footer__links flex space-x-4">
                <li>
                    <a href="https://www.facebook.com/getfandom" class="global-footer__link">
                        <img src="{{ asset('Images/facebook.png') }}" alt="Facebook" class="w-6 h-6">
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/getfandom" class="global-footer__link">
                        <img src="{{ asset('Images/X.png') }}" alt="Twitter" class="w-6 h-6">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="global-footer__bottom text-center mt-4">
        <div>Copyright 2025 GameAid.</div>
    </div>
</footer>
</x-app-layout>