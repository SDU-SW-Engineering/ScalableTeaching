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
                <p class="bg-gray-100 text-red-700 dark:text-red-400 dark:bg-gray-900 rounded-md font-semibold px-2 py-2 text-sm max-w-xs mb-4 mt-2 text-center" v-text="errorMessage" v-show="errorMessage.length > 0"></p>
                <div class="mb-4 flex flex-col" v-if="Object.keys(groups).length > 0">
                    <span class="mb-1 text-gray-600 dark:text-gray-400">Start Assignment as:</span>
                    <select v-model="startAs" id="countries"
                            class="bg-gray-100 dark:bg-gray-600 border-gray-300 text-gray-900 dark:text-gray-200 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="solo" v-text="userName"></option>
                        <option :key="id" :value="id" v-for="(group, id) in groups"
                                v-text="group"></option>
                    </select>
                </div>
                <div class="flex justify-start gap-4">
                    <button @click="$emit('startAssignment', startAs)" :disabled="startingAssignment" :class="{'cursor-not-allowed': startingAssignment}"
                            class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-lime-green-600 rounded-md hover:bg-lime-green-500 focus:outline-none focus:ring focus:ring-lime-green-300 focus:ring-opacity-80">
                        <svg v-if="startingAssignment" class="animate-spin h-5 w-5 mr-1 text-white"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="mx-1" v-text="startingAssignment ? 'Creating...' : 'Start Assignment'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['startingAssignment', 'errorMessage', 'groups', 'userName'],
    data() {
        return {
            startAs: "solo"
        }
    }
}
</script>
