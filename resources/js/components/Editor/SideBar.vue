<template>
    <div class="bg-black select-none flex flex-col overflow-x-auto overflow-y-auto" style="width: 250px">
        <directory @open="openFile" :directory="directory" v-for="directory in fileTree.directories"/>
        <file @open="openFile" :level="0" :file="file" v-for="file in fileTree.files"></file>
    </div>
</template>

<script>
import { getIcon } from 'material-file-icons';
import Directory from "./Directory";
import CodeViewer from "./CodeViewer";
import File from "./File";
export default {
    components: {File, Directory},
    props: {
        fileTree: {
            type: Object,
            required: true
        }
    },
    methods: {
        openFile: function(path) {
            this.$emit('openFile', path);
        }
    }
}
</script>
