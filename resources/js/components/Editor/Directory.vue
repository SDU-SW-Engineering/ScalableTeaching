<template>
    <div>
        <div
            :style="{ paddingLeft: level * 10 + 'px' }"
            @click="isOpen = !isOpen"
            :class="[directory.changed ? 'text-yellow-300' : 'text-white']"
            class="flex cursor-pointer py-0.5 items-center hover:bg-gray-800"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                :style="{
                    transform: 'rotate(' + (isOpen ? 0.25 : 0) + 'turn)',
                }"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="transition-transform w-5 h-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
            </svg>
            {{ directory.name }}
        </div>
        <directory
            :overlapping-files="overlappingFiles"
            @open="open"
            :level="level + 1"
            v-if="isOpen"
            :directory="directory"
            v-for="directory in directory.directories"
        ></directory>
        <file
            :overlapping-files="overlappingFiles"
            @open="open"
            v-if="isOpen"
            :level="level + 1"
            :file="file"
            v-for="file in directory.files"
        ></file>
    </div>
</template>

<script>
import File from "./File";
export default {
    components: { File },
    props: {
        directory: {
            type: Object,
            required: true,
        },
        level: {
            type: Number,
            default: 0,
        },
        overlappingFiles: {
            type: Object,
            default: {},
        },
    },
    methods: {
        open: function (file) {
            this.$emit("open", file);
        },
    },
    data() {
        return {
            isOpen: false,
        };
    },
};
</script>
