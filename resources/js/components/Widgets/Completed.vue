<template>
    <div class="shadow-lg">
        <div
            class="bg-white px-4 py-6 rounded-t-md mt-8 dark:bg-gray-800">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-24 w-24 text-lime-green-300 dark:text-lime-green-400 mr-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex flex-col w-full justify-center">
                    <h3 class="font-bold text-lg dark:text-white">Assignment handed in</h3>
                    <p class="text-gray-600 dark:text-gray-300">You have successfully handed in your assignment.
                        Subsequent builds will not be tracked.</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-200 dark:bg-gray-600 rounded-b-md px-4 py-4">
            <div class="flex items-center" v-if="validation === 'pending'">
                <svg class="animate-spin h-6 w-6 text-lime-green-500 mr-4 flex-shrink-0"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm dark:text-white">Your assignment is pending validation to prevent cheating.
                    Please check back later.</span>
            </div>
            <div class="flex items-center" v-else-if="validation === 'failed'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm dark:text-white">Your assigment has failed validation. Please contact the course owner.</span>
            </div>
            <div class="flex items-center" v-else>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-lime-green-300 dark:text-lime-green-400 mr-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm dark:text-white">Your assigment has been validated. Good job.</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['validation']
}
</script>
