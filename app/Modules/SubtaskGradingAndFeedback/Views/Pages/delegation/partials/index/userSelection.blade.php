<span class="text-md font-bold dark:text-white">Users</span>
<select multiple name="users[]"
        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
    @foreach($course->members()->orderBy('name')->get() as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
</select>
<p class="dark:text-gray-600 text-sm">Psst, It's a multi select, hold CTRL or CMD while selecting to select more than one.</p>
