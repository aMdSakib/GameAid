<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Missions for {{ $game->name }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.missions.create', $game->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-300 mb-4 inline-block">Add New Mission</a>

        @if($missions->isEmpty())
            <p class="text-gray-600">No missions available for this game.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-lg">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($missions as $mission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $mission->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($mission->type) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $mission->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.missions.edit', [$game->id, $mission->id]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form method="POST" action="{{ route('admin.missions.destroy', [$game->id, $mission->id]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this mission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
