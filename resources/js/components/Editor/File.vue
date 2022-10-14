<template>
    <div @click="open" :style="{ paddingLeft: level * 10 + 'px'}"
         :class="[file.changed ? 'text-yellow-300' : 'text-white']"
         class="flex w-full cursor-pointer py-0.5 items-center hover:bg-gray-800">
        <div class="w-5 h-4 mr-0.5 flex-shrink-0" v-html="icon()"></div>
        <div>{{ file.name }}</div>
    </div>
</template>

<script>
import {getIcon} from "material-file-icons";

export default {
    props: {
        level: {
            type: Number,
            required: true
        },
        file: {
            type: Object,
            required: true
        }
    },
    methods: {
        icon: function () {
            return getIcon(this.file.name).svg;
        },
        open: function() {
            this.$emit('open', this.file.full);
        }
    },
}
</script>
