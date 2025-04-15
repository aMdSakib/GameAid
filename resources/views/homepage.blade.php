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

            <h2 class="text-2xl font-semibold mb-6">Featured Games</h2>
            <div class="flex flex-wrap gap-6 justify-start mb-12"> <!-- Games side by side with wrap -->
                @foreach ($games as $game)
                <div class="game-card flex flex-col items-center">
                    <a href="#">
                        <img src="{{ $game->image_path ? asset($game->image_path) : asset('Images/no-image-available.png') }}" alt="{{ $game->name }}" class="game-image">
                    </a>
                    <h3 class="mt-2 font-bold text-center">{{ $game->name }}</h3>
                </div>
                @endforeach
            </div>

            <!-- New News Section -->
            <h2 class="text-2xl font-semibold mb-6">Latest News</h2>
            <div class="grid grid-cols-3 gap-8 mt-4"> <!-- Grid layout for news items -->
                @foreach ($news as $article)
                <div class="news-card">
                    <a href="{{ $article->link ?? '#' }}">
                        <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="news-image" style="width: 330px;">
                    </a>
                    <h3 class="font-bold">{{ $article->title }}</h3>
                </div>
                @endforeach
            </div>
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