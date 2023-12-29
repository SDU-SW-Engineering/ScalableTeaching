<template>
    <div class="row-start-2 lg:col-start-1 xl:col-span-2 2xl:col-span-3">
        <alert method="post" :csrf="csrf" :url="group.leaveRoute" @cancel="showLeaveDialog = false"
               v-if="group.canLeave.allowed && showLeaveDialog" type="danger"
               title="Leave Group" content="You will need a new invite to rejoin the group later on."
               confirm-button-text="Leave Group"></alert>
        <alert method="delete" :csrf="csrf" :url="group.deleteRoute" @cancel="showDeleteDialog = false"
               v-if="group.canDelete.allowed && showDeleteDialog" type="danger" title="Delete Group"
               content="Are you sure you wish to delete this group? This action cannot be undone."
               confirm-button-text="Delete Group"></alert>
        <section
            class="rounded-xl bg-white dark:bg-gray-600 px-4 sm:px-6 lg:px-4 xl:px-6 pt-4 pb-4 sm:pb-6 lg:pb-4 xl:pb-6 space-y-4 shadow-lg">
            <header class="flex items-center justify-between">
                <button @click="$emit('close')"
                        class="hover:bg-gray-200 hover:text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-white dark:hover:text-white group flex items-center rounded-md bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="dark:text-white text-gray-600 mr-2 h-4 w-4"
                         fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back
                </button>
                <div class="flex">
                    <tippy to="btnCanDelete" placement="bottom"
                           v-if="!group.canDelete.allowed && group.canDelete.message != null">
                        {{ group.canDelete.message }}
                    </tippy>
                    <button @click="showDeleteDialog = true" name="btnCanDelete"
                            :class="[group.canDelete.allowed ? 'hover:bg-red-200 hover:text-red-800' : 'opacity-50 cursor-not-allowed']"
                            class="mr-2 group flex items-center rounded-md bg-red-100 text-red-700 text-sm font-medium px-4 py-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 mr-2 h-4 w-4 h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                    <tippy to="leaveGroup" placement="bottom"
                           v-if="!group.canLeave.allowed && group.canLeave.message != null">
                        {{ group.canLeave.message }}
                    </tippy>
                    <button @click="showLeaveDialog = true" name="leaveGroup"
                            :class="[group.canLeave.allowed ? 'hover:bg-red-200 hover:text-red-800' : 'opacity-50 cursor-not-allowed']"
                            class="group flex items-center rounded-md bg-red-100 text-red-700 text-sm font-medium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="text-red-600 mr-2 h-4 w-4 h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Leave
                    </button>
                </div>
            </header>
            <h1 class="text-xl font-medium text-black dark:text-white">{{ group.name }}</h1>
            <div class="grid md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-5">
                <div>
                    <h2 class="text-lg dark:text-gray-200">Members <span
                        class="text-gray-400 dark:text-gray-300">({{ group.users.length }}/{{
                            group.memberCap
                        }})</span></h2>
                    <div class="mt-2">
                        <member @remove="removeUserFromGroup(user)" :key="user.id" :is-you="user.isYou"
                                :is-owner="group.isOwner"
                                :can-remove="group.isOwner" v-for="user in group.users" :name="user.name"></member>
                        <member @remove="removeInvitation(invitation)" :key="invitation.id" :can-remove="group.isOwner"
                                v-for="invitation in group.invitations" :name="invitation.recipient.name"
                                :is-invited="true"></member>
                        <div v-if="group.users.length < group.memberCap" class="mt-4">
                            <label class="text-sm text-black dark:text-gray-100">Add user to group</label>
                            <div class="flex mt-1">
                                <input @keydown.enter="addUser" v-model="userEmail" :disabled="addingUser" type="email"
                                       placeholder="someone@somewhere.com"
                                       class="focus:outline-none text-sm flex-grow bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 pl-4 py-1.5 rounded-l-lg">
                                <button @click="addUser"
                                        class="text-gray-800 dark:text-white px-3 hover:bg-gray-300 dark:hover:bg-gray-900 bg-gray-200 dark:bg-gray-800 rounded-r-lg transition-colors">
                                    <svg v-if="!addingUser" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <svg v-else class="animate-spin h-4 w-4 text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                            <span v-if="addError !== ''" class="text-red-700 dark:text-red-400 text-xs font-medium"
                                  v-text="addError"></span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-lg  dark:text-gray-200">Projects</h2>
                    <div class="flex justify-center items-center" v-if="group.projects.length === 0">
                        <span class="text-sm text-gray-400">No projects</span>
                    </div>
                    <div v-else class="mt-2 grid grid-cols-2 xl:grid-cols-3 gap-4 h-full">
                        <a :href="'/courses/' + group.courseId + '/tasks/' + project.task_id" :key="project.id"
                           v-for="project in group.projects"
                           class="border hover:shadow-lg py-6 max-h-14 hover:text-white dark:border-gray-500 dark:hover:border-lime-green-500 text-black dark:text-white flex hover:bg-lime-green-500 rounded-lg justify-center items-center font-medium text-sm ">
                            {{ group.tasks.find((task) => task.id === project.task_id).name }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import GroupBox from "../GroupBox";
import Alert from "../Alert";
import Member from "./Member";
import _ from "lodash";

export default {
    components: {Member, Alert, GroupBox},
    props: {
        group: {
            type: Object,
            required: true
        },
        csrf: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            showDeleteDialog: false,
            showLeaveDialog: false,
            addingUser: false,
            userEmail: "",
            addError: ""
        }
    },
    methods: {
        addUser: async function () {
            this.addingUser = true;
            this.addError = "";
            try {
                let invitation = await axios.post(this.group.inviteRoute, {
                    csrf: this.csrf,
                    email: this.userEmail
                })
                this.$emit('invitedUser', invitation.data, this.group.id)
                this.userEmail = "";

            } catch (error) {
                if (error.response.status === 404)
                    this.addError = "Couldn't find a user with this email.";
                else if (error.response.status === 429)
                    this.addError = error.response.data.message;
                else
                    this.addError = error.response.data.errors.email[0];
            } finally {
                this.addingUser = false;
            }
        },
        removeInvitation: async function (invitation) {
            console.log("removeInvitation", invitation);
            await axios.post(invitation.deleteRoute, {
                csrf: this.csrf,
                _method: 'DELETE'
            })
            this.$emit('removeInvitation', invitation, this.group.id)
        },
        removeUserFromGroup: async function (user) {
            console.log(user);
            let response = await axios.post(user.removeUserRoute, {
                    csrf: this.csrf,
                    _method: 'DELETE'
                }
            );
            this.$emit('removeUser', response.data, user);
        }
    },

}
</script>
