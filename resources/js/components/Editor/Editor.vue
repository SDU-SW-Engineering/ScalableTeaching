<template>
    <div>
        <overlay v-if="initialLoad"></overlay>
        <div class="flex">
            <div class="flex vh80">
                <side-bar @openFile="openFile" :file-tree="fileTree"/>
            </div>
            <div class="bg-gray-900 vh80 overflow-x-auto overflow-y-auto flex-grow">
                <welcome v-if="openedFile === null"/>
                <code-viewer :file="openedFile" v-else/>
            </div>
        </div>
    </div>
</template>

<script>
import SideBar from "./SideBar";
import Overlay from "./Overlay";
import axios from "axios";
import CodeViewer from "./CodeViewer";
import Welcome from "./Welcome";

export default {
    components: {Welcome, CodeViewer, Overlay, SideBar},
    data() {
        return {
            initialLoad: true,
            fileTree: {},
            openedFile: null
        }
    },
    methods: {
        openFile: async function (path) {
            this.openedFile = (await axios.get(location.pathname + '/file', {
                params: {
                    path
                }
            })).data
        }
    },
    async mounted() {
        this.fileTree = (await axios.get(location.pathname + '/tree')).data;
        this.initialLoad = false;
    }
}
</script>
