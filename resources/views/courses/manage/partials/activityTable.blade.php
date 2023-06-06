<div class="overflow-x-auto relative mt-4 border border-gray-200 dark:border-none rounded">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">
                Affected
            </th>
            <th scope="col" class="py-3 px-6">
                Message
            </th>
            <th scope="col" class="py-3 px-6">
                By
            </th>
            <th scope="col" class="py-3 px-6">
                Kind
            </th>
            <th scope="col" class="py-3 px-6">
                When
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row"
                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $activity->affected?->name ?? 'System' }}</th>
                <td class="py-4 px-6">
                    {!! $activity->message !!}
                </td>
                <td class="py-4 px-6">
                    {{ $activity->affectedBy?->name ?? 'System' }}
                </td>
                <td class="py-4 px-6">
                    {{ $activity->kind }}
                </td>
                <td class="py-4 px-6">
                    {{ $activity->created_at->diffForHumans() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
