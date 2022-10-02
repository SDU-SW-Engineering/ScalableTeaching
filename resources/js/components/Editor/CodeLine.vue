<template>
    <div>
        <div @click="isCommenting = !isCommenting" class="flex cursor-pointer hover:bg-gray-700 group">
            <div :class="[isCommenting ? 'items-start' : 'items-center']"
                 class="w-14 justify-end flex-shrink-0 mr-4 flex">
                <div class="flex items-center">
                    <span class="dark:text-gray-400 select-none" v-text="line.number"></span>
                    <div class="w-4 h-4 ml-1">
                        <svg v-if="isCommenting" class="text-lime-green-400 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             style="transform: ;msFilter:;">
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path>
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg"
                             class="hidden group-hover:block text-lime-green-400 w-4 h-4 fill-current"
                             viewBox="0 0 24 24" style="transform: ;msFilter:;">
                            <path
                                d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-3 9h-4v4h-2v-4H7V9h4V5h2v4h4v2z"></path>
                        </svg>

                    </div>
                </div>
            </div>
            <div>
                <span v-html="line.line"></span>
                <div :style="{ marginLeft: indentation + 'ch'}" v-if="isCommenting">
                    <div class="flex w-92 flex-col">
                        <div class="bg-gray-800 rounded-t-md px-3 py-1 mt-1">
                            <h2 class="text-gray-100 font-semibold">Comment</h2>
                        </div>
                        <div class="bg-black p-3  items-start">
                            <textarea class="bg-gray-800 border-none"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        line: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isCommenting: false
        }
    },
    computed: {
        indentation: function () {
            let indentation = this.line.line.match(/>(\s+)/);
            if (indentation == null)
                return 0;

            return indentation[1].length
        }
    }
}
</script>
