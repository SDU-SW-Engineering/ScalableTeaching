<template>
    <div>
        <div v-show="!showEditor">
            <div
                class="mb-4 p-2 prose-sm dark:prose-light rounded dark:bg-gray-800"
                @dblclick="displayEditor()"
                v-html="task.description"
            ></div>
            <div class="flex gap-4">
                <button
                    @click="displayEditor()"
                    class="bg-gray-400 flex items-center justify-center text-gray-600 py-2 px-4 rounded hover:bg-gray-500"
                >
                    <span class="text-white">Change description</span>
                </button>
            </div>
        </div>
        <div v-show="showEditor">
            <div class="mb-4" :class="{ 'toastui-editor-dark': this.darkMode }">
                <editor
                    @change="$emit('change')"
                    :options="options"
                    ref="mdEditor"
                    height="500px"
                ></editor>
            </div>
        </div>
    </div>
</template>

<script>
import "@toast-ui/editor/dist/toastui-editor.css";
import "@toast-ui/editor/dist/theme/toastui-editor-dark.css";

import { Editor } from "@toast-ui/vue-editor";

export default {
    props: ["task"],
    components: {
        editor: Editor,
    },
    methods: {
        displayEditor: async function () {
            this.showEditor = true;
            this.$refs.mdEditor.invoke(
                "setMarkdown",
                this.task.markdown_description
            );
        },
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
                previewStyle: "tab",
            },
        };
    },
    mounted() {
        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            this.darkMode = true;
        }
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (event) => {
                this.darkMode = event.matches;
            });
        if (
            this.task.markdown_description === null ||
            this.task.markdown_description === ""
        )
            this.displayEditor();
    },
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

.slide-enter-to,
.slide-leave {
    max-height: 100px;
    overflow: hidden;
}

.slide-enter,
.slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
