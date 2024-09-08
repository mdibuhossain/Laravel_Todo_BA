<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-semibold text-gray-800">Todo List</h1>
                    </div>
                    <div class="mt-4 flex justify-between flex-row-reverse items-start">
                        <form accept="{{ route('dashboard.store') }}" method="POST" class="flex justify-between">
                            @csrf
                            <input type="text" name="todoTitle"
                                class="w-3/4 px-4 py-2 border border-gray-300 rounded-md"
                                placeholder="Enter your todo here">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">ADD</button>
                        </form>
                        @isset($todos)
                            <ul>
                                @foreach ($todos as $todo)
                                    <li class="flex justify-between items-center gap-2 py-2">
                                        <div>
                                            <span>
                                                {{ $todo['title'] }}
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{ route('dashboard.edit', $todo['id']) }}"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md">Edit</a>
                                            <form action="{{ route('dashboard.destroy', $todo['id']) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
