<template>
    <div style="height: calc(100vh - 304px)">
        <div class="flex flex-col">
            <comparison-file-explorer
                :file-tree="tree"
                :overlapping-files="overlaps"
                @openFile="(path, against) => compareFile(path, null, against)"
                :selected="file != null ? file.full : null"
            ></comparison-file-explorer>
            <div
                class="bg-gray-900 overflow-auto"
                style="height: calc(100vh - 304px)"
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
import axios from "axios";

export default {
    props: ["tree", "channels", "overlap"],
    components: { CodeViewer, ComparisonFileExplorer },
    data() {
        return {
            file: null,
            markLines: [],
        };
    },
    methods: {
        compareFile: async function (file, origin = null, against = null) {
            if (!Object.keys(this.overlaps).includes(file)) {
                // file is no a comparison file
                Object.keys(this.channels).forEach((pid) => {
                    if (pid === origin) return;
                    this.channels[pid].$emit(
                        "openFile",
                        file,
                        false,
                        origin == null ? "master" : origin
                    );
                });
                let response = await axios.get(
                    location.pathname + "/details?file=" + file
                );
                this.file = response.data;
                this.markLines = [];
                return;
            }
            let comparisonPid = Object.keys(this.channels)[0];
            for (let projectId in this.channels) {
                let channel = this.channels[projectId];
                channel.$emit(
                    "openFile",
                    against,
                    origin == null ? "master" : origin,
                    file
                );
            }
            let response = await axios.get(
                location.pathname +
                    "/details?compare_with=" +
                    comparisonPid +
                    "&file=" +
                    file +
                    "&against=" +
                    against
            );
            this.file = response.data;
            this.markLines = response.data.mark;
        },
    },
    computed: {
        overlaps: function () {
            let from = {};
            for (let comparison of this.overlap) {
                if (!from.hasOwnProperty(comparison.from)) {
                    from[comparison.from] = [];
                }
                from[comparison.from].push({
                    file: comparison.to,
                    overlap: comparison.overlap,
                });
            }
            return from;
        },
    },
    mounted() {
        for (let projectId in this.channels) {
            let channel = this.channels[projectId];
            channel.$on("slaveComparison", (file, pid, against) => {
                this.compareFile(file, pid, against);
            });
        }
    },
};
</script>
