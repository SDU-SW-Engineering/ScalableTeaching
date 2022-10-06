<template>
    <div class="flex flex-col bg-gray-800" style="width: 300px">
        <div class="flex-grow">
            <div class="flex items-center justify-between p-2">
                <button @click="$emit('close')" class="rounded-full hover:bg-gray-700 p-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                              d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="flex">
                    <svg v-if="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-100 text-sm" v-else>{{ comments.length }} comments</span>
                </div>
            </div>
            <div class="flex flex-col overflow-auto" style="max-height: calc(80vh - 48px - 48px);">
                <div @click="goToFile(comment)" class="cursor-pointer hover:bg-gray-700 transition-colors  p-2 flex flex-col" :key="comment.id" v-for="comment in comments">
                    <span class="text-xs font-medium text-lime-green-400">{{ comment.shortFile }}:{{ comment.line }}</span>
                    <div class="bg-gray-600 p-2 my-1 rounded text-white text-sm">
                        <span v-text="comment.comment"></span>
                    </div>
                    <span class="text-white text-xs" v-text="comment.time_since"></span>
                </div>
            </div>
        </div>
        <div>
            <button
                class="bg-lime-green-500 w-full flex items-center justify-center py-3 text-white hover:bg-lime-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                    <path
                        d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                </svg>
                <span>Submit Feedback</span>
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isLoading: true,
            comments: []
        }
    },
    methods: {
        loadComments: async function () {
            this.isLoading = true;
            this.comments = (await axios.get(location.pathname + '/comments')).data.map(comment => {
                let slashIndex = comment.filename.indexOf('/');
                return {
                    ...comment,
                    shortFile: comment.filename.substr(slashIndex+1)
                }
            });
            this.isLoading = false;
        },
        goToFile: function (comment) {
            this.$emit('openFile', comment.filename, comment.line);
        }
    },
    mounted: async function () {
        await this.loadComments();
    }
}
</script>
