<template>
    <div>
        <div v-show="!showEditor">
            <div class="mb-4 p-2 prose-sm dark:prose-light rounded dark:bg-gray-800" @dblclick="displayEditor()" v-html="task.description"></div>
            <div class="flex gap-4">
                <button @click="displayEditor()"
                        class="bg-gray-400 flex items-center justify-center text-gray-600 py-2 px-4 rounded hover:bg-gray-500">
                    <span class="text-white">Change description</span>
                </button>
                <a :href="`/courses/${this.task.course_id}/tasks/${this.task.id}/admin/load-description-from-repo`"
                        class="bg-gray-400 flex items-center justify-center text-gray-600 py-2 px-4 rounded hover:bg-gray-500">
                    <span class="text-white">Load from repo</span>
                </a>
            </div>
        </div>
        <div v-show="showEditor">
            <div class="mb-4" :class="{ 'toastui-editor-dark': this.darkMode }">
                <editor :options="options" ref="mdEditor" height="500px"></editor>
            </div>
            <div class="flex items-center">
                <button @click="save()"
                        class="bg-lime-green-300 flex items-center justify-center text-lime-green-800 py-2 px-4 rounded hover:bg-lime-green-400">
                    <svg v-if="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg v-if="!loading" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 mr-1.5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l6.75 6.75L21 4.5"/>
                    </svg>
                    <span v-if="!loading" class="text-white">Save changes</span>
                </button>
                <transition name="slide">
                    <span class="dark:text-white ml-2" v-if="saved">Changes saved</span>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>

import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';

import {Editor} from '@toast-ui/vue-editor';

export default {
    props: ['task'],
    components: {
        editor: Editor
    },
    methods: {
        save: async function () {
            this.loading = true;
            let markdown = this.$refs.mdEditor.invoke('getMarkdown')

            await axios.post(`/courses/${this.task.course_id}/tasks/${this.task.id}/admin/save-description`, {
                markdown: markdown
            })

            this.loading = false;
            this.saved = true;
            setTimeout(() => this.saved = false, 2000);
        },
        displayEditor: async function () {
            this.showEditor = true;
            this.$refs.mdEditor.invoke("setMarkdown", this.task.markdown_description);
        }
    },
    data() {
        return {
            darkMode: false,
            showEditor: false,
            loading: false,
            saved: false,
            options: {
                usageStatistics: false,
                hideModeSwitch: true,
                previewStyle: 'tab'
            }
        }
    },
    mounted() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            this.darkMode = true;
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            this.darkMode = event.matches;
        });
        if (this.task.markdown_description === null || this.task.markdown_description === "")
            this.displayEditor();
    }
};

</script>

<style>
.slide-enter-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: ease-in;
    -webkit-transition-timing-function: ease-in;
    -o-transition-timing-function: ease-in;
    transition-timing-function: ease-in;
}

.slide-leave-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to, .slide-leave {
    max-height: 100px;
    overflow: hidden;
}

.slide-enter, .slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
