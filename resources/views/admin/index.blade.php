@extends('master')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-thin text-white">Admin Panel</h1>
        <form method="post" action="{{ route('admin.add-professor') }}" class="bg-gray-800 mt-4 p-4 w-96 rounded-lg">
            @csrf
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add course
                responsible</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="professor@uniersity.com" required>
            <button
                class="bg-lime-green-400 px-4 py-2 text-white mt-2 text-sm rounded-sm hover:bg-lime-green-500 transition-colors"
                type="submit">Add professor</button>
            @if ($errors->any())
                <div class="mt-4 flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </form>
        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Professor</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Is admin</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professors as $professor)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $professor->name }}</th>
                            <td class="px-6 py-4">{{ $professor->email }}</td>
                            <td class="px-6 py-4">{{ $professor->is_sys_admin ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4">
                                @if ($professor->id == auth()->id())
                                    <span class="italic text-xs font-light">This is you</span>
                                @else
                                    @if ($professor->is_sys_admin)
                                    <a href="{{ route('admin.toggle-promotion', $professor) }}"
                                            class="mr-4 bg-yellow-400 px-2 py-1 text-white text-xs rounded-sm hover:bg-yellow-500 transition-colors"
                                            type="submit">Demote from admin</a>
                                    @else
                                        <a href="{{ route('admin.toggle-promotion', $professor) }}"
                                            class="mr-4 bg-lime-green-400 px-2 py-1 text-white text-xs rounded-sm hover:bg-lime-green-500 transition-colors"
                                            type="submit">Promote to admin</a>
                                    @endif
                                    <a href="{{ route('admin.remove-professor', $professor) }}"
                                        class="bg-red-400 px-2 py-1 text-white text-xs rounded-sm hover:bg-red-500 transition-colors"
                                        type="submit">Remove</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
