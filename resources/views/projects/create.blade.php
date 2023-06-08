<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Project') }}
            <a href="{{ url('dashboard') }}" 
                class="btn btn-outline-success text-white" style="font-size:20px; margin-left:85%">
                    Back
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-white text-sm font-medium ">Name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-textarea mt-1 block w-full" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="text-dark font-semibold px-4 py-2 rounded" style="border: 1px solid blue; background-color: #1E90FF;">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>