<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-300 text-black px-6 py-4 rounded">
            <div class="flex justify-between items-center w-full">
                <h2 class="font-semibold text-xl leading-tight">
                    {{ __('Welcome to GameAid') }}
                </h2>
                <!-- Removed extra community button as per previous request -->
                <!-- <a href="{{ route('community.index') }}" class="ml-4 bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Community
                </a> -->
                @if (Route::has('login') && !Auth::check())
                    <div class="flex space-x-4">
                        <!-- Removed duplicate Sign In and Register buttons as per request -->
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 text-white min-h-screen"> <!-- Updated here -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


<<<<<<< Updated upstream
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
=======
            <h2 class="text-2xl font-semibold mb-6">Latest Games</h2>
            <div class="flex flex-wrap gap-6 justify-start mb-12"> <!-- Games side by side with wrap -->
                @foreach ($games as $game)
                <div class="game-card flex flex-col items-center">
                    <a href="{{ route('games.show', $game->id) }}">
                        <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : ($game->image_path ? asset('Images/' . str_replace(' ', '%20', $game->image_path)) : asset('Images/no-image-available.png')) }}" alt="{{ $game->name }}" class="w-48 aspect-[4/3] object-cover rounded-md game-image">
                    </a>
                    <h3 class="mt-2 font-bold text-center">
                        <a href="{{ route('games.show', $game->id) }}">{{ $game->name }}</a>
                    </h3>
                    <div class="flex items-center mt-1 space-x-1">
                        @php
                            $avgStars = round($game->user_game_reviews_avg_rating ?? 0);
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $avgStars)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z"/></svg>
                            @else
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z"/></svg>
                            @endif
                        @endfor
                    </div>
>>>>>>> Stashed changes
                </div>
            </div>

            <!-- New News Section -->
            <h2 class="text-2xl font-semibold mb-6">Latest News</h2>
<<<<<<< Updated upstream
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
=======
            <ul class="space-y-4">
                @foreach ($news as $article)
                <li class="flex items-center space-x-4 p-4 bg-gray-800 rounded-md hover:bg-gray-700 transition">
                    <a href="{{ $article->link ?? '#' }}">
                        <img src="{{ asset('Images/' . $article->image_path) }}" alt="{{ $article->title }}" class="w-24 h-24 object-cover rounded-md">
                    </a>
                    <div>
                        <a href="{{ $article->link ?? '#' }}" class="text-lg font-semibold hover:underline" target="_blank" rel="noopener noreferrer">
                            {{ $article->title }}
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
>>>>>>> Stashed changes
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

        ul {
            list-style-type: none;
            padding-left: 0;
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
