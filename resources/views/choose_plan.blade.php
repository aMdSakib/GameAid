<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose Your Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('choose_plan.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Select Plan:</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="plan" value="basic" class="form-radio" checked>
                            <span class="ml-2">Basic (Free)</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="plan" value="premium" class="form-radio">
                            <span class="ml-2">Premium ($9.99)</span>
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Choose Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
