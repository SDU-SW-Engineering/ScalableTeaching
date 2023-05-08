<template>
    <div
        style="height: 250px"
        class="bg-black select-none flex flex-col overflow-x-auto w-full"
    >
        <directory
            @open="openFile"
            :directory="directory"
            v-for="directory in fileTree.directories"
            :overlappingFiles="overlappingFiles"
        />
        <file
            @open="openFile"
            :level="0"
            :file="file"
            v-for="file in fileTree.files"
            :overlappingFiles="overlappingFiles"
        ></file>
    </div>
</template>

<script>
import { getIcon } from "material-file-icons";
import Directory from "../Directory.vue";
import CodeViewer from "../CodeViewer.vue";
import File from "../File.vue";
export default {
    components: { File, Directory },
    name: "comparisonFileExplorer",
    props: {
        fileTree: {
            type: Object,
            required: true,
        },
        overlappingFiles: {
            type: Object,
            default: {},
        },
    },
    methods: {
        openFile: function (path) {
            this.$emit("openFile", path);
        },
    },
};
</script>
