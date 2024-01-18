<template>
    <div>
        <div
            class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800">
            <h2 class="dark:text-white font-semibold text-2xl">Settings</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div v-if="project.ownable_type === 'App\\Models\\Group' && this.isCodeTask">
                    <div class="border-2 rounded-xl p-4 mt-6 border-lime-green-400 relative">
                        <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2">Repository
                            Access</h3>
                        <p class="text-gray-600 dark:text-gray-100">Re-invites missing people to the project and removes
                            people that shouldn't have access.</p>
                        <button :disabled="refresh.loading" @click="refreshProject"
                                v-text="refresh.loading ? 'Refreshing...' : 'Refresh Access'"
                                class="py-1 px-2 font-semibold rounded transition-colors text-sm mt-2 bg-lime-green-600 text-white hover:bg-lime-green-500">
                        </button>
                    </div>
                </div>
                <div>
                    <div class="border-2 rounded-xl p-4 mt-6 border-lime-green-400 relative">
                        <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2">Start
                            over</h3>
                        <p class="text-gray-600 dark:text-gray-100">If you wish, you can delete your project here.
                            Please
                            note that this will erase the repository, and you will lose all commits made to it.</p>
                        <button @click="showResetWarning = true" :disabled="project.status === 'finished'"
                                :class="[project.status === 'finished' || project.status === 'overdue' ? 'cursor-not-allowed bg-gray-200 text-gray-400 dark:bg-gray-600' : 'bg-red-600 text-white hover:bg-red-500']"
                                class="py-1 px-2 font-semibold rounded transition-colors text-sm mt-2">Delete Project
                        </button>
                        <p v-if="project.status === 'finished' || project.status === 'overdue'"
                           class="text-red-600 font-semibold dark:text-red-500 text-xs mt-1">A finished project cannot
                            be
                            reset.</p>
                    </div>
                </div>
                <div v-if="project.ownable_type === 'App\\Models\\User' && this.isCodeTask">
                    <div class="border-2 rounded-xl p-4 mt-6 border-lime-green-400 relative">
                        <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2">Migrate to
                            group</h3>
                        <p class="text-gray-600 dark:text-gray-100">Move your project to one of your groups here. This
                            action will fail if the group or any of the members have already started the same
                            project.</p>
                        <div class="flex items-center mt-4 mb-2">
                            <span class="text-sm mr-1 dark:text-gray-200">Group:</span>
                            <select v-model="migrate.group"
                                    class="bg-gray-100 dark:bg-gray-600 border-gray-300 text-gray-900 dark:text-gray-200 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                                <option :key="id" :value="id" v-for="(group, id) in groups"
                                        v-text="group"></option>
                            </select>
                        </div>
                        <tippy v-if="migrate.group == null" to="btnMigrate">Please select a group first.</tippy>
                        <button name="btnMigrate" @click="migrateProject"
                                :class="[migrate.group == null ? 'cursor-not-allowed bg-gray-200 text-gray-400 dark:bg-gray-600' : 'bg-red-600 text-white hover:bg-red-500']"
                                class="py-1 px-2 font-semibold rounded transition-colors text-sm mt-2">Migrate Project
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <alert type="danger" title="Delete project" :url="'/projects/' + project.id + '/reset'"
               confirm-button-text="Delete Project"
               content="Resetting your project cannot be undone. Be certain that this what you want to do before confirming."
               v-if="showResetWarning" @cancel="showResetWarning=false"></alert>
        <alert type="danger" title="Migrate to group" method="post"
               :url="'/projects/' + project.id + '/migrate/' + migrate.group"
               confirm-button-text="Migrate Project"
               content="Migrating your project cannot be undone. Be certain that this what you want to do before confirming."
               v-if="migrate.showConfirm" @cancel="migrate.showConfirm=false"></alert>
    </div>
</template>

<script>
import Alert from "../../Alert";
import GroupBox from "../../GroupBox";

export default {
    components: {GroupBox, Alert},
    props: ['project', 'groups', 'isCodeTask'],
    data: function () {
        return {
            showResetWarning: false,
            migrate: {
                group: null,
                showConfirm: false
            },
            refresh: {
                loading: false
            }
        }
    },
    methods: {
        migrateProject: function() {
            if (this.migrate.group == null)
                return;
            this.migrate.showConfirm = true;
        },
        refreshProject: async function() {
            this.refresh.loading = true;
            await axios.post('/projects/' + this.project.id + '/refresh-access', {
                csrf: this.csrf
            })
            location.reload();
        }
    },
    mounted() {
        console.log(this.project.ownable_type === "App\\Models\\Group")
    }
}
</script>
