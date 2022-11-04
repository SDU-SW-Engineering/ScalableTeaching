<template>
    <button @click="$emit('click')" :disabled="isLoading" type="button"
            :class="{
                'bg-blue-600  hover:bg-blue-700 focus:ring-blue-500': type == null || type === 'info',
                'bg-lime-green-600 hover:bg-lime-green-700 focus:ring-lime-green-500': type === 'success',
                'bg-red-600 hover:bg-red-700 focus:ring-red-500': type === 'danger'
            }"
            class="disabled:opacity-50 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2  text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
        <slot v-if="!isLoading"></slot>
        <svg v-else class="animate-spin h-5 w-5 text-white"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </button>
</template>

<script setup lang="ts">
import {} from "vue";

const props = defineProps<{
    type: string,
    isLoading: boolean
}>()
</script>
