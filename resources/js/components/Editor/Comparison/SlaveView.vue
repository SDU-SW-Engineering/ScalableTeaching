<template>
    <div style="height: 100vh">
        <div class="flex flex-col">
            <comparison-file-explorer
                @openFile="openFile"
                :overlappingFiles="overlap"
                :file-tree="tree"
            />
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
    props: ["tree", "channel", "overlap", "projectId", "masterId"],
    components: { CodeViewer, ComparisonFileExplorer },
    data() {
        return {
            file: null,
            markLines: [],
        };
    },
    methods: {
        openFile: async function (file, origin) {
            let segements = location.pathname.split("/");
            let url = segements.slice(0, segements.length - 1).join("/");
            let response = await axios.get(
                url +
                    "/" +
                    this.projectId +
                    "/details?compare_with=" +
                    this.masterId +
                    "&file=" +
                    file
            );
            this.file = response.data;
            this.markLines = response.data.mark;
            if (origin === "master") return;

            //console.log(file, "slave");
            this.channel.$emit(
                "slaveComparison",
                this.overlap[file].file,
                this.projectId
            );
        },
    },
    mounted() {
        this.channel.$on("openFile", this.openFile);
    },
};
</script>
