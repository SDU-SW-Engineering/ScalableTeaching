<template>
    <div class="w-80 mb-1 rounded-md flex flex-col" :style="{ marginLeft: indentation + 'ch'}">
        <div class="flex justify-between items-center bg-black rounded-t-md p-2 text-white border border-gray-600">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     style=";transform: ;msFilter:;">
                    <path
                        d="M20.309 17.708C22.196 15.66 22.006 13.03 22 13V5a1 1 0 0 0-1-1h-6c-1.103 0-2 .897-2 2v7a1 1 0 0 0 1 1h3.078a2.89 2.89 0 0 1-.429 1.396c-.508.801-1.465 1.348-2.846 1.624l-.803.16V20h1c2.783 0 4.906-.771 6.309-2.292zm-11.007 0C11.19 15.66 10.999 13.03 10.993 13V5a1 1 0 0 0-1-1h-6c-1.103 0-2 .897-2 2v7a1 1 0 0 0 1 1h3.078a2.89 2.89 0 0 1-.429 1.396c-.508.801-1.465 1.348-2.846 1.624l-.803.16V20h1c2.783 0 4.906-.771 6.309-2.292z"></path>
                </svg>
                <span class="text-sm">Comment</span>
            </div>
            <span class="text-gray-500 text-xs" v-text="comment.time_since"></span>
        </div>
        <div class="flex p-2 border-b border-r border-l border-gray-600 bg-black">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-7 h-7 flex-shrink-0 text-gray-400 mr-2">
                <path fill-rule="evenodd"
                      d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                      clip-rule="evenodd"/>
            </svg>
            <div class="bg-gray-700 rounded-md p-1.5 w-full text-gray-200 text-sm">
                <span v-text="comment.comment"></span>
            </div>
        </div>
        <div class="flex bg-black rounded-b-md border-b border-r border-l border-gray-600">
            <button @click="edit" v-if="perspective === 'sender'"
                    class="w-full flex flex-col items-center py-2 first:rounded-bl-md hover:bg-gray-900">
                <div class="h-5 w-5 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-gray-300 w-4 h-4">
                        <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                    </svg>
                </div>
                <span class="text-xs text-gray-400 font-thin mt-1">Edit</span>
            </button>
            <button @click="remove" v-if="perspective === 'sender'"
                    class="w-full flex flex-col items-center py-2 first:rounded-bl-md hover:bg-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-gray-300 w-5 h-5">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs text-gray-400 font-thin mt-1">Delete</span>
            </button>
            <button v-if="perspective === 'recipient'"
                    class="w-full flex flex-col items-center py-2 last:rounded-br-md hover:bg-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="text-gray-300 w-5 h-5">
                    <path
                        d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z"/>
                </svg>
                <span class="text-xs text-gray-400 font-thin mt-1">Helpful</span>
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        indentation: {
            type: Number,
            required: true
        },
        perspective: {
            type: String,
            required: true
        },
        comment: {
            type: Object,
            required: true
        }
    },
    methods: {
        remove: async function () {
            await axios.delete(location.pathname + '/comments/' + this.comment.id);
            this.$emit('delete')
        },
        edit: function() {
            this.$emit('edit', this.comment)
        }
    }
}
</script>
