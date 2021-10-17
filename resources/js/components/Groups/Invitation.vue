<template>
    <article>
             class="rounded-xl bg-white dark:bg-gray-600 shadow-lg row-start-1 lg:row-start-2 mb-6">
        <h2 class="text-xl font-semibold text-black dark:text-gray-100 px-6 pt-4">Group Invitation</h2>
        <p class="pb-6 text-xs text-base text-gray-400 px-6">
            Group 11
        </p>
        <div class="w-full flex border-t border-b dark:border-gray-500 py-4 justify-between">
            <dt class="pl-6 w-2/5 uppercase font-semibold tracking-wide text-sm text-gray-600 dark:text-gray-100">
                Members
            </dt>
            <div class="pr-6">
                <dd v-for="i in 3"
                    class="text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-full py-1 pl-4 pr-4 flex items-center mb-4 last:mb-0">
                    Andrew Parsons
                </dd>
            </div>
        </div>
        <div class="grid grid-cols-2 px-6 py-4 gap-6">
            <button
                class="bg-gray-100 dark:bg-gray-400 py-3 text-black dark:text-white font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                Decline
            </button>
            <button
                class="bg-lime-green-500 py-3 font-medium text-white rounded-lg hover:bg-lime-green-600 transition-colors duration-200">
                Accept
            </button>
        </div>
    </article>
</template>

<script>
export default {

}
</script>
