<template>
    <div class="">
        <div class="flex flex-col">
            <div class="-my-1 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow-md overflow-hidden border-b border-gray-200 dark:border-gray-600 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-500">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Author
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Branch
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Run Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    When
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-500">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 rounded-full h-8 w-8 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-lime-green-700"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                                <span>Running...</span>
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                The Box #1
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-200">Niels Faurskov</div>
                                    <div class="text-sm text-gray-500">nfa@sdu.dk</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-700 dark:text-gray-200 text-sm">master</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span>61 seconds</span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 overflow">
                                        Queued for 2:22 minutes
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span>2 day ago</span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        16/08/2021 22:22:03
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex mt-2">
            <a href="#"
               class="flex items-center px-4 py-2 mr-1 text-gray-500 bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                Previous
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-lime-green-600 dark:hover:bg-lime-green-500 hover:text-white dark:hover:text-gray-200">
                1
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-lime-green-600 dark:hover:bg-lime-green-500 hover:text-white dark:hover:text-gray-200">
                2
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-lime-green-600 dark:hover:bg-lime-green-500 hover:text-white dark:hover:text-gray-200">
                3
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-lime-green-600 dark:hover:bg-lime-green-500 hover:text-white dark:hover:text-gray-200">
                Next
            </a>
        </div>
    </div>
</template>

<script>
export default {}
</script>
