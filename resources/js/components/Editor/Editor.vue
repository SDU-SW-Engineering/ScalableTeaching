<template>
    <div>
        <overlay v-if="initialLoad"></overlay>
        <toolbar :file="openedFile" @toggleFeedback="showFeedbackList = !showFeedbackList"/>
        <div class="flex">
            <div class="flex vh80">
                <side-bar @openFile="openFile" :file-tree="fileTree"/>
            </div>
            <div class="bg-gray-900 vh80 overflow-x-auto overflow-y-auto flex-grow">
                <welcome v-if="openedFile === null"/>
                <code-viewer :file="openedFile" :scrollTo="goToLine" v-else/>
            </div>
            <div class="flex vh80">
                <feedback-list @openFile="openFile" @close="showFeedbackList = false" v-if="showFeedbackList"/>
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
import Toolbar from "./Toolbar";
import Vue from "vue";
import FeedbackList from "./FeedbackList";


export const bus = new Vue();

export default {
    components: {FeedbackList, Toolbar, Welcome, CodeViewer, Overlay, SideBar},
    data() {
        return {
            initialLoad: true,
            fileTree: {},
            openedFile: null,
            showFeedbackList: false,
            goToLine: null
        }
    },
    methods: {
        openFile: async function (path, line = null) {
            this.goToLine = null;
            try {
                let response = await axios.get(location.pathname + '/file', {
                    params: {
                        path
                    }
                });
                this.openedFile = response.data;
            } catch (e) {
                alert("This item can't be opened in the viewer.");
            }
        }
    },
    async mounted() {
        this.fileTree = (await axios.get(location.pathname + '/tree')).data;
        this.initialLoad = false;
    }
}
</script>
