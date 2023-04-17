<template>
    <div>
        <overlay v-if="initialLoad"></overlay>
        <toolbar :context="context" :file="openedFile" @toggleFeedback="showFeedbackList = !showFeedbackList"
                 @toggleSubTasks="showSubtasks = !showSubtasks"/>
        <div class="flex">
            <div class="flex">
                <side-bar @openFile="openFile" :file-tree="fileTree"/>
            </div>
            <div style="height: calc(100vh - 112px)" class="bg-gray-900 overflow-x-auto overflow-y-auto flex-grow">
                <welcome v-if="openedFile === null"/>
                <code-viewer :context="context" :file="openedFile" :scrollTo="goToLine" v-else/>
            </div>
            <div v-if="delegation != null && delegation.grading && showSubtasks" class="flex" style="height: calc(100vh - 112px)">
                <subtasks-grading-view :sub-tasks.sync="subTasks"></subtasks-grading-view>
            </div>
            <div class="flex" style="height: calc(100vh - 112px)">
                <feedback-list :should-grade="delegation.grading" :context="context" @openFile="openFile"
                               @close="showFeedbackList = false"
                               v-if="showFeedbackList"/>
            </div>
        </div>
        <new-alert title="Submit Feedback"
                   @cancel="showSendFeedbackDialog=false"
                   @confirm="submitFeedback"
                   :loading="dialogLoading"
                   :error-text="dialogError"
                   type="danger" v-if="showSendFeedbackDialog" confirm-button-text="Submit">
            <div>
                <div v-if="delegation.grading" class="flex gap-2">
                    <div class="flex items-center">
                        <input v-model="grade"
                               class="relative float-left mt-0.5 mr-1 -ml-[1.5rem] h-4 w-4 appearance-none rounded-full border-2 border-solid border-neutral-300 dark:border-neutral-600 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary dark:checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary dark:checked:after:border-primary dark:checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary dark:checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                               type="radio"
                               value="approve"
                               name="flexRadioDefault"
                               id="radioDefault02"/>
                        <label
                            class="mt-px inline-block pl-[0.15rem] text-sm text-lime-green-500 hover:cursor-pointer"
                            for="radioDefault02">
                            Approve
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input
                            class="relative float-left mt-0.5 mr-1 -ml-[1.5rem] h-4 w-4 appearance-none rounded-full border-2 border-solid border-neutral-300 dark:border-neutral-600 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary dark:checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary dark:checked:after:border-primary dark:checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary dark:checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                            type="radio"
                            name="flexRadioDefault"
                            v-model="grade"
                            value="reject"
                            id="radioDefault01"/>
                        <label
                            class="mt-px inline-block text-sm pl-[0.15rem] text-red-500 hover:cursor-pointer"
                            for="radioDefault01">
                            Reject
                        </label>
                    </div>

                </div>
                <p class="dark:text-white text-sm font-medium mt-1">General feedback:</p>
                <textarea v-model="generalFeedback"
                          class="text-sm dark:text-white dark:bg-gray-700 mt-1 w-full rounded-md dark:border-none"></textarea>
                <p class="text-blue-500 text-xs">Your feedback is anonymous to the recipient.</p>
            </div>
        </new-alert>
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
import NewAlert from "../NewAlert";
import SubtasksGradingView from "./SubtasksGradingView.vue";


export const bus = new Vue();

export default {
    components: {
        SubtasksGradingView, NewAlert, FeedbackList, Toolbar, Welcome, CodeViewer, Overlay, SideBar
    },
    props: {
        context: {
            type: String,
            required: true
        },
        delegation: {
            type: Object,
            required: false
        },
        subTasks: {
            type: Array | null,
            required: false
        }
    },
    data() {
        return {
            initialLoad: true,
            fileTree: {},
            openedFile: null,
            showFeedbackList: false,
            goToLine: null,
            showSendFeedbackDialog: false,
            showSubtasks: false,
            generalFeedback: "",
            dialogError: "",
            dialogLoading: false,
            grade: null,
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
        currentPath: function () {
            return location.pathname
        },
        submitFeedback: async function () {
            if (this.grade == null && this.delegation.grading) {
                this.dialogError = "No grade selected"
                return;
            }
            this.dialogError = "";
            this.dialogLoading = true;
            await axios.post(this.currentPath() + '/feedback', {
                general: this.generalFeedback,
                grade: this.grade,
                tasks: this.subTasks
            });
            location.reload();
        }
    },
    async mounted() {
        this.fileTree = (await axios.get(location.pathname + '/tree')).data;
        this.initialLoad = false;
        bus.$on('submit', (grade) => {
            this.showSendFeedbackDialog = true
            this.grade = grade
        });
        bus.delegation = this.delegation;
        let currentPoints = this.subTasks == null ? null : this.subTasks.reduce((total, group) => {
            return total + group.tasks.filter(t => t.points).reduce((total, c) => total + c.points, 0);
        }, 0)
        let maxPoints = this.subTasks == null ? null : this.subTasks.reduce((total, group) => {
            return total + group.tasks.reduce((total, c) => total + c.maxPoints, 0);
        }, 0)
        bus.$emit('currentPoints', currentPoints);
        bus.$emit('maxPoints', maxPoints);
    }
}
</script>
