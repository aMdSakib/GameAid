<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Display success and error messages -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
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
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors duration-300">Add Game</button>
                </form>
            </div>

            <!-- Existing Games List with Delete -->
            <div class="bg-gray-900 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-white">Existing Games</h3>
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Image Path</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @foreach ($games as $game)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ $game->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ $game->image_path }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ route('admin.delete.game', $game->id) }}" onsubmit="return confirm('Are you sure you want to delete this game?');">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($news as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->image_path }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->link }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

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
