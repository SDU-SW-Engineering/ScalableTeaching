<span class="text-sm font-bold dark:text-white">Role</span>
<select name="role"
        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
    {{-- Uncomment when link with roles is established
    @foreach($eligibleRoles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach--}}
    <option value="student">Student</option>
    <option value="teacher">Teacher</option>
</select>
