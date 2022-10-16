<template>
    <div v-if="comment != null" class="flex flex-col mb-4">
        <div class="flex justify-between rounded-t-md bg-white dark:bg-gray-900 dark:border-none border-t border-r border-l px-3 pt-3">
            <h2 class="text-sm dark:text-white font-medium" v-text="file == null ? 'General feedback' : file"></h2>
            <h2 class="text-sm text-gray-500 dark:text-gray-400">Project: <i>{{ comment.owner }}</i></h2>
        </div>
        <div class="p-3 border-l border-r bg-white dark:bg-gray-900 dark:border-none">
            <div v-if="comment.line != null" class="whitespace-nowrap bg-gray-800 flex flex-col p-4 rounded-t">
                <div v-for="line in comment.code" class="flex"
                     :class="[line.number === comment.line ? 'bg-gray-700':'']">
                    <div class="w-10 select-none text-white font-medium text-left text-sm">{{ line.number }}</div>
                    <div>
                        <div class="whitespace-pre-wrap text-sm" v-html="line.line"></div>
                        <div v-if="line.number === comment.line" class="flex text-sm">
                            <div class="whitespace-pre" v-text="' '.repeat(indentation)"></div>
                            <div v-if="line.number === comment.line"
                                 class="bg-white dark:bg-gray-800 flex flex-col p-2 rounded w-72 text-sm whitespace-normal mb-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full mr-1" alt="avatar" :src="comment.feedback.user.avatar"/>
                                    <span class="font-medium dark:text-white">{{ comment.feedback.user.name }}:</span>
                                </div>
                                <span class="italic bg-gray-200 dark:text-gray-300 dark:bg-gray-700 p-1 rounded my-1" v-text="comment.comment"></span>
                                <span class="text-xs font-bold dark:text-gray-200">{{ comment.time_since }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else
                 class="bg-white dark:bg-gray-800 flex flex-col p-2 rounded text-sm whitespace-normal mb-2">
                <div class="flex items-center">
                    <img class="h-6 w-6 rounded-full mr-1" alt="avatar" :src="comment.feedback.user.avatar"/>
                    <span class="font-medium dark:text-white">{{ comment.feedback.user.name }}:</span>
                </div>
                <span class="italic bg-gray-200 dark:text-gray-300 dark:bg-gray-700 p-1 rounded my-1" v-text="comment.comment"></span>
                <span class="text-xs font-bold dark:text-gray-200">{{ comment.time_since }}</span>
            </div>
            <button v-if="comment.line != null" class="bg-gray-300 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm w-full h-8 hover:bg-gray-400 dark:hover:bg-gray-600 hover:text-gray-700 dark:hover:text-gray-300 transition-colors  rounded-b">
                Show entire file
            </button>
        </div>
        <div class="text-center bg-white dark:text-white dark:bg-gray-900 w-full text-sm rounded-b border-b border-l border-r py-2 dark:border-none">
            Actions To be implemented
        </div>
    </div>
</template>

<script>
export default {
    props: {
        commentId: {
            required: true,
            type: Number
        }
    },
    data() {
        return {
            comment: null
        }
    },
    computed: {
        indentation: function () {
            if (this.comment == null)
                return 0;

            if (this.comment.code == null)
                return 0;

            let comment = this.comment.code.filter(line => line.number === this.comment.line)[0];
            let indentation = comment.line.match(/>(\s+)/);
            return indentation[0].length - 1;
        },
        file: function() {
            if (this.comment == null)
                return "";
            if (this.comment.filename == null)
                return null;
            let parts = this.comment.filename.split('/');
            return parts.splice(1, parts.length).join("/");
        }
    },
    async mounted() {
        this.comment = (await axios.get(location.pathname + '/comments/' + this.commentId)).data;
    }
}
</script>
