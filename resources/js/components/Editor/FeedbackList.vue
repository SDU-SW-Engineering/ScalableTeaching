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
            <div class="flex flex-col overflow-auto" :class="[context === 'pre-submission' ? 'feedback-list' : 'feedback-list-full']">
                <div @click="goToFile(comment)" :class="[comment.shortFile == null ? '' : 'hover:bg-gray-700 cursor-pointer']" class=" transition-colors  p-2 flex flex-col" :key="comment.id" v-for="comment in comments">
                    <span v-if="comment.shortFile != null" class="text-xs font-medium text-lime-green-400">{{ comment.shortFile }}:{{ comment.line }}</span>
                    <span v-else class="text-xs font-medium text-lime-green-400">General feedback</span>
                    <div :class="[comment.reviewer_feedback == null ? 'my-1 rounded' : 'mt-1 rounded-t']" class="bg-gray-600 p-2 text-white text-sm">
                        <span v-text="comment.comment"></span>
                    </div>
                    <div class="flex flex-col bg-gray-900 p-2 rounded-b text-xs mb-2" v-if="comment.reviewer_feedback != null">
                        <span class="text-white font-italic">Response from reviewer:</span>
                        <span class="italic text-gray-300" v-text="comment.reviewer_feedback"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white text-xs" v-text="comment.time_since"></span>
                        <span class="text-yellow-300 text-xs font-medium" v-if="comment.status === 'pending'">Pending review</span>
                        <span class="text-lime-green-300 text-xs font-medium" v-else-if="comment.status === 'approved'">Approved</span>
                        <span class="text-red-400 text-xs font-medium" v-else-if="comment.status === 'rejected'">Rejected</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="context === 'pre-submission'">
            <div v-if="shouldGrade" class="flex items-center justify-center gap-4 my-4 mx-auto">
                <div>
                    <input
                        class="relative float-left mt-0.5 mr-1 -ml-[1.5rem] h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 dark:border-neutral-600 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary dark:checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary dark:checked:after:border-primary dark:checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary dark:checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                        type="radio"
                        name="flexRadioDefault"
                        v-model="grade"
                        value="reject"
                        id="radioDefault01" />
                    <label
                        class="mt-px inline-block pl-[0.15rem] text-red-300 hover:cursor-pointer"
                        for="radioDefault01">
                        Reject
                    </label>
                </div>
                <div>
                    <input v-model="grade"
                        class="relative float-left mt-0.5 mr-1 -ml-[1.5rem] h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 dark:border-neutral-600 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary dark:checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary dark:checked:after:border-primary dark:checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary dark:checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                        type="radio"
                           value="approve"
                        name="flexRadioDefault"
                        id="radioDefault02" />
                    <label
                        class="mt-px inline-block pl-[0.15rem] text-lime-green-300 hover:cursor-pointer"
                        for="radioDefault02">
                        Approve
                    </label>
                </div>
            </div>
            <button @click="submitComments"
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
import { bus } from "./Editor"
export default {
    props: {
        context: {
            type: String,
            required: true
        },
        shouldGrade: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            isLoading: true,
            comments: [],
            grade: null
        }
    },
    methods: {
        loadComments: async function () {
            this.isLoading = true;
            this.comments = (await axios.get(location.pathname + '/comments')).data.map(comment => {
                if (comment.filename == null)
                    return {
                        ...comment,
                        shortFile: null
                    };

                let slashIndex = comment.filename.indexOf('/');
                return {
                    ...comment,
                    shortFile: comment.filename.substr(slashIndex+1)
                }
            });
            this.isLoading = false;
        },
        goToFile: function (comment) {
            if (comment.filename == null)
                return;
            this.$emit('openFile', comment.filename, comment.line);
        },
        submitComments: function() {
            if (this.shouldGrade && this.grade == null)
            {
                alert("Please approve or reject!");
                return;
            }
            bus.$emit('submit-comments', this.grade);
        }
    },
    computed: {
        maxHeight: function() {
            return 10;
        }
    },
    mounted: async function () {
        await this.loadComments();

        bus.$on('commentsUpdated', () => this.loadComments())
    }
}
</script>

<style scoped>
.feedback-list-full {
    max-height: calc(80vh - 48px);
}

.feedback-list {
    max-height: calc(80vh - 48px - 48px);
}
</style>
