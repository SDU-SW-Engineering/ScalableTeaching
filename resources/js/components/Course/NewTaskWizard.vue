<template>
    <div class="h-full">
        <div class="flex items-center">
            <span
                :class="{ 'cursor-pointer text-gray-400 dark:text-gray-300': type !== null, 'text-lime-green-500 dark:text-lime-green-400': type === null }"
                @click="goToStep1()" class="text-2xl font-thin">New task</span>
            <svg v-if="type !== null" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black dark:text-white mx-1">
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
        <div class="flex items-center h-full justify-center gap-8" v-if="step === 1">
            <div @click="goToStep2('exercise')"
                 class="hover:shadow-lg shadow cursor-pointer bg-gray-200 dark:bg-gray-700 px-4 py-8 rounded-lg">
                <h2 class="text-lime-green-500 dark:text-lime-green-400 text-2xl">Exercise</h2>
                <p class="text-gray-700 font-thin dark:text-gray-300">Smaller tasks cannot be manually graded.</p>
            </div>
            <div @click="goToStep2('assignment')"
                 class="hover:shadow-lg shadow cursor-pointer bg-gray-200 dark:bg-gray-700 px-4 py-8 rounded-lg">
                <h2 class="text-lime-green-500 dark:text-lime-green-400 text-2xl">Assignment</h2>
                <p class="text-gray-700 font-thin dark:text-gray-300">Assignments are tracked and can be graded with
                    greater detail.</p>
            </div>
        </div>
        <div v-else-if="step === 2" class="flex flex-col items-center h-full justify-center gap-8">
            <div class="flex gap-8">
                <div v-if="type === 'exercise'" @click="backedBy = 'text'"
                     :class="{ 'bg-gray-200 dark:bg-gray-700 cursor-pointer': this.backedBy !== 'text', 'bg-lime-green-400': this.backedBy === 'text'}"
                     class="hover:shadow-lg shadow cursor-pointer px-4 py-8 rounded-lg w-80">
                    <h2 :class="[ this.backedBy === 'text' ? 'text-white' : 'text-lime-green-500 dark:text-lime-green-400']" class="text-2xl">Text backed</h2>
                    <p :class="[ this.backedBy === 'text' ? 'text-gray-100' : 'text-gray-700 font-thin dark:text-gray-300']" class="font-thin">Simple tasks that can be described via text.</p>
                </div>
                <div @click="backedBy = 'repo'"
                     :class="{ 'bg-gray-200 dark:bg-gray-700 cursor-pointer': this.backedBy !== 'repo', 'bg-lime-green-400': this.backedBy === 'repo'}"
                     class="hover:shadow-lg shadow px-4 py-8 rounded-lg w-80">
                    <h2 class="text-2xl" :class="[ this.backedBy === 'repo' ? 'text-white' : 'text-lime-green-500 dark:text-lime-green-400']">Repo backed</h2>
                    <p class="font-thin" :class="[ this.backedBy === 'repo' ? 'text-gray-100' : 'text-gray-700 font-thin dark:text-gray-300']" >A task that allows the student to clone a repo. Allows for automated grading through pipelines.</p>
                    <repo-selection @changed="setRepo" v-show="backedBy === 'repo'"></repo-selection>
                </div>
            </div>
            <button v-if="canContinueToStep3" @click="goToStep3()"
                    class="bg-lime-green-300 flex items-center justify-center text-lime-green-800 py-2 px-4 rounded hover:bg-lime-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 mr-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l6.75 6.75L21 4.5"/>
                </svg>
                <span>Continue</span>
            </button>
        </div>
        <div v-else-if="step === 3" class="flex flex-col items-center h-full justify-center">
            <h3 class="text-black dark:text-white mb-4 text-1xl">What's the name?</h3>
            <input v-model="name" type="text" id="name" name="name" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 mb-4
                           border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none h-12 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
            <button @click="goToStep3()"
                    class="bg-lime-green-300 flex items-center justify-center text-lime-green-800 py-2 px-4 rounded hover:bg-lime-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 mr-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l6.75 6.75L21 4.5"/>
                </svg>
                <span>Continue</span>
            </button>
        </div>
    </div>
</template>

<script>
import RepoSelection from "./RepoSelection";
export default {
    components: {RepoSelection},
    data() {
        return {
            step: 1,
            type: null,
            name: '',
            backedBy: null,
            repoId: null
        }
    },
    methods: {
        setRepo: function(repo)
        {
            this.repoId = repo;
        },
        goToStep1: function () {
            this.type = null;
            this.name = '';
            this.step = 1;
        },
        goToStep2: function (type) {
            this.step = 2;
            this.type = type;
        },
        goToStep3: function () {
            this.step = 3;
        }
    },
    computed: {
        canContinueToStep3: function() {
            if (this.backedBy === 'text')
                return true;
            if (this.backedBy === 'repo' && this.repoId !== null)
                return true;
            return false;
        }
    }
}
</script>
