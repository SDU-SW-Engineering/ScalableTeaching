<template>
    <div
         class="bg-white shadow-lg px-4 py-6 rounded-md mt-8 dark:bg-gray-800">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-24 w-24 text-red-300 dark:text-red-400" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex flex-col w-full items-center justify-center">
                <h3 class="font-bold text-lg mb-4 dark:text-white text-center">You
                    haven't started your
                    assignment yet</h3>
                <div class="flex justify-start gap-4">
                    <button @click="hideMissingAssignmentWarning = true"
                            class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-lime-green-600 rounded-md hover:bg-lime-green-500 focus:outline-none focus:ring focus:ring-lime-green-300 focus:ring-opacity-80">
                        <span class="mx-1">Start Assignment</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
