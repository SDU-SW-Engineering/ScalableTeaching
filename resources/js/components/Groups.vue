<template>
    <div>
        <modal v-show="createModal.show" :is-loading="createModal.creating" @cancel="createModal.show = false"
               title="New Group" type="info">
            <div>
                <label for="groupname" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Group
                    name</label>
                <div class="flex focus-within:ring-2 focus-within:ring-gray-400 rounded-lg">
                    <input type="text" :disabled="createModal.creating" id="groupname" v-model="createModal.name"
                           class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-l-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                    >
                    <button :disabled="createModal.loadingName || createModal.creating" @click="randomName"
                            class="bg-gray-200 dark:bg-gray-900 text-gray-800 px-3 dark:text-white border border-gray-300 dark:border-gray-800 rounded-r-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'animate-spin': createModal.loadingName}"
                             class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col">
                    <span class="text-red-600 dark:text-red-400 text-xs font-semibold"
                          v-for="error in createModal.errors" v-text="error"></span>
                </div>
            </div>
            <template v-slot:buttons>
                <modal-button @click="createGroup" :is-loading="createModal.creating" type="success">Create
                </modal-button>
            </template>
        </modal>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-6 items-start">
            <section
                class="rounded-xl bg-white dark:bg-gray-600 px-4 sm:px-6 lg:px-4 xl:px-6 pt-4 pb-4 sm:pb-6 lg:pb-4 xl:pb-6 space-y-4 shadow-lg row-start-2 lg:col-start-1 xl:col-span-2 2xl:col-span-3">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg leading-6 font-medium text-black dark:text-gray-100">My Groups</h2>
                    <button @click="createModal.show = true"
                            class="hover:bg-lime-green-200 hover:text-light-blue-800 group flex items-center rounded-md bg-lime-green-100 text-lime-green-700 text-sm font-medium px-4 py-2">
                        <svg class="group-hover:text-lime-green-700 text-lime-green-600 mr-2" width="12" height="20"
                             fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                        </svg>
                        New
                    </button>
                </header>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                    <li v-for="group in groups">
                        <a href="#"
                           class="hover:bg-lime-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                            <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                                <div>
                                    <dt class="sr-only">Title</dt>
                                    <dd class="group-hover:text-white leading-6 font-medium text-black dark:text-white">
                                        {{ group.name }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="sr-only">Category</dt>
                                    <dd class="group-hover:text-lime-green-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4 text-gray-500 dark:text-gray-400">
                                        {{ group.users.length }} {{
                                            group.users.length === 1 ? 'Member' : 'Members'
                                        }}
                                    </dd>
                                </div>
                                <div class="col-start-2 row-start-1 row-end-3">
                                    <dt class="sr-only">Users</dt>
                                    <dd class="flex justify-end sm:justify-start lg:justify-end xl:justify-start -space-x-2">
                                        <svg v-for="i in group.users.length" xmlns="http://www.w3.org/2000/svg"
                                             class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white"
                                             height="48" width="48" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </dd>
                                </div>
                            </dl>
                        </a>
                    </li>
                </ul>
            </section>
            <article v-if="invitations.length > 0"
                     class="rounded-xl bg-white dark:bg-gray-600 shadow-lg row-start-1 lg:row-start-2 mb-6">
                <h2 class="text-xl font-semibold text-black dark:text-gray-100 px-6 pt-4">Group Invitation</h2>
                <p class="pb-6 text-xs text-base text-gray-400 px-6">
                    Group 11
                </p>
                <div class="w-full flex border-t border-b dark:border-gray-500 py-4 justify-between">
                    <dt class="pl-6 w-2/5 uppercase font-semibold tracking-wide text-sm text-gray-600 dark:text-gray-100">
                        Members
                    </dt>
                    <div class="pr-6">
                        <dd v-for="i in 3"
                            class="text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-full py-1 pl-4 pr-4 flex items-center mb-4 last:mb-0">
                            Andrew Parsons
                        </dd>
                    </div>
                </div>
                <div class="grid grid-cols-2 px-6 py-4 gap-6">
                    <button
                        class="bg-gray-100 dark:bg-gray-400 py-3 text-black dark:text-white font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                        Decline
                    </button>
                    <button
                        class="bg-lime-green-500 py-3 font-medium text-white rounded-lg hover:bg-lime-green-600 transition-colors duration-200">
                        Accept
                    </button>
                </div>
            </article>
            <article v-else
                     class="rounded-xl row-start-1 lg:row-start-2 mb-6 border-4 border-dashed dark:border-gray-600">
                <div class="py-6 px-4 flex justify-center items-center flex-col">
                    <h1 class="text-gray-400 font-semibold text-xl dark:text-gray-500">No pending invitations</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 dark:text-gray-500 mt-4"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
import Alert from "./Alert";
import Modal from "./Modal/Modal";
import ModalButton from "./Modal/ModalButton";

export default {
    components: {ModalButton, Modal, Alert},
    props: ['csrf', 'createUrl', 'initialGroups'],
    data() {
        return {
            groups: [],
            invitations: [],
            createModal: {
                show: false,
                creating: false,
                loadingName: false,
                name: "",
                errors: []
            },
            open: true
        }
    },
    mounted() {
        this.groups = this.initialGroups;
    },
    methods: {
        randomName: async function () {
            this.createModal.loadingName = true;
            this.createModal.name = (await axios.get('/random-name')).data;
            this.createModal.loadingName = false;
        },
        createGroup: async function () {
            this.createModal.errors = [];
            this.createModal.creating = true;

            try {
                let response = await axios.post(this.createUrl, {
                    _csrf: this.csrf,
                    name: this.createModal.name
                });
                this.groups = response.data;
                this.createModal.name = "";
                this.createModal.show = false;
                this.createModal.errors = [];
            } catch (e) {
                this.createModal.errors = _.flatMap(e.response.data.errors);
            } finally {
                this.createModal.creating = false;
            }
        }
    }
}
</script>
