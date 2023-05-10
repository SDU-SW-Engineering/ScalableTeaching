<template>
    <div
        @click="open"
        :style="{ paddingLeft: level * 10 + 'px' }"
        :class="[
            file.changed ? 'text-yellow-300' : 'text-white',
            selected === file.full
                ? 'bg-lime-green-600 hover:bg-lime-green-800'
                : 'hover:bg-gray-800',
        ]"
        class="flex w-full cursor-pointer justify-between relative py-0.5 items-center z-10"
    >
        <div
            v-if="overlap !== null"
            class="absolute rounded-lg opacity-50 bg-gray-400"
            :style="{
                left: 0,
                right: 100 - this.overlap + '%',
                top: '2px',
                bottom: '2px',
            }"
        ></div>
        <div class="flex items-center">
            <div
                class="w-5 h-4 mr-0.5 flex-shrink-0 z-10"
                v-html="icon()"
            ></div>
            <div class="z-10">{{ file.name }}</div>
        </div>
        <div
            v-if="overlap !== null"
            class="z-10 text-sm text-blue-400 font-bold"
        >
            {{ parseFloat(this.overlap).toFixed(1) }}%
        </div>
    </div>
</template>

<script>
import { getIcon } from "material-file-icons";

export default {
    props: {
        level: {
            type: Number,
            required: true,
        },
        file: {
            type: Object,
            required: true,
        },
        selected: {
            type: String,
            default: null,
        },
        overlappingFiles: {
            type: Object,
            default: {},
        },
    },
    computed: {
        overlap: function () {
            let found = Object.keys(this.overlappingFiles).includes(
                this.file.full
            );
            if (found === false) return null;

            let overlap = this.overlappingFiles[this.file.full];
            return overlap[0]["overlap"] * 100;
        },
    },
    methods: {
        icon: function () {
            return getIcon(this.file.name).svg;
        },
        open: function () {
            this.$emit("open", this.file.full);
        },
    },
};
</script>
