<template>
    <div>
        <div
            style="
                height: 54px;
                grid-template-columns: 12fr 15fr 2fr 12fr;
                gap: 1px;
            "
            class="grid bg-lime-green-500"
        >
            <div class="text-white pl-4 items-center font-bold flex">
                <select
                    class="text-white bg-lime-green-600 rounded-md"
                    v-model="from"
                    @change="redirect"
                >
                    <option :value="from.id" v-for="from in fromCompared">
                        {{ from.name }} ({{
                            parseFloat(from.overlap * 100).toFixed(1)
                        }})
                    </option>
                </select>
            </div>
            <div class="flex items-center justify-center">
                <select
                    class="rounded-md bg-gray-800 text-white"
                    @change="showDropdownFile"
                    v-model="selectedFile"
                    style="text-align-last: center"
                >
                    <option disabled selected :value="null">
                        -- Inspect overlap --
                    </option>
                    <option :value="index" v-for="(option, index) in dropdown">
                        {{ option.from }} - {{ option.to }} ({{
                            parseFloat(option.overlap * 100).toFixed(1)
                        }}%)
                    </option>
                </select>
            </div>
            <div class="flex justify-center items-center text-red-600">
                <button
                    @click="markSuspicion"
                    class="p-2 h-10 rounded-md hover:bg-lime-green-600"
                >
                    <svg
                        v-if="!isSuspicious"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"
                        />
                    </svg>
                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M11.484 2.17a.75.75 0 011.032 0 11.209 11.209 0 007.877 3.08.75.75 0 01.722.515 12.74 12.74 0 01.635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 01-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 01.722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zM12 15a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75v-.008a.75.75 0 00-.75-.75H12z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>
            <div
                class="flex items-center justify-end text-white font-bold pr-4"
            >
                <select
                    class="text-white bg-lime-green-600 rounded-md"
                    v-model="to"
                    @change="redirectTo"
                >
                    <option :value="to.id" v-for="to in toCompared">
                        {{ to.name }} ({{
                            parseFloat(to.overlap * 100).toFixed(1)
                        }})
                    </option>
                </select>
            </div>
        </div>
        <div
            class="gap-1"
            :style="{
                display: 'grid',
                height: 'calc(100vh - 304px)',
                gridTemplateColumns: columns,
            }"
        >
            <master-view
                :tree="tree"
                :overlap="dropdown"
                :channels="channels"
            ></master-view>
            <slave-view
                v-for="(tree, projectId) in trees"
                :tree="tree"
                :project-id="projectId"
                :channel="channels[projectId]"
                :overlap="dropdown"
                :key="projectId"
                :master-id="fromId"
            />
        </div>
    </div>
</template>

<script>
import ComparisonFileExplorer from "./ComparisonFileExplorer.vue";
import MasterView from "./MasterView.vue";
import Vue from "vue";
import SlaveView from "./SlaveView.vue";

export default {
    props: [
        "tree",
        "trees",
        "fromId",
        "toId",
        "nameMap",
        "dropdown",
        "fromCompared",
        "toCompared",
        "markRoute",
        "isSuspicious",
    ],
    components: { SlaveView, MasterView, ComparisonFileExplorer },
    data() {
        return {
            channels: {},
            selectedFile: null,
            from: this.fromId,
            to: this.toId,
        };
    },
    methods: {
        showDropdownFile: function () {
            let channel = this.channels[Object.keys(this.channels)[0]];
            let selected = this.dropdown[this.selectedFile];
            channel.$emit("slaveComparison", selected.from, null, selected.to);
        },
        redirect: function () {
            let found = this.fromCompared.find((x) => this.from === x.id);
            window.location = found.route;
        },
        redirectTo: function () {
            let found = this.toCompared.find((x) => this.to === x.id);
            window.location = found.route;
        },
        markSuspicion: async function () {
            await axios.get(this.markRoute + "?to=" + this.toId);
            this.isSuspicious = !this.isSuspicious;
        },
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
