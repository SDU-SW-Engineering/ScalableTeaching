<template>
    <div>
        <div class="flex items-center items-stretch">
            <div class="bg-gray-200 border dark:border-none border-gray-300 dark:bg-gray-800 text-lime-green-600 dark:text-lime-green-300 px-2 flex items-center rounded-l">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="opacity-80 w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M3.792 2.938A49.069 49.069 0 0112 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 011.541 1.836v1.044a3 3 0 01-.879 2.121l-6.182 6.182a1.5 1.5 0 00-.439 1.061v2.927a3 3 0 01-1.658 2.684l-1.757.878A.75.75 0 019.75 21v-5.818a1.5 1.5 0 00-.44-1.06L3.13 7.938a3 3 0 01-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <input v-model="filter" placeholder="Filter" type="text" id="name" name="name" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-r focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"/>
        </div>
        <div class="flex items-center justify-center text-gray-300 text-xl font-thin mt-4" v-if="filteredUsers.length === 0">
            <span>No results</span>
        </div>
        <div class="max-h-screen overflow-y-auto mt-4" v-else>
            <enrolled-member :activity-route="activityRoute" :key="member.id" :member="member" :kick-route="kickRoute" :role-route="roleRoute" v-for="member in filteredUsers"
                             :available-roles="roles"></enrolled-member>
        </div>
    </div>
</template>

<script>
import EnrolledMember from "./Partials/EnrolledMember";

export default {
    components: {EnrolledMember},
    props: {
        users: {
            type: Array,
            required: true
        },
        roles: {
            type: Object,
            required: true
        },
        roleRoute: {
            type: String,
            required: true
        },
        kickRoute: {
            type: String,
            required: true
        },
        activityRoute: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            filter: ""
        }
    },
    computed: {
        filteredUsers: function () {
            if (this.filter === "")
                return this.users;

            return this.users.filter(user => {
                let lc = this.filter.toLowerCase();

                return user.name.toLowerCase().includes(lc) || this.roles[user.role].toLowerCase().includes(lc)
            });
        }
    }
}
</script>
