<template>
    <main>
        <div class="mb-4">
            <div v-if="!reorganizing">
                <button
                    class="bg-lime-green-400 hover:bg-lime-green-500 transition-colors items-center text-white flex p-2 rounded"
                    @click="reorganizing = true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-1">
                        <path
                            d="M11.25 5.337c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.036 1.007-1.875 2.25-1.875S15 2.34 15 3.375c0 .369-.128.713-.349 1.003-.215.283-.401.604-.401.959 0 .332.278.598.61.578 1.91-.114 3.79-.342 5.632-.676a.75.75 0 01.878.645 49.17 49.17 0 01.376 5.452.657.657 0 01-.66.664c-.354 0-.675-.186-.958-.401a1.647 1.647 0 00-1.003-.349c-1.035 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401.31 0 .557.262.534.571a48.774 48.774 0 01-.595 4.845.75.75 0 01-.61.61c-1.82.317-3.673.533-5.555.642a.58.58 0 01-.611-.581c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.035-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959a.641.641 0 01-.658.643 49.118 49.118 0 01-4.708-.36.75.75 0 01-.645-.878c.293-1.614.504-3.257.629-4.924A.53.53 0 005.337 15c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.036 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.369 0 .713.128 1.003.349.283.215.604.401.959.401a.656.656 0 00.659-.663 47.703 47.703 0 00-.31-4.82.75.75 0 01.83-.832c1.343.155 2.703.254 4.077.294a.64.64 0 00.657-.642z"/>
                    </svg>
                    <span>Reorganize</span>
                </button>
            </div>
            <div class="flex items-center justify-between" v-else>
                <button :disabled="!canOrganize" @click="newGroup"
                        class="bg-gray-500 hover:bg-gray-400 transition-colors items-center text-white flex p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-1">
                        <path fill-rule="evenodd"
                              d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                              clip-rule="evenodd"/>
                    </svg>
                    New group
                </button>
                <p v-if="error === ''" class="text-gray-500 dark:text-gray-200 text-sm text-center mx-4">Groups and tasks can now be
                    dragged around</p>
                <p v-else v-text="error" class="text-red-500 text-sm text-center mx-4"></p>
                <button @click="save" v-text="saving ? 'Saving' : 'Save Changes'"
                    class="bg-lime-green-400 hover:bg-lime-green-500 transition-colors items-center text-white flex p-2 rounded">
                </button>
            </div>
        </div>
        <draggable :disabled="!canOrganize" :list="groups" group="outer" class="grid gap-12 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            <div class="" v-for="(group, index) in groups">
                <div :class="[group.name === null ? 'bg-gray-100 border dark:bg-gray-700 dark:border-none' : 'bg-gray-200 border border-gray-300 dark:bg-gray-800 dark:border-none']" class="shadow rounded-lg p-4">
                    <div v-if="group.editing && reorganizing" class="flex items-center">
                        <input v-model="group.name" placeholder="Filter" type="text" id="name" name="name" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 rounded-l focus:outline-none block w-full text-sm p-1 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"/>
                        <button :disabled="!canOrganize" @click="group.editing = false" v-if="group.name !== null"
                                class="bg-lime-green-500 p-1 rounded-r hover:bg-lime-green-400 text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </button>
                    </div>
                    <div v-else class="flex items-center">
                        <div class="cursor-pointer flex-grow">
                            <span class="text-black dark:text-white font-lg" :key="group.name"
                                  v-text="group.name === null ? 'Ungrouped' : group.name"></span>
                        </div>
                        <button :disabled="!canOrganize" @click="group.editing = true" v-if="group.name !== null && reorganizing"
                                class="bg-gray-400 dark:bg-gray-500 mr-2 p-1 rounded hover:bg-gray-500 dark:hover:bg-gray-400 text-white dark:text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                            </svg>
                        </button>
                        <button :disabled="!canOrganize" @click="deleteGroup(index)" v-if="group.name !== null && reorganizing"
                                class="bg-red-500 p-1 rounded hover:bg-red-400 text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div v-if="!reorganizing" :class="[group.name === null ? 'bg-gray-200 dark:bg-gray-800' : 'bg-gray-300 dark:bg-gray-900']"
                         class="mt-4 py-4 px-3 rounded-md">
                        <a :href="exercise.manage" target="_blank"
                           :class="[group.name === null ? 'bg-gray-400 dark:bg-gray-600 hover:bg-gray-500 dark:hover:bg-gray-500' : 'bg-gray-400 dark:bg-gray-700 hover:bg-gray-500 dark:hover:bg-gray-600']"
                           class="flex items-center justify-between px-3 py-1.5 transition-colors rounded text-white dark:text-gray-100 mb-4 last:mb-0 cursor-pointer"
                           v-for="exercise in group.exercises">
                            <span class="text-sm" v-text="exercise.name"></span>
                            <svg v-if="exercise.visible" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="flex-shrink-0 text-lime-green-200 dark:text-lime-green-400 ml-1 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 text-lime-green-200 dark:text-lime-green-400 ml-1 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </a>
                    </div>
                    <draggable v-else :disabled="!canOrganize" :list="group.exercises"
                               :class="[group.name === null ? 'bg-gray-200 dark:bg-gray-800' : 'bg-gray-300 dark:bg-gray-900']"
                               class="mt-4 py-4 px-3 rounded-md" group="inner">
                        <div :class="[group.name === null ? 'bg-gray-400 dark:bg-gray-600' : 'bg-gray-400 dark:bg-gray-700']"
                             class="flex items-center justify-between px-3 py-1.5 rounded text-white dark:text-gray-100 mb-4 last:mb-0 cursor-pointer"
                             v-for="exercise in group.exercises">
                            <span class="text-sm" v-text="exercise.name"></span>
                            <svg v-if="exercise.visible" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="flex-shrink-0 text-lime-green-200 dark:text-lime-green-400 ml-1 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 text-lime-green-200 dark:text-lime-green-400 ml-1 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </div>
                    </draggable>
                </div>
            </div>
        </draggable>
    </main>
