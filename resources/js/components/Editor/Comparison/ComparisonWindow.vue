<template>
    <div
        class="gap-1"
        :style="{
            display: 'grid',
            height: '100vh',
            gridTemplateColumns: columns,
        }"
    >
        <master-view
            :master-overlap="master"
            :tree="tree"
            :map="map"
            :channels="channels"
        ></master-view>
        <slave-view
            v-for="(tree, projectId) in trees"
            :tree="tree"
            :project-id="projectId"
            :channel="channels[projectId]"
            :overlap="projectMap[projectId]"
            :key="projectId"
            :master-id="fromId"
        />
    </div>
</template>

<script>
import ComparisonFileExplorer from "./ComparisonFileExplorer.vue";
import MasterView from "./MasterView.vue";
import Vue from "vue";
import SlaveView from "./SlaveView.vue";

export default {
    props: ["tree", "trees", "map", "projectMap", "master", "fromId"],
    components: { SlaveView, MasterView, ComparisonFileExplorer },
    data() {
        return {
            channels: {},
        };
    },
    computed: {
        columns: function () {
            let columns = [];
            for (let i = 0; i < Object.keys(this.trees).length + 1; i++)
                columns.push("1fr");
            return columns.join(" ");
        },
    },
    beforeMount() {
        for (let projectId of Object.keys(this.trees)) {
            this.channels[projectId] = new Vue();
        }
    },
};
</script>
