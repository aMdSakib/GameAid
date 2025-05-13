<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Experience') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Report Experience by {{ $experience->user->name }} on {{ $experience->game->name }}</h3>
                <p class="mb-4">{{ $experience->content }}</p>

                <form method="POST" action="{{ route('community.report.submit', $experience->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="report_text" class="block font-medium text-sm text-gray-700">Describe your report</label>
                        <textarea name="report_text" id="report_text" rows="5" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm"></textarea>
                        @error('report_text')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Submit Report</button>
                    <a href="{{ route('community.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
