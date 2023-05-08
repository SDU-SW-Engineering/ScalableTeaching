<template>
    <div style="height: 100vh">
        <div class="flex flex-col">
            <comparison-file-explorer
                :file-tree="tree"
                :overlapping-files="masterOverlap"
                @openFile="compareFile"
            ></comparison-file-explorer>
            <div
                class="bg-gray-900 overflow-auto"
                style="height: calc(100vh - 250px)"
            >
                <div v-if="file === null"></div>
                <code-viewer
                    :mark-lines="markLines"
                    context="view"
                    v-else
                    :file="file"
                ></code-viewer>
            </div>
        </div>
    </div>
</template>
<script>
import ComparisonFileExplorer from "./ComparisonFileExplorer.vue";
import CodeViewer from "../CodeViewer.vue";

export default {
    props: ["tree", "map", "masterOverlap", "channels"],
    components: { CodeViewer, ComparisonFileExplorer },
    data() {
        return {
            file: null,
            markLines: [],
        };
    },
    methods: {
        compareFile: async function (file, origin = null) {
            if (origin === "master") return;
            let comparisonPid = Object.keys(this.map[file])[0];
            for (let projectId in this.map[file]) {
                if (origin === projectId) continue;
                let openFile = this.map[file][projectId]["file"];
                let channel = this.channels[projectId];
                channel.$emit(
                    "openFile",
                    openFile,
                    origin == null ? "master" : origin
                );
            }
            let response = await axios.get(
                location.pathname +
                    "/details?compare_with=" +
                    comparisonPid +
                    "&file=" +
                    file
            );
            this.file = response.data;
            this.markLines = response.data.mark;
        },
    },
    mounted() {
        for (let projectId in this.channels) {
            let channel = this.channels[projectId];
            channel.$on("slaveComparison", (file, pid) =>
                this.compareFile(file, pid)
            );
        }
    },
};
</script>
