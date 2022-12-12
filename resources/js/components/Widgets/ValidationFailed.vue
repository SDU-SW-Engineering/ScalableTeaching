<template>
    <div
        class="bg-white shadow-lg px-4 py-6 rounded-md mt-8 dark:bg-gray-800">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mr-4 text-yellow-300 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="flex flex-col w-full justify-center">
                <h3 class="font-bold text-lg dark:text-white">Submission validation has failed</h3>
                <p class="text-gray-600 dark:text-gray-300">Despite one of your builds passing, validation for your project has failed:</p>
                <ul class="p-4 dark:bg-gray-900 bg-gray-200 rounded-md mt-2">
                    <li v-for="error in errors" class="text-yellow-600 dark:text-yellow-400 text-xs" v-text="error"></li>
                </ul>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Please correct the issues and try again.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        errors: {
            required: true,
            type: Array
        }
    }
}
</script>
