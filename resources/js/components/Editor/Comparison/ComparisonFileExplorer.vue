<template>
    <div
        style="height: 250px"
        class="bg-black select-none flex flex-col overflow-x-auto w-full"
    >
        <directory
            :selected="selected"
            @open="openFile"
            :directory="directory"
            v-for="directory in fileTree.directories"
            :overlappingFiles="overlappingFiles"
        />
        <file
            @open="openFile"
            :selected="selected"
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
import Swal from "sweetalert2";
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
        selected: {
            type: String,
            default: null,
        },
    },
    methods: {
        openFile: function (path, selectedIndex = null) {
            let comparison = this.overlappingFiles[path];
            if (comparison == null) {
                this.$emit("openFile", path, null);
                this.selected = path;
                return;
            }
            if (comparison.length > 1 && selectedIndex == null) {
                let options = {};
                for (let i = 0; i < comparison.length; i++) {
                    options[i] =
                        comparison[i].file +
                        " (" +
                        parseFloat(comparison[i].overlap * 100).toFixed(1) +
                        "%)";
                }
                Swal.fire({
                    title: "Multiple overlapping files!",
                    text:
                        "This file overlaps with " +
                        comparison.length +
                        " files. Which one do you want to compare against?",
                    input: "select",
                    inputOptions: options,
                    confirmButtonText: "Compare",
                }).then((val) => {
                    if (!val.isConfirmed) return;
                    this.openFile(path, Number(val.value));
                });
                return;
            }
            comparison = comparison[selectedIndex == null ? 0 : selectedIndex];
            this.$emit("openFile", path, comparison.file);
            this.selected = path;
        },
    },
};
</script>
