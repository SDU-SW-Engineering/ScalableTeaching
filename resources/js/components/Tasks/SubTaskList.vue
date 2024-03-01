<template>
    <div>
        <div class="flex w-full flex-col justify-center items-center">
            <span class="font-bold text-4xl">{{ total }}</span>
            <span class="font-thin text-xl">Total possible points</span>
            <button
                @click="saveChanges()"
                :disabled="total === 0"
                :class="[total === 0 ? 'disabled-btn' : 'active-btn', 'flex items-center my-4']"
            >
                <svg
                    v-if="saving"
                    class="animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                </svg>
                <svg
                    v-if="!saving"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 mr-1.5 text-white"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13.5l6.75 6.75L21 4.5"
                    />
                </svg>
                <span v-if="!saving" class="text-white">Save changes</span>
            </button>
            <transition name="slide">
                <span class="dark:text-white mb-2" v-if="saved"
                    >Changes saved</span
                >
            </transition>
        </div>
        <div
            @click="newGroup(false)"
            class="dark:bg-gray-600 opacity-60 bg-gray-200 hover:opacity-100 flex justify-between items-center px-4 py-2 mb-2 rounded-md transition-opacity cursor-pointer"
        >
            <span class="dark:text-white">Create Group</span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7 text-lime-green-400"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
        <div
            v-for="group in groups"
            class="dark:bg-gray-600 flex flex-col bg-white border shadow px-2 py-2 rounded-md mb-4"
        >
            <div class="flex justify-between items-start w-full mb-2">
                <input
                    v-model="group.name"
                    placeholder="Group name..."
                    class="bg-gray-200 font-bold border-none rounded w-96 text-black"
                    type="text"
                />
                <span class="font-thin text-lg text-lime-green-600"
                    >{{ groupPoints(group) }} pts</span
                >
            </div>
            <div class="grid w-full grid-cols-1 gap-1">
                <div
                    v-for="task in group.tasks"
                    class="flex group justify-between items-center border-b border-black dark:bg-gray-700 px-0.5 py-0.5 text-white break-all"
                >
                    <input
                        type="text"
                        placeholder="Some subtask..."
                        class="bg-gray-200 border-none rounded text-black w-1/2 p-0.5 text-sm"
                        v-model="task.name"
                    />
                    <div class="w-1/2 flex items-center gap-4 justify-end">
                        <button
                            @click.stop="deleteTask(group, task)"
                            class="hover:text-red-800 hidden group-hover:block text-red-700 rounded-sm"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                        <div>
                            <input
                                type="number"
                                min="1"
                                class="text p-0 text-right text-lime-green-400 w-20 border-none"
                                v-model="task.points"
                            />
                            <span
                                class="text-center flex-shrink-0 text-lg font-bold text-lime-green-300"
                            >
                                pts
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    @click="newTask(group)"
                    class="flex cursor-pointer opacity-60 mt-1 hover:opacity-100 transition-opacity items-center justify-center flex-col bg-gray-200 px-1 py-1 text-white break-all rounded-md"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-lime-green-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
            </div>
        </div>
        <div
            @click="newGroup()"
            class="dark:bg-gray-600 opacity-60 bg-gray-200 hover:opacity-100 flex justify-between items-center px-4 py-2 mt-2 rounded-md transition-opacity cursor-pointer"
        >
            <span class="dark:text-white">Create Group</span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7 text-lime-green-400"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true,
        },
        subTasks: {
            type: Array,
            required: true,
        },
    },
    methods: {
        newTask: function (group) {
            group.tasks.push({
                id: null,
                name: "",
                points: 0,
            });
        },
        newGroup: function (after = true) {
            if (after === false) {
                this.groups.unshift({
                    name: "",
                    tasks: [],
                });
                return;
            }
            this.groups.push({
                name: "",
                tasks: [],
            });
        },
        deleteTask: function (group, task) {
            group.tasks = group.tasks.filter((t) => t.name !== task.name);
        },
        groupPoints: function (group) {
            return group.tasks
                .map((t) => Number(t.points))
                .reduce((a, b) => a + b, 0);
        },
        saveChanges: async function () {
            this.saving = true;
            let groups = this.groups.filter((x) => x.name.trim() !== "");
            let finalGroups = [];
            for (let group of groups) {
                let currentGroup = structuredClone(group);
                currentGroup.tasks = currentGroup.tasks.filter(
                    (x) => x.name !== ""
                );
                finalGroups.push(currentGroup);
            }
            try {
                await axios.post(
                    `/courses/${this.task.course_id}/tasks/${this.task.id}/admin/modules/subtasks`,
                    finalGroups
                );
                this.changed = false;
                this.saved = true;
            } catch (e) {
                alert(e.response.data.message);
            } finally {
                this.saving = false;
                setTimeout(() => (this.saved = false), 4000);
            }
        },
        preventNav(e) {
            if (!this.changed) return;
            e.preventDefault();
            e.returnValue = "";
        },
    },
    data() {
        return {
            groups: [],
            changed: false,
            saving: false,
            saved: false,
        };
    },
    computed: {
        total: function () {
            return this.groups.reduce(
                (acc, current) => this.groupPoints(current) + acc,
                0
            );
        },
    },
    watch: {
        groups: {
            deep: true,
            handler: function (after, before) {
                if (before.length === 0) {
                    this.changed = false;
                    return;
                }
                this.changed = true;
            },
        },
    },
    mounted() {
        this.groups = this.subTasks;
    },
    beforeMount() {
        window.addEventListener("beforeunload", this.preventNav);
    },
};
</script>
