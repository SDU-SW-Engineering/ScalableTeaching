<template>
    <div class="flex flex-col mb-4">
        <div
            class="flex items-center justify-between rounded-t-md bg-white dark:bg-gray-900 dark:border-none border-t border-r border-l px-3 pt-3">
            <div v-if="loading" class="h-4 w-36 bg-gray-200 dark:bg-gray-600 rounded animate-pulse"></div>
            <h2 v-else class="text-sm dark:text-white font-medium"
                v-text="file == null ? 'General feedback' : file"></h2>
            <div v-if="loading" class="h-4 w-36 bg-gray-200 dark:bg-gray-600 rounded animate-pulse"></div>
            <h2 v-else class="text-sm text-gray-500 dark:text-gray-400">Project: <i>{{ comment.owner }}</i></h2>
        </div>
        <div v-if="!loading" class="p-3 border-l border-r bg-white dark:bg-gray-900 dark:border-none">
            <div v-if="comment.line != null" class="relative whitespace-nowrap bg-gray-800 flex flex-col p-4 rounded-t">
                <div v-if="overlay" class="absolute bg-gray-900 opacity-30 left-0 right-0 top-0 bottom-0 rounded-t">
                </div>
                <div v-if="overlay"
                     class="absolute items-center justify-center w-full text-lime-green-500 dark:text-lime-green-400 left-0 right-0 top-0 bottom-0 z-20 flex">
                    <div class="flex bg-gray-200 dark:bg-gray-900 p-4 rounded items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-8 h-8 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        <span class="text-3xl font-thin">Reviewed</span>
                    </div>
                </div>
                <div v-for="line in lines" class="flex"
                     :class="[line.number === comment.line ? 'bg-gray-700':'', overlay ? 'filter select-none blur-sm' : '']">
                    <div class="w-10 select-none text-white font-medium text-left text-sm">{{ line.number }}</div>
                    <div>
                        <div class="whitespace-pre-wrap text-sm" v-html="line.line"></div>
                        <div v-if="line.number === comment.line" class="flex text-sm">
                            <div class="whitespace-pre" v-text="' '.repeat(indentation)"></div>
                            <div v-if="line.number === comment.line"
                                 class="bg-white dark:bg-gray-800 flex flex-col p-2 rounded w-72 text-sm whitespace-normal mb-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full mr-1" alt="avatar"
                                         :src="comment.feedback.user.avatar"/>
                                    <span class="font-medium dark:text-white">{{ comment.feedback.user.name }}:</span>
                                </div>
                                <span class="italic bg-gray-200 dark:text-gray-300 dark:bg-gray-700 p-1 rounded my-1"
                                      v-text="comment.comment"></span>
                                <span class="text-xs font-bold dark:text-gray-200">{{ comment.time_since }}</span>
                                <div class="mt-3 flex flex-col" v-if="comment.reviewer != null && overlay === false">
                                    <div class="flex items-center">
                                        <img class="h-6 w-6 rounded-full mr-1" alt="avatar"
                                             :src="comment.reviewer.avatar"/>
                                        <span class="font-medium dark:text-yellow-400">{{
                                                comment.feedback.user.name
                                            }}:</span>
                                    </div>
                                    <div class="flex items-center my-0.5"
                                         :class="{'text-lime-green-500 dark:text-lime-green-400': comment.status === 'approved', 'text-red-600 dark:text-red-500': comment.status === 'rejected'}">
                                        <svg v-if="comment.status === 'approved'" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                             stroke="currentColor" class="w-5 h-5 mr-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        <svg v-if="comment.status === 'rejected'" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                             stroke="currentColor" class="w-5 h-5 mr-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span class="text-sm" v-if="comment.status === 'approved'">Approved</span>
                                        <span class="text-sm" v-if="comment.status === 'rejected'">Rejected</span>
                                    </div>
                                    <span v-if="comment.reviewer_feedback != null"
                                          class="italic bg-gray-200 dark:text-gray-300 dark:bg-gray-700 p-1 rounded my-1"
                                          v-text="comment.reviewer_feedback"></span>
                                    <span class="text-xs font-bold dark:text-gray-200">{{
                                            comment.reviewed_time_since
                                        }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else
                 class="bg-white dark:bg-gray-800 flex flex-col p-2 rounded text-sm whitespace-normal mb-2">
                <div class="flex items-center">
                    <img class="h-6 w-6 rounded-full mr-1" alt="avatar" :src="comment.feedback.user.avatar"/>
                    <span class="font-medium dark:text-white">{{ comment.feedback.user.name }}:</span>
                </div>
                <span class="italic bg-gray-200 dark:text-gray-300 dark:bg-gray-700 p-1 rounded my-1"
                      v-text="comment.comment"></span>
                <span class="text-xs font-bold dark:text-gray-200">{{ comment.time_since }}</span>
            </div>
            <button @click="expanded = !expanded" v-text="expanded ? 'Collapse file' : 'Expand file'"
                    v-if="comment.line != null"
                    class="bg-gray-300 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm w-full h-8 hover:bg-gray-400 dark:hover:bg-gray-600 hover:text-gray-700 dark:hover:text-gray-300 transition-colors  rounded-b">
            </button>
        </div>
        <div v-if="!loading"
             class="p-3 flex items-center justify-center w-full text-center bg-white dark:text-white dark:bg-gray-900 rounded-b border-b border-l border-r py-2 dark:border-none">
            <button v-if="!reviewing" @click="review('approved')"
                    :class="{'text-lime-green-700  dark:text-lime-green-500': comment.status === 'pending' || comment.status === 'approved', 'text-gray-400': comment.status === 'rejected'}"
                    class="flex justify-end items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                <span class="text-lg font-thin">Approve</span>
            </button>
            <div v-if="!reviewing" class="h-5 w-0.5 bg-gray-100 mx-2"></div>
            <button v-if="!reviewing" @click="review('rejected')"
                    :class="{'text-red-700 dark:text-red-500': comment.status === 'pending' || comment.status === 'rejected', 'text-gray-400': comment.status === 'approved'}"
                    class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span class="text-lg font-thin">Reject</span>
            </button>
            <svg v-if="reviewing" class="animate-spin h-5 w-5 text-white mb-2" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <div v-if="loading" class="bg-white dark:bg-gray-900 rounded-b border-l border-r dark:border-none border-b">
            <div class="bg-gray-300 dark:bg-gray-800 animate-pulse h-52 m-3 rounded"></div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {computed, onMounted, ref} from "vue";
import {ProjectFeedbackComment} from "../../Interfaces/Models/ProjectFeedbackComment";
import axios from "axios";
import {CodeLine} from "../../Interfaces/CodeLine";

const props = withDefaults(defineProps<{
    commentId: number,
    showOverlay: boolean,
    basePath: string
}>(), {
    showOverlay: true
});

const comment = ref<ProjectFeedbackComment | null>(null)
const loading = ref<boolean>(true);
const expanded = ref<boolean>(false);
const overlay = ref<boolean>(false);
const reviewing = ref<boolean>(false);

async function review(status: 'approved' | 'rejected') {
    let reason = prompt("Specify a reasoning? Leave empty for none");
    if (reason == null)
        return;
    reviewing.value = true;
    await axios.put(props.basePath, {
        status,
        reason: reason === "" ? null : reason
    })
    await refresh();
    if (props.showOverlay)
        overlay.value = true;
    reviewing.value = false;
}

async function refresh(): Promise<void> {
    comment.value = (await axios.get(props.basePath)).data as ProjectFeedbackComment;
}

const lines = computed<CodeLine[]>(() => {
    if (comment == null)
        return [];
    if (expanded.value)
        return comment.value.code_all;
    return comment.value.code;
});

const indentation = computed<number>(() => {
    if (comment.value == null)
        return 0;

    if (comment.value.code == null)
        return 0;

    let c = comment.value.code.filter(line => line.number === comment.value.line)[0];
    let indentation = c.line.match(/>(\s+)/);
    if (indentation === null)
        return 0;
    return indentation[0].length - 1;
});

const file = computed<string | null>(() => {
    if (comment.value == null)
        return "";
    if (comment.value.filename == null)
        return null;
    let parts = comment.value.filename.split('/');
    return parts.splice(1, parts.length).join("/");
});

onMounted(async () => {
    await refresh();
    loading.value = false;
})
</script>
