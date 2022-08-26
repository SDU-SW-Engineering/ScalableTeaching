<template>
    <div class="h-full">
        <div class="flex items-center">
            <span :class="{ 'cursor-pointer text-gray-300': type !== null, 'text-lime-green-400': type === null }"
                  @click="clear()" class="text-2xl font-thin">New task</span>
            <svg v-if="type !== null" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white mx-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
            <span v-if="type !== null" class="text-2xl text-lime-green-400 font-thin"
                  v-text="type === 'exercise' ? 'Exercise' : 'Assignment'"></span>
            <svg v-if="name !== ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white mx-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
            <span v-if="name !== ''" class="text-2xl text-gray-300 font-thin" v-text="name"></span>
        </div>
        <div class="flex items-center h-full justify-center gap-8" v-if="type === null">
            <div @click="type = 'exercise'"
                 class="hover:shadow-lg shadow cursor-pointer  bg-gray-700 px-4 py-8 rounded-lg">
                <h2 class="text-lime-green-400 text-2xl">Exercise</h2>
                <p class="text-gray-300">Smaller tasks that are cannot be graded.</p>
            </div>
            <div @click="type = 'assignment'"
                 class="hover:shadow-lg shadow cursor-pointer bg-gray-700 px-4 py-8 rounded-lg">
                <h2 class="text-lime-green-400 text-2xl">Assignment</h2>
                <p class="text-gray-300">Assignments are tracked and can be graded.</p>
            </div>
        </div>
        <div v-else class="flex flex-col items-center h-full justify-center">
            <h3 class="text-white mb-4 text-1xl">What's the name?</h3>
            <input v-model="name" type="text" id="name" name="name" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 mb-4
                           border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none h-12 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
            <button class="bg-lime-green-300 flex items-center justify-center text-lime-green-800 py-2 px-4 rounded hover:bg-lime-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 mr-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l6.75 6.75L21 4.5"/>
                </svg>
                <span>Create</span>
            </button>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            type: null,
            name: ''
        }
    },
    methods: {
        clear: function () {
            this.type = null;
            this.name = '';
        }
    }
}
</script>
