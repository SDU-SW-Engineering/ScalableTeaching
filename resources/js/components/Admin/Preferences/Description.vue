<template>
    <div
        class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg col-span-4"
    >
        <h1 class="text-black dark:text-white text-2xl font-thin mb-2 -mt-2">
            Description
        </h1>
        <div class="flex gap-4">
            <div class="w-3/4">
                <markdown-editor
                    @change="$emit('change')"
                    ref="editor"
                    :task="task"
                ></markdown-editor>
                <a
                    v-if="false"
                    :href="`/courses/${this.task.course_id}/tasks/${this.task.id}/admin/load-description-from-repo`"
                    class="bg-gray-400 flex items-center justify-center text-gray-600 py-2 px-4 rounded hover:bg-gray-500"
                >
                    <span class="text-white">Load from repo</span>
                </a>
            </div>
            <div class="w-1/4">
                <file-upload></file-upload>
            </div>
        </div>
    </div>
</template>

<script>
import FileUpload from "./FileUpload.vue";

export default {
    components: { FileUpload },
    props: ["task"],
    data() {
        return {};
    },
};
</script>
