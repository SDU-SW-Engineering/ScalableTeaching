<template>
    <div>
        <div class="flex hover:bg-gray-700 group">
            <div
                 class="w-14 items-start justify-end flex-shrink-0 mr-4 flex">
                <div @click="toggleComment" class="flex cursor-pointer items-center">
                    <span class="text-gray-400 select-none" v-text="line.number"></span>
                    <div class="w-4 h-4 ml-1">
                        <svg v-if="!isCommenting && this.relevantComments.length === 0" xmlns="http://www.w3.org/2000/svg"
                             class="hidden group-hover:block text-lime-green-400 w-4 h-4 fill-current"
                             viewBox="0 0 24 24" style="transform: ;msFilter:;">
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-3 9h-4v4h-2v-4H7V9h4V5h2v4h4v2z"></path>
                        </svg>
                        <svg v-else class="text-lime-green-400 w-4 h-4 fill-current"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             style="transform: ;msFilter:;">
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <span class="commentable" v-html="line.line"></span>
                <comment-editor :file="file" @close="isCommenting = false" v-if="isCommenting && relevantComments.length === 0" :line="line.number" :indentation="indentation"></comment-editor>
                <comment :comment="comment" perspective="sender" :indentation="indentation" :key="comment.id" v-for="comment in relevantComments"></comment>
            </div>
        </div>
    </div>
</template>

<script>
import CommentEditor from "./CommentEditor";

import Comment from "./Comment";

export default {
    components: {Comment, CommentEditor},
    props: {
        line: {
            type: Object,
            required: true
        },
        file: {
            type: String,
            required: true
        },
        comments: {
            type: Array
        }
    },
    data() {
        return {
            isCommenting: false
        }
    },
    methods: {
        toggleComment(event) {
            if (this.relevantComments.length > 0)
                return;
            this.isCommenting = !this.isCommenting;
        }
    },
    computed: {
        indentation: function () {
            let indentation = this.line.line.match(/>(\s+)/);
            if (indentation == null)
                return 0;

            return indentation[1].length
        },
        relevantComments: function () {
            if (this.comments.length === 0)
                return [];
            return this.comments.filter(x => x.line === this.line.number);
        }
    }
}
</script>