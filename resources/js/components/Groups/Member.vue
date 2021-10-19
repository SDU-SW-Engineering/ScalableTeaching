<template>
    <div :class="{'animate-pulse': removing}"
        class="bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 px-3 py-1 flex justify-between rounded-lg mb-2 last:mb-0">
        <div class="flex items-center">
            <span class="text-gray-700 dark:text-gray-300">{{ name }}</span>
            <div v-if="isOwner"
                 class="mx-2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 font-medium rounded-lg tracking-wide">
                Owner
            </div>
            <div v-if="isInvited"
                 class="mx-2 bg-lime-green-100 text-lime-green-800 text-xs px-2 py-0.5 font-medium rounded-lg tracking-wide">
                Invited
            </div>
        </div>
        <button @click="remove" v-if="canRemove && !removing && !isYou"
            class="hover:text-gray-400 dark:text-gray-100 dark:hover:text-gray-300 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String
        },
        isInvited: {
            type: Boolean,
            default: false
        },
        canRemove: {
            type: Boolean,
            default: false
        },
        isYou: {
            type: Boolean,
            default: false
        },
        isOwner: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        remove: function() {
            this.removing = true;
            this.$emit('remove')
        }
    },
    data() {
        return {
            removing: false
        }
    }
}
</script>
