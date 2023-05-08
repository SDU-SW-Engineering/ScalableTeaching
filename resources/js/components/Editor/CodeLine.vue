<template>
    <div class="">
        <div
            :class="{
                'bg-lime-green-900 hover:bg-lime-green-700': isMarked,
                'hover:bg-gray-700': !isMarked,
            }"
            class="flex group"
            :id="'line-' + line.number"
        >
            <div class="w-14 items-start justify-end flex-shrink-0 mr-4 flex">
                <div
                    @click="toggleComment"
                    class="flex cursor-pointer items-center"
                >
                    <span
                        class="text-gray-400 select-none"
                        v-text="line.number"
                    ></span>
                    <div class="w-4 h-4 ml-1">
                        <svg
                            v-if="
                                !isCommenting &&
                                this.relevantComments.length === 0
                            "
                            xmlns="http://www.w3.org/2000/svg"
                            class="hidden group-hover:block text-lime-green-400 w-4 h-4 fill-current"
                            viewBox="0 0 24 24"
                            style="transform: ; msfilter: "
                        >
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-3 9h-4v4h-2v-4H7V9h4V5h2v4h4v2z"
                            ></path>
                        </svg>
                        <svg
                            v-else
                            class="text-lime-green-400 w-4 h-4 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            style="transform: ; msfilter: "
                        >
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"
                            ></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <span class="commentable" v-html="line.line"></span>
                <comment-editor
                    @commentCreated="commentCreated"
                    :file="file"
                    @close="closeEditor"
                    :updating="editing"
                    v-if="isCommenting"
                    :line="line.number"
                    :indentation="indentation"
                ></comment-editor>
                <comment
                    :actions="context !== 'submitted'"
                    v-if="editing == null"
                    @edit="edit"
                    @delete="commentDeleted"
                    :comment="comment"
                    :perspective="
                        context === 'recipient' ? 'recipient' : 'sender'
                    "
                    :indentation="indentation"
                    :key="comment.id"
                    v-for="comment in relevantComments"
                ></comment>
            </div>
        </div>
    </div>
</template>

<script>
import CommentEditor from "./CommentEditor";

import Comment from "./Comment";
import { bus } from "./Editor";

export default {
    components: { Comment, CommentEditor },
    props: {
        line: {
            type: Object,
            required: true,
        },
        file: {
            type: String,
            required: true,
        },
        comments: {
            type: Array,
        },
        context: {
            type: String,
            required: true,
        },
        isMarked: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            isCommenting: false,
            editing: null,
        };
    },
    methods: {
        closeEditor: function () {
            this.isCommenting = false;
            this.editing = null;
        },
        toggleComment() {
            if (this.context !== "pre-submission") return;
            if (this.relevantComments.length > 0) return;
            this.isCommenting = !this.isCommenting;
        },
        commentCreated: function (comment) {
            this.isCommenting = false;
            this.editing = null;
            this.$emit("commentCreated", comment);
        },
        commentDeleted: function (comment) {
            this.$emit("commentDeleted", comment);
            bus.$emit("commentsUpdated", comment);
        },
        edit: function (comment) {
            this.editing = comment;
            this.isCommenting = true;
        },
    },
    computed: {
        indentation: function () {
            let indentation = this.line.line.match(/>(\s+)/);
            if (indentation == null) return 0;

            return indentation[1].length;
        },
        relevantComments: function () {
            if (this.comments.length === 0) return [];
            return this.comments.filter((x) => x.line === this.line.number);
        },
    },
    mounted() {},
};
</script>
