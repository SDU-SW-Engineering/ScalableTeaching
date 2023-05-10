<template>
    <div style="height: calc(100vh - 304px)">
        <div class="flex flex-col">
            <comparison-file-explorer
                @openFile="(path, against) => openFile(path, null, against)"
                :overlappingFiles="overlaps"
                :file-tree="tree"
                :selected="file != null ? file.full : null"
            />
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
    props: ["tree", "channel", "overlap", "projectId", "masterId"],
    components: { CodeViewer, ComparisonFileExplorer },
    data() {
        return {
            file: null,
            markLines: [],
        };
    },
    methods: {
        openFile: async function (file, origin, against) {
            let segments = location.pathname.split("/");
            let url = segments.slice(0, segments.length - 1).join("/");
            if (origin === this.projectId) return;
            if (!Object.keys(this.overlaps).includes(file)) {
                if (origin == null) {
                    this.channel.$emit(
                        "slaveComparison",
                        file,
                        this.projectId,
                        null
                    );
                }
                let response = await axios.get(
                    url + "/" + this.projectId + "/details" + "?file=" + file
                );
                this.file = response.data;
                this.markLines = [];

                return;
            }
            let response = await axios.get(
                url +
                    "/" +
                    this.projectId +
                    "/details?compare_with=" +
                    this.masterId +
                    "&file=" +
                    file +
                    "&against=" +
                    against
            );
            this.file = response.data;
            this.markLines = response.data.mark;
            if (origin === "master") return;

            this.channel.$emit(
                "slaveComparison",
                against,
                this.projectId,
                file
            );
        },
    },
    computed: {
        overlaps: function () {
            let to = {};
            for (let comparison of this.overlap) {
                if (!to.hasOwnProperty(comparison.to)) {
                    to[comparison.to] = [];
                }
                to[comparison.to].push({
                    file: comparison.from,
                    overlap: comparison.overlap,
                });
            }
            return to;
        },
    },
    mounted() {
        this.channel.$on("openFile", this.openFile);
    },
};
</script>