</template>

<script>
import draggable from "vuedraggable";

export default {
    components: {
        draggable,
    },
    props: {
        initialGroups: {
            type: Array,
            required: true
        },
        reorganizeRoute: {
            type: String,
            required: true
        }
    },
    methods: {
        deleteGroup: function (index) {
            let group = this.groups[index];
            if (group.exercises.length > 0) {
                this.error = "Only empty groups can be deleted.";
                setTimeout(() => this.error = "", 2000);
                return;
            }
            this.groups.splice(index, 1)
        },
        newGroup: function () {
            this.groups.unshift({
                name: 'New group',
                editing: false,
                exercises: []
            });
        },
        save: async function () {
            let tasks = new Map();
            this.groups.forEach(group => tasks.set(group.name, group))
            if (tasks.size !== this.groups.length) {
                this.error = "Each group must have a unique name.";
                setTimeout(() => this.error = "", 2000);
                return;
            }

            let emptyGroup = this.groups.some(x => x.exercises.length === 0)
            if (emptyGroup) {
                if (confirm("Groups without exercises won't be persisted. Do you still want to save?") !== true)
                    return;
            }

            let exercises = [];

            this.groups.forEach(group => {
                group.exercises.forEach(exercise => {
                    exercises.push({
                        id: exercise.id,
                        group: group.name
                    })
                })
            })

            this.saving = true;
            await axios.put(this.reorganizeRoute, exercises);
            this.saving = false;
            this.reorganizing = false;
        },
    },
    data() {
        return {
            reorganizing: false,
            error: "",
            saving: false,
            groups: []
        };
    },
    computed: {
        canOrganize: function() {
            return !this.saving && this.reorganizing;
        }
    },
    mounted() {
        this.groups = this.initialGroups
    }
}
</script>
