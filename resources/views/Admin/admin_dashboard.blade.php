<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-300">
                Home
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Display success and error messages -->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add New Game Form -->
            <div class="bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Add New Game</h3>
                <form method="POST" action="{{ route('admin.add.game') }}" onsubmit="return confirmAddGame()" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-300">Game Name</label>
                    <input type="text" name="name" id="name" required class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white" />
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block font-medium text-sm text-gray-300">Upload Image (Optional)</label>
                        <input type="file" name="image" id="image" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white" />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="characters" class="block font-medium text-sm text-gray-300">Characters</label>
                        <textarea name="characters" id="characters" rows="3" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="game_details" class="block font-medium text-sm text-gray-300">Game Details</label>
                        <textarea name="game_details" id="game_details" rows="3" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white"></textarea>
                    </div>
                    <div class="mb-4">
                        
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors duration-300">Add Game</button>
                </form>
            </div>

            <!-- Unapproved Experiences Notification and List -->
            @if($unapprovedExperiences->count() > 0)
            <div class="bg-red-600 shadow rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Pending Posts ({{ $unapprovedExperiences->count() }})</h3>
                <table class="min-w-full divide-y divide-gray-700 text-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Game</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Content</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unapprovedExperiences as $experience)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $experience->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $experience->game->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($experience->content, 100) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <form method="POST" action="{{ route('admin.approve.experience', $experience->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reject.experience', $experience->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Reject</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            @if($unapprovedAnswers->count() > 0)
            <div class="bg-red-600 shadow rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Pending Answers ({{ $unapprovedAnswers->count() }})</h3>
                <table class="min-w-full divide-y divide-gray-700 text-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Content</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unapprovedAnswers as $answer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $answer->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($answer->content, 100) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <form method="POST" action="{{ route('admin.approve.answer', $answer->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reject.answer', $answer->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Reject</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <!-- Existing Games List with Edit and Delete -->
            <div class="bg-gray-900 shadow rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-semibold mb-4 text-white">Existing Games</h3>
                @foreach ($games as $game)
                <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between text-white">
                    <div class="flex items-center space-x-6">
                        <div>
                            <img src="{{ $game->image_path && preg_match('/^https?:\/\//', $game->image_path) ? $game->image_path : asset('Images/' . str_replace(' ', '%20', $game->image_path)) }}" alt="{{ $game->name }}" class="w-24 h-24 object-cover rounded-md">
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold">{{ $game->name }}</h4>
                            <p class="text-sm text-gray-300">{{ Str::limit($game->description, 100) }}</p>
                        </div>
                    </div>
                    <div class="space-x-4">
                        <a href="{{ route('admin.edit.game', $game->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Edit</a>
                        <form method="POST" action="{{ route('admin.delete.game', $game->id) }}" onsubmit="return confirm('Are you sure you want to delete this game?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Mission Control Section -->
            <div class="bg-gray-900 shadow rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold mb-4 text-white">Mission Control</h3>
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Game</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @foreach ($games as $game)
                        <tr class="text-white">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $game->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.missions.index', $game->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-300">Mission Control</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add News Article Form -->
            <div class="bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Add News Article</h3>
                <form method="POST" action="{{ route('admin.add.news') }}" onsubmit="return confirmAddNews()" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block font-medium text-sm text-gray-300">Title</label>
                        <input type="text" name="title" id="title" required class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white" />
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block font-medium text-sm text-gray-300">Upload Image (Optional)</label>
                        <input type="file" name="image" id="image" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white" />
                    </div>
                    <div class="mb-4">
                        <label for="link" class="block font-medium text-sm text-gray-300">Link (optional)</label>
                        <input type="text" name="link" id="link" class="border-gray-700 rounded-md shadow-sm mt-1 block w-full bg-gray-800 text-white" />
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors duration-300">Add News Article</button>
                </form>
            </div>

            <!-- Existing News Articles List -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Existing News Articles</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Path</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($news as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->image_path }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ route('admin.delete.news', $article->id) }}" onsubmit="return confirm('Are you sure you want to delete this news article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Reports Section -->
            <div class="bg-red-700 shadow rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Reported Posts</h3>
                @if($reports->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 text-white">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Game</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Content</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Report</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $report->experience->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $report->experience->game->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($report->experience->content, 100) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($report->report_text, 100) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <form method="POST" action="{{ route('admin.reported_post.delete', $report->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this reported post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete Post</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-white">No reported posts.</p>
                @endif
            </div>
        </div>

<script>
    function confirmAddGame() {
        const name = document.getElementById('name').value.trim();
        if (!name) {
            alert('Please fill in the game name.');
            return false;
        }
        return confirm('Are you sure you want to add this game?');
    }

    function confirmAddNews() {
        const title = document.getElementById('title').value.trim();
        if (!title) {
            alert('Please fill in the news article title.');
            return false;
        }
        return confirm('Are you sure you want to add this news article?');
    }
</script>
</x-app-layout>
