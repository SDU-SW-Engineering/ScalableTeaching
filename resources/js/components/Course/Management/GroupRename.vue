<template>
    <div class="group flex items-center mb-4">
        <h1 v-if="!editing" @click="editing = true" v-text="name" class="text-3xl cursor-pointer font-thin dark:text-white"></h1>
        <button v-if="!editing" @click="editing = true" class="hidden group-hover:block dark:text-lime-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-1 w-5 h-5">
                <path
                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/>
            </svg>
        </button>
        <input @keydown.enter="save" v-if="editing"  type="text" v-model="title" value="" :placeholder="name" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           border border-gray-300 text-gray-900 sm:text-sm rounded-l-md focus:outline-none p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
        <button v-if="editing && !saving" @click="this.cancel"
                class="bg-red-500 hover:bg-red-600 transition-colors items-center text-white flex p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button @click="save" :disabled="saving" v-if="editing"
                class="bg-lime-green-400 hover:bg-lime-green-500 transition-colors items-center text-white flex p-2 rounded-r-md">
            <span v-if="saving">Saving...</span>
            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ['name', 'renameRoute'],
    data() {
        return {
            editing: false,
            saving: false,
            title: ''
        }
    },
    methods: {
        save: async function(){
            this.saving = true;
            await axios.put(this.renameRoute, {
                name: this.title
            })
            location.reload()
        },
        cancel: function() {
            this.editing = false;
            this.title = this.name;
        }
    },
    mounted() {
        this.title = this.name;
    }
}
</script>
