<template>
    <div class="whitespace-pre-wrap">
        <code-line
            :context="context"
            @commentCreated="refreshComments"
            @commentDeleted="refreshComments"
            :comments="comments"
            :file="file.full"
            :line="line"
            :key="line.number + file.full"
            v-for="line in file.lines"
            :is-marked="isMarked(line.number)"
        ></code-line>
    </div>
</template>

<script>
import CodeLine from "./CodeLine";
import axios from "axios";

let request = "";

export default {
    components: { CodeLine },
    props: {
        file: {
            type: Object,
            required: true,
        },
        scrollTo: {
            type: Number,
            default: null,
        },
        context: {
            type: String,
            required: true,
        },
        markLines: {
            type: Array,
            default() {
                return [];
            },
        },
    },
    data() {
        return {
            comments: [],
        };
    },
    methods: {
        isMarked: function (line) {
            for (let range of this.markLines) {
                if (line >= range[0] && line <= range[1]) return true;
            }
            return false;
        },
        async refreshComments() {
            this.comments = (
                await axios.get(location.pathname + "/comments", {
                    params: {
                        file: this.file.full,
                    },
                })
            ).data;
            if (this.scrollTo == null) return;
            await new Promise((r) => setTimeout(r, 100));
            await document
                .getElementById("line-" + this.scrollTo)
                .scrollIntoView();
        },
    },
    watch: {
        file: {
            immediate: true,
            async handler(to, from) {
                this.comments = [];
                if (this.context === "view") return;
                await this.refreshComments();
            },
        },
    },
};
</script>

<style scoped>
div {
    font-family: "Fira Code";
}

@font-face {
    font-family: "Fira Code";
    src: url("/fonts/woff2/FiraCode-Light.woff2") format("woff2"),
        url("/fonts/woff/FiraCode-Light.woff") format("woff");
    font-weight: 300;
    font-style: normal;
}

@font-face {
    font-family: "Fira Code";
    src: url("/fonts/woff2/FiraCode-Regular.woff2") format("woff2"),
        url("/fonts/woff/FiraCode-Regular.woff") format("woff");
    font-weight: 400;
    font-style: normal;
}

@font-face {
    font-family: "Fira Code";
    src: url("/fonts/woff2/FiraCode-Medium.woff2") format("woff2"),
        url("/fonts/woff/FiraCode-Medium.woff") format("woff");
    font-weight: 500;
    font-style: normal;
}

@font-face {
    font-family: "Fira Code";
    src: url("/fonts/woff2/FiraCode-SemiBold.woff2") format("woff2"),
        url("/fonts/woff/FiraCode-SemiBold.woff") format("woff");
    font-weight: 600;
    font-style: normal;
}

@font-face {
    font-family: "Fira Code";
    src: url("/fonts/woff2/FiraCode-Bold.woff2") format("woff2"),
        url("/fonts/woff/FiraCode-Bold.woff") format("woff");
    font-weight: 700;
    font-style: normal;
}

@font-face {
    font-family: "Fira Code VF";
    src: url("/fonts/woff2/FiraCode-VF.woff2") format("woff2-variations"),
        url("/fonts/woff/FiraCode-VF.woff") format("woff-variations");
    /* font-weight requires a range: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Fonts/Variable_Fonts_Guide#Using_a_variable_font_font-face_changes */
    font-weight: 300 700;
    font-style: normal;
}
</style>
