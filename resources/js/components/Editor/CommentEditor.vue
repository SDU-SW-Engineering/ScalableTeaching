<template>
    <div class="w-80 mb-2" :style="{ marginLeft: indentation + 'ch'}">
        <div class="flex flex-col shadow-md">
            <div class="bg-gray-800 rounded-t-md px-3 py-1 mt-1">
                <h2 class="text-gray-100 font-semibold">Comment</h2>
            </div>
            <div class="bg-black p-3 rounded-b-md">
                <textarea v-model="comment" rows="3" class="bg-gray-800 text-sm w-full text-white border-none rounded-md mb-2"></textarea>
                <div class="flex justify-between">
                    <button @click="cancel" class="text-white hover:bg-gray-800 border border-gray-700 px-2 py-0.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Cancel</span>
                    </button>
                    <button @click="save" :disabled="saving" class="text-white hover:bg-gray-800 border border-gray-700 px-2 py-0.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Save</span>
                    </button>
                </div>
            </div>
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
        line: {
            type: Number,
            required: true
        },
        file: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            comment: "",
            saving: false
        }
    },
    methods: {
        cancel: function() {
            this.comment = "";
            this.$emit('close');
        },
        save: async function () {
            if (this.comment.trim() === "")
                return;
            this.saving = true;
            let test = (await axios.post(location.pathname + '/comments', {
                comment: this.comment,
                line: this.line,
                file: this.file
            })).data
            this.saving = false;
            this.cancel();
        }
    }
}
</script>
