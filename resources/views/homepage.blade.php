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

            @if(session('show_premium_popup'))
            <div id="premium-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg p-6 max-w-md w-full text-center">
                    <h3 class="text-xl font-semibold mb-4 text-black">Upgrade to Premium</h3>
                    <p class="mb-6 text-black">Access to My Space is restricted to premium users. Would you like to upgrade?</p>
                    <div class="flex justify-center space-x-4">
                        <button id="stay-basic" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded">Stay Basic</button>
                        <button id="go-premium" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded">Go Premium</button>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('stay-basic').addEventListener('click', function() {
                    window.location.href = "{{ url('/') }}";
                });
                document.getElementById('go-premium').addEventListener('click', function() {
                    window.location.href = "http://127.0.0.1:8000/choose_plan";
                });
            </script>
            @endif

            <form method="GET" action="{{ route('home') }}" class="mb-6">
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search games..."
                    class="w-full max-w-md px-4 py-2 rounded-md text-gray-900"
                />
                <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Search
                </button>
            </form>

            <h2 class="text-2xl font-semibold mb-6">Latest Games</h2>
            <div class="flex flex-wrap gap-6 justify-start mb-12"> <!-- Games side by side with wrap -->
                @foreach ($games as $game)
                <div class="game-card flex flex-col items-center">
                    <a href="{{ route('games.show', $game->id) }}">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                        <img src="{{ $game->image_path ? asset('Images/' . $game->image_path) : asset('Images/no-image-available.png') }}" alt="{{ $game->name }}" class="w-48 aspect-[4/3] object-cover rounded-md game-image">
=======
                        <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : ($game->image_path ? asset('Images/' . str_replace(' ', '%20', $game->image_path)) : asset('Images/no-image-available.png')) }}" alt="{{ $game->name }}" class="w-48 aspect-[4/3] object-cover rounded-md game-image">
>>>>>>> Stashed changes
=======
                        <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : ($game->image_path ? asset('Images/' . str_replace(' ', '%20', $game->image_path)) : asset('Images/no-image-available.png')) }}" alt="{{ $game->name }}" class="w-48 aspect-[4/3] object-cover rounded-md game-image">
>>>>>>> Stashed changes
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
                </div>
                @endforeach
            </div>

            <div class="mb-6">
                <a href="{{ route('choose_plan') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-3 px-6 rounded-lg transition-colors duration-300">
                    Go Premium
                </a>
            </div>

            <!-- New News Section -->
            <h2 class="text-2xl font-semibold mb-6">Latest News</h2>
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
        </div>
    </div>

    <style>
        .game-image {
            width: 250px;
            height: 250px;
            transition: transform 0.3s ease;
            margin: 0;
            cursor: pointer;
        }

        .game-image:hover {
            transform: scale(1.1);
        }

        .news-image {
            width: 250px;
            height: 250px;
            transition: transform 0.3s ease;
        }

        .news-image:hover {
            transform: scale(1.1);
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
