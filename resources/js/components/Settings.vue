<template>
    <div>
        <div
            class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800">
            <h2 class="dark:text-white font-semibold text-2xl">Settings</h2>
            <div class="flex lg:w-1/2">
                <div class="border-2 rounded-xl p-4 mt-6 border-lime-green-400 relative">
                    <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2">Start over</h3>
                    <p class="text-gray-600 dark:text-gray-100">If you wish, you can reset your project here. Please
                        note that this will erase the repository, and you will lose all commits made to it.</p>
                    <button @click="showResetWarning = true" :disabled="project.status === 'finished'"
                            :class="[project.status === 'finished' || project.status === 'overdue' ? 'cursor-not-allowed bg-gray-200 text-gray-400 dark:bg-gray-600' : 'bg-red-600 text-white hover:bg-red-500']"
                            class="py-1 px-2 font-semibold rounded transition-colors text-sm mt-2">Reset Project
                    </button>
                    <p v-if="project.status === 'finished' || project.status === 'overdue'"
                       class="text-red-600 font-semibold dark:text-red-500 text-xs mt-1">A finished project cannot be
                        reset.</p>
                </div>
            </div>
        </div>
        <alert type="danger" title="Reset project" :url="'/projects/' + project.id + '/reset'" confirm-button-text="Reset Project" content="Resetting your project cannot be undone. Be certain that this what you want to do before confirming." v-if="showResetWarning" @cancel="showResetWarning=false"></alert>
    </div>
</template>

<script>
import Alert from "./Alert";

export default {
    components: {Alert},
    props: ['project'],
    data: function() {
        return {
            showResetWarning: false
        }
    },
    methods: {
        resetProject: function () {
            confirm('Are you sure? This can\'t be undone!');
        }
    }
}
</script>
