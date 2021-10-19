<template>
    <div class="row-start-2 lg:col-start-1 xl:col-span-2 2xl:col-span-3">
        <alert @cancel="showLeaveDialog = false" v-if="group.canLeave.allowed && showLeaveDialog" type="danger"
               title="Leave Group" confirm-button-text="Leave Group"></alert>
        <alert :url="group.deleteRoute" @cancel="showDeleteDialog = false"
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
                            :class="[group.canDelete.allowed ? 'hover:bg-red-200 hover:text-red-800' : 'opacity-50']"
                            class="mr-2 group flex items-center rounded-md bg-red-100 text-red-700 text-sm font-medium px-4 py-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 mr-2 h-4 w-4 h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                    <tippy to="btnCanLeave" placement="bottom"
                           v-if="!group.canLeave.allowed && group.canLeave.message != null">
                        {{ group.canLeave.message }}
                    </tippy>
                    <button @click="showLeaveDialog = true" name="btnCanLeave"
                            :class="[group.canLeave.allowed ? 'hover:bg-red-200 hover:text-red-800' : 'opacity-50']"
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
            <div class="grid md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-lg dark:text-gray-200">Members</h2>
                    <div class="mt-2">
                        <member :key="user.id" v-for="user in group.users" :name="user.name"></member>
                        <div
                            class="bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 px-3 py-1 flex justify-between rounded-lg mb-2"
                            v-for="i in 3">
                            <div class="flex items-center">
                                <span class="text-gray-700 dark:text-gray-300">Niels Faurskov</span>
                                <div class="ml-2">
                                    <div
                                        class="bg-lime-green-100 text-lime-green-800 text-xs px-2 py-0.5 font-medium rounded-lg tracking-wide">
                                        Invited
                                    </div>
                                </div>
                            </div>
                            <button
                                class="hover:text-gray-400 dark:text-gray-100 dark:hover:text-gray-300 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div>
                            <label class="text-sm text-black dark:text-gray-100">Add user to group</label>
                            <div class="flex mt-1">
                                <input @keydown.enter="addUser" v-model="userEmail" :disabled="addingUser" type="email"
                                       placeholder="someone@somewhere.com"
                                       class="focus:outline-none text-sm flex-grow bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 pl-4 py-1.5 rounded-l-lg">
                                <button @click="addUser"
                                        class="text-gray-800 dark:text-white px-3 hover:bg-gray-400 dark:hover:bg-gray-900 bg-gray-300 dark:bg-gray-800 rounded-r-lg">
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
                    <div class="mt-2 grid grid-cols-2 xl:grid-cols-3 gap-4 h-full">
                        <a href="#" v-for="i in 7"
                           class="border py-6 hover:text-white dark:border-gray-500 dark:hover:border-lime-green-500 text-black dark:text-white flex hover:bg-lime-green-500 rounded-lg justify-center items-center font-medium text-sm ">
                            Assignment 1
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

export default {
    components: {Member, Alert, GroupBox},
    props: ['group', 'csrf'],
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
                await axios.post(this.group.inviteRoute, {
                    csrf: this.csrf,
                    email: this.userEmail
                })
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

        }
    },

}
</script>
