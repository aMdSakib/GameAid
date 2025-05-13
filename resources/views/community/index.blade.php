<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Community Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Share Your Experience</h3>
                @php
                    $user = auth()->user();
                @endphp
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
                    <input type="hidden" name="type" value="experience">
                    <div class="mb-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">Your Experience</label>
                        <textarea name="content" id="content" rows="4" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Post Experience</button>
                </form>
            </div>

            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4">Ask a Question</h3>
                <form method="POST" action="{{ route('community.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="game_id_question" class="block font-medium text-sm text-gray-700">Select Game</label>
                        <select name="game_id" id="game_id_question" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Select a Game --</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="type" value="question">
                    <div class="mb-4">
                        <label for="content_question" class="block font-medium text-sm text-gray-700">Your Question</label>
                        <textarea name="content" id="content_question" rows="4" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Post Question</button>
                </form>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Experiences</h3>
<<<<<<< Updated upstream
                @forelse($experiences as $post)
                    <div class="border-b border-gray-200 py-4">
                        <p><strong>{{ $post->user->name }}</strong> on <em>{{ $post->game->name }}</em> shared an experience:</p>
                        <p class="mt-2">{{ $post->content }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                        <p>Likes: <span id="post-likes-{{ $post->id }}">{{ $post->likes }}</span> | Dislikes: <span id="post-dislikes-{{ $post->id }}">{{ $post->dislikes }}</span></p>
                        <button onclick="likePost({{ $post->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
                        <button onclick="dislikePost({{ $post->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Dislike</button>

=======
@forelse($experiences as $post)
    @if(!str_starts_with($post->content, 'My progress for'))
        <div class="border-b border-gray-200 py-4">
            <p><strong>{{ $post->user->name }}</strong> on <em>{{ $post->game->name }}</em> shared an experience:</p>
            <p class="mt-2">{{ $post->content }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
            <p>Likes: <span id="post-likes-{{ $post->id }}">{{ $post->likes }}</span> | Dislikes: <span id="post-dislikes-{{ $post->id }}">{{ $post->dislikes }}</span></p>
            <button onclick="likePost({{ $post->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
            <button onclick="dislikePost({{ $post->id }})" class="bg-red-500 text-white px-2 py-1 rounded mr-2">Dislike</button>
            <a href="{{ route('community.report.form', $post->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Report</a>
        </div>
    @endif
@empty
                    <p>No experiences yet.</p>
                @endforelse
            </div>

            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4">Progression</h3>
                @forelse($progresses as $post)
                    <div class="border-b border-gray-200 py-4 flex items-center space-x-4">
                        <img src="{{ $post->game->image_path && preg_match('/^https?:\/\//', $post->game->image_path) ? $post->game->image_path : asset('Images/' . ($post->game->image_path && $post->game->image_path !== '' ? str_replace(' ', '%20', $post->game->image_path) : 'no-image-available.png')) }}" alt="{{ $post->game->name }}" class="w-20 h-28 object-cover rounded-md">
                        <div>
                            <p><strong>{{ $post->user->name }}</strong> shared progress for <em>{{ $post->game->name }}</em>:</p>
                            <p class="mt-2">{{ $post->content }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                            <p>Mission Completion: <strong>{{ $progressCompletionMap[$post->id] ?? 0 }}%</strong></p>
                            <p>Likes: <span id="post-likes-{{ $post->id }}">{{ $post->likes }}</span> | Dislikes: <span id="post-dislikes-{{ $post->id }}">{{ $post->dislikes }}</span></p>
                            <button onclick="likePost({{ $post->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
                            <button onclick="dislikePost({{ $post->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Dislike</button>
                        </div>
>>>>>>> Stashed changes
                        <!-- Answers -->
                        <div class="mt-4 ml-4 border-l-2 border-gray-300 pl-4">
                            <h4 class="font-semibold mb-2">Replies:</h4>
                            @foreach($post->answers as $answer)
                                <div class="mb-2">
                                    <p><strong>{{ $answer->user->name }}</strong> replied:</p>
                                    <p>{{ $answer->content }}</p>
                                    <p>Likes: <span id="answer-likes-{{ $answer->id }}">{{ $answer->likes }}</span> | Dislikes: <span id="answer-dislikes-{{ $answer->id }}">{{ $answer->dislikes }}</span></p>
                                    <button onclick="likeAnswer({{ $answer->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
                                    <button onclick="dislikeAnswer({{ $answer->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Dislike</button>
                                </div>
                            @endforeach
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
                            <!-- Reply form -->
                            <form method="POST" action="{{ route('community.answer.store', $post->id) }}">
                                @csrf
                                <textarea name="content" rows="2" required class="w-full rounded border-gray-300"></textarea>
                                <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded">Reply</button>
                            </form>
                        </div>
                    </div>
                @empty
<<<<<<< Updated upstream
                    <p>No experiences yet.</p>
                @endforelse
=======
                    <p>No progression posts yet.</p>
                @endforelse

>>>>>>> Stashed changes
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Questions</h3>
                @forelse($questions as $post)
                    <div class="border-b border-gray-200 py-4">
                        <p><strong>{{ $post->user->name }}</strong> on <em>{{ $post->game->name }}</em> asked a question:</p>
                        <p class="mt-2">{{ $post->content }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                        <p>Likes: <span id="post-likes-{{ $post->id }}">{{ $post->likes }}</span> | Dislikes: <span id="post-dislikes-{{ $post->id }}">{{ $post->dislikes }}</span></p>
                        <button onclick="likePost({{ $post->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
                        <button onclick="dislikePost({{ $post->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Dislike</button>

                        <!-- Answers -->
                        <div class="mt-4 ml-4 border-l-2 border-gray-300 pl-4">
                            <h4 class="font-semibold mb-2">Verified Answer <span class="text-green-500">&#10003;</span></h4>
                            @foreach($post->answers->where('approved', true) as $answer)
                                <div class="mb-2">
                                    <p><strong>{{ $answer->user->name }}</strong> replied:</p>
                                    <p>{{ $answer->content }}</p>
                                    <p>Likes: <span id="answer-likes-{{ $answer->id }}">{{ $answer->likes }}</span> | Dislikes: <span id="answer-dislikes-{{ $answer->id }}">{{ $answer->dislikes }}</span></p>
                                    <button onclick="likeAnswer({{ $answer->id }})" class="bg-green-500 text-white px-2 py-1 rounded mr-2">Like</button>
                                    <button onclick="dislikeAnswer({{ $answer->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Dislike</button>
                                </div>
                            @endforeach

                            <!-- Reply form -->
                            <form method="POST" action="{{ route('community.answer.store', $post->id) }}">
                                @csrf
                                <textarea name="content" rows="2" required class="w-full rounded border-gray-300"></textarea>
                                <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded">Reply</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No questions yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        async function likePost(postId) {
            const response = await fetch(`/community/like-post/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                document.getElementById(`post-likes-${postId}`).textContent = data.likes;
                document.getElementById(`post-dislikes-${postId}`).textContent = data.dislikes;
            }
        }

        async function dislikePost(postId) {
            const response = await fetch(`/community/dislike-post/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                document.getElementById(`post-likes-${postId}`).textContent = data.likes;
                document.getElementById(`post-dislikes-${postId}`).textContent = data.dislikes;
            }
        }

        async function likeAnswer(answerId) {
            const response = await fetch(`/community/like-answer/${answerId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                document.getElementById(`answer-likes-${answerId}`).textContent = data.likes;
                document.getElementById(`answer-dislikes-${answerId}`).textContent = data.dislikes;
            }
        }

        async function dislikeAnswer(answerId) {
            const response = await fetch(`/community/dislike-answer/${answerId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                document.getElementById(`answer-likes-${answerId}`).textContent = data.likes;
                document.getElementById(`answer-dislikes-${answerId}`).textContent = data.dislikes;
            }
        }
    </script>
</x-app-layout>
