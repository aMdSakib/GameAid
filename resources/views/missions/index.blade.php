<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Missions for {{ $game->name }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($mainMissions->isEmpty() && $sideMissions->isEmpty())
            <p class="text-gray-600">No missions available for this game.</p>
        @else
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Overall Completion</h3>
                <div class="w-full bg-gray-200 rounded-full h-6">
                    <div id="completion-bar" class="bg-blue-600 h-6 rounded-full" style="width: {{ $completionPercentage }}%;"></div>
                </div>
                <p id="completion-text" class="text-sm text-gray-600 mt-1">{{ $completionPercentage }}% completed</p>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 p-6">
                <h3 class="text-xl font-semibold mb-4">Main Missions</h3>
                @if($mainMissions->isEmpty())
                    <p class="text-gray-600">No main missions available.</p>
                @else
                    <ul>
                        @foreach($mainMissions as $mission)
            <li class="border-b border-gray-200 p-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">{{ $mission->name }}</h3>
                </div>
                <div>
                    <input type="checkbox" class="toggle-completion-checkbox" data-mission-id="{{ $mission->id }}" {{ isset($progress[$mission->id]) && $progress[$mission->id] ? 'checked' : '' }}>
                </div>
            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Side Missions</h3>
                @if($sideMissions->isEmpty())
                    <p class="text-gray-600">No side missions available.</p>
                @else
                    <ul>
                        @foreach($sideMissions as $mission)
                            <li class="border-b border-gray-200 p-4 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $mission->name }}</h3>
                                </div>
                                <div>
                                    <input type="checkbox" class="toggle-completion-checkbox" data-mission-id="{{ $mission->id }}" {{ isset($progress[$mission->id]) && $progress[$mission->id] ? 'checked' : '' }}>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.toggle-completion-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const missionId = checkbox.getAttribute('data-mission-id');
                const completed = checkbox.checked;
                fetch(`/missions/${missionId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ completed: completed })
                })
                .then(response => response.json())
                .then(data => {
                    // Update progress bar dynamically
                    fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newCompletionBar = doc.getElementById('completion-bar');
                            const newCompletionText = doc.getElementById('completion-text');
                            if (newCompletionBar && newCompletionText) {
                                document.getElementById('completion-bar').style.width = newCompletionBar.style.width;
                                document.getElementById('completion-text').textContent = newCompletionText.textContent;
                            }
                        });
                })
                .catch(error => {
                    console.error('Error toggling mission completion:', error);
                    // Revert checkbox state on error
                    checkbox.checked = !completed;
                });
            });
        });
    </script>
</x-app-layout>
