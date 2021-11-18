<template>
    <div>
        <div>
            <input type="text" placeholder="Filter"
                   class="mb-4 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-l-lg focus:outline-none focus:ring-2 focus:ring-lime-green-600  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"/>
            lol
        </div>
        <table class="w-full text-white">
            <thead>
            <tr>
                <th class="text-left">Student</th>
                <th>Task 1</th>
                <th>Task 2</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover:bg-gray-700 hover:rounded-lg">
                <td class="py-2 px-1">Niels Faurskov</td>
                <td class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-full text-lime-green-300" fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </td>
                <td class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-full text-red-300 fill-current" fill="none"
                         viewBox="0 0 24 24">
                        <path
                            d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zM17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299A3.111 3.111 0 0 0 10.834 13h2.332c.23.691.704 1.3 1.385 1.702A5.008 5.008 0 0 1 17 19z"></path>
                    </svg>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
