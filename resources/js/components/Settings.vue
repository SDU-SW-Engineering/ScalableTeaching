<template>
    <div
        class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800">
        <h2 class="dark:text-white font-semibold text-2xl">Settings</h2>
        <div class="flex lg:w-1/2">
            <div class="border-2 rounded-xl p-4 mt-6 border-lime-green-400 relative">
                <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2">Start over</h3>
                <p class="text-gray-600 dark:text-gray-100">If you wish, you can reset your project here. Please note that this will erase the repository, and you will lose all commits made to it.</p>
                <button class="py-1 px-2 bg-red-400 text-red-900 font-semibold rounded hover:bg-red-300 transition-colors text-sm mt-2">Reset Project</button>
            </div>
        </div>
    </div>
</template>
