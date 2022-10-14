<template>
    <div>
        <overlay v-if="initialLoad"></overlay>
        <toolbar :context="context" :file="openedFile" @toggleFeedback="showFeedbackList = !showFeedbackList"/>
        <div class="flex">
            <div class="flex vh80">
                <side-bar @openFile="openFile" :file-tree="fileTree"/>
            </div>
            <div class="bg-gray-900 vh80 overflow-x-auto overflow-y-auto flex-grow">
                <welcome v-if="openedFile === null"/>
                <code-viewer :context="context" :file="openedFile" :scrollTo="goToLine" v-else/>
            </div>
            <div class="flex vh80">
                <feedback-list :context="context" @openFile="openFile" @close="showFeedbackList = false" v-if="showFeedbackList"/>
            </div>
        </div>
        <alert title="Submit Feedback"
               @cancel="showSendFeedbackDialog=false"
               method="post"
               :url="currentPath() + '/feedback'"
               content="Are you sure you want to submit your feedback? This cannot be undone" type="danger" v-if="showSendFeedbackDialog" confirm-button-text="Submit">
        </alert>
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
import Alert from "../Alert";


export const bus = new Vue();

export default {
    components: {Alert, FeedbackList, Toolbar, Welcome, CodeViewer, Overlay, SideBar},
    props: {
        context: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            initialLoad: true,
            fileTree: {},
            openedFile: null,
            showFeedbackList: false,
            goToLine: null,
            showSendFeedbackDialog: false
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
        },
        currentPath: function() {
            return location.pathname
        }
    },
    async mounted() {
        this.fileTree = (await axios.get(location.pathname + '/tree')).data;
        this.initialLoad = false;
        bus.$on('submit-comments', () => this.showSendFeedbackDialog = true);
    }
}
</script>
