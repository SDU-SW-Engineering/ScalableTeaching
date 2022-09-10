<template>
    <div class="relative">
        <button :disabled="loading" @click="showDropdown = !showDropdown" id="dropdownDefault"
                data-dropdown-toggle="dropdown"
                class="justify-between w-44 flex transition-colors duration-200 focus:ring-4 focus:outline-none
                bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:ring-gray-300 dark:focus:ring-gray-600 text-gray-500 dark:text-gray-200
                border dark:border-gray-700 font-medium rounded-l-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                type="button">
            <svg v-if="loading" class="text-gray-500 dark:text-gray-200 animate-spin h-5 w-5 mr-2"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <svg v-if="!loading" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-6 h-6">
                <path
                    d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z"/>
                <path
                    d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z"/>
                <path
                    d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z"/>
            </svg>
            <span v-text="roles[currentRole]"></span>
            <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div v-show="showDropdown" id="dropdown"
             class="absolute right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                <li :class="[roleId === currentRole ? 'bg-lime-green-600 text-gray-200' :'hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 text-gray-500 cursor-pointer']"
                    v-for="(role, roleId) in roles" @click="setRole(roleId)"
                    class="py-2 px-4 flex items-center">
                    <span v-text="role"></span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        currentRole: {
            required: true,
            type: String
        },
        roles: {
            required: true,
            type: Object
        },
        route: {
            required: true,
            type: String
        },
        userId: {
            required: true,
            type: Number
        }
    },
    data() {
        return {
            showDropdown: false,
            visible: false,
            loading: false
        }
    },
    methods: {
        setRole: async function (roleId) {
            if (roleId === this.currentRole)
                return;

            this.loading = true;
            this.showDropdown = false;
            await axios.put(this.route, {
                role: roleId,
                user: this.userId
            });
            this.$emit('new-role', roleId)
            this.loading = false;
        },
        close: function (e) {
            if (!this.$el.contains(e.target)) {
                this.showDropdown = false
            }
        }
    },
    mounted() {
        document.addEventListener('click', this.close)
        this.visible = this.isVisible
    },
    beforeDestroy() {
        document.removeEventListener('click', this.close)
    }
}
</script>
