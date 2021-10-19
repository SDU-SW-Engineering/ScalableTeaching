<template>
    <article
        class="rounded-xl bg-white dark:bg-gray-600 shadow-lg row-start-1 lg:row-start-2 mb-6">
        <h2 class="text-xl font-semibold text-black dark:text-gray-100 px-6 pt-4">Group Invitation</h2>
        <p class="pb-6 text-xs text-base text-gray-400 px-6" v-text="invitation.group.name">
        </p>
        <div class="w-full flex border-t border-b dark:border-gray-500 py-4 justify-between">
            <dt class="pl-6 w-2/5 uppercase font-semibold tracking-wide text-sm text-gray-600 dark:text-gray-100">
                Members
            </dt>
            <div class="pr-6">
                <dd v-for="member in invitation.group.users"
                    class="text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-full py-1 pl-4 pr-4 flex items-center mb-4 last:mb-0"
                    v-text="member.name">
                </dd>
            </div>
        </div>
        <tippy to="cantAccept" placement="top" v-if="!invitation.canAccept.allowed">{{ invitation.canAccept.message}}</tippy>
        <div class="grid grid-cols-2 px-6 py-4 gap-6">
            <button @click="declineInvitation" :disabled="accepting || declining"
                    :class="{ 'animate-pulse': declining, 'hover:bg-gray-200 dark:hover:bg-gray-500': !(declining || accepting), 'opacity-50': accepting}"
                    class="bg-gray-100 dark:bg-gray-400 py-3 flex justify-center items-center text-black dark:text-white font-medium rounded-lg transition-colors duration-200">
                <span v-if="!declining">Decline</span>
                <svg v-else class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <button name="cantAccept" v-if="!invitation.canAccept.allowed"
                    class="opacity-50 bg-lime-green-500 py-3 font-medium text-white rounded-lg flex justify-center items-center transition-colors duration-200">
                Accept
            </button>
            <button v-else @click="acceptInvitation" :disabled="accepting || declining"
                    :class="{ 'animate-pulse': accepting, 'hover:bg-lime-green-600': !(declining || accepting), 'opacity-50': declining}"
                    class="bg-lime-green-500 py-3 font-medium text-white rounded-lg flex justify-center items-center transition-colors duration-200">
                <span v-if="!accepting">Accept</span>
                <svg v-else class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </article>
</template>

<script>
export default {
    props: ['invitation'],
    data() {
        return {
            accepting: false,
            declining: false
        }
    },
    methods: {
        acceptInvitation: async function () {
            this.accepting = true;
            await axios.get(this.invitation.acceptRoute);
            location.reload();
        },
        declineInvitation: async function (invitation) {
            this.declining = true;
            await axios.get(this.invitation.declineRoute);
            location.reload();
        }
    }
}
</script>
