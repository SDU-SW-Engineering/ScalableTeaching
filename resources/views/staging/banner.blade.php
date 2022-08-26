<div class="h-12 bg-gray-500" id="staging-banner">
    <div class="flex container items-center justify-between h-full mx-auto px-6">
        <div class="text-white text-sm">
            <span>Current environment:</span>
            <span class="font-bold">{{ app()->environment() }}</span>
        </div>
        <div class="text-sm text-white flex items-center">
            <span class="mr-2">Switch user:</span>
            <select onchange="window.location = '/staging/impersonate/' + this.value"
                    class="py-0 text-sm text-black dark:bg-gray-700 dark:text-white border-none rounded-sm mr-2">
                <option value="-1">Signed out</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" @selected(auth()->id() == $user->id)>{{ $user->name }} @if($user->is_admin)(admin)@endif</option>
                @endforeach
            </select>
            <button onclick="document.getElementById('staging-modal').classList.toggle('hidden')"
                    class="text-white p-1.5 rounded hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
</div>
