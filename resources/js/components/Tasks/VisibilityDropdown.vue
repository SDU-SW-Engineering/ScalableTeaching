<template>
    <div ref="bounds" class="relative">
        <button :disabled="loading" @click="showDropdown = !showDropdown" id="dropdownDefault" data-dropdown-toggle="dropdown"
                :class="[visible ? 'bg-lime-green-400 hover:bg-lime-green-500 focus:ring-lime-green-300 text-white' : 'bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:ring-gray-200 focus:ring-gray-600 text-gray-500 dark:text-gray-200']"
                class="justify-between w-44 flex transition-colors duration-200 focus:ring-4 focus:outline-none border dark:border-gray-700 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                type="button">
            <svg v-if="loading" :class="[visible ? 'text-white' : 'text-gray-500 dark:text-gray-200']" class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <svg v-if="!loading && visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-6 h-6">
                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                <path fill-rule="evenodd"
                      d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                      clip-rule="evenodd"/>
            </svg>
            <svg v-if="!loading && !visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path
                    d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z"/>
                <path
                    d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z"/>
                <path
                    d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z"/>
            </svg>
            <span v-if="visible">Visible</span>
            <span v-else>Invisible</span>
            <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div v-show="showDropdown" id="dropdown"
             class="absolute right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                <li v-if="!visible && isPublishable" @click="setVisibility(true)"
                    class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 flex items-center text-gray-500 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-2">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                        <path fill-rule="evenodd"
                              d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span>Visible</span>
                </li>
                <li v-if="visible && isPublishable" @click="setVisibility(false)"
                    class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 flex items-center text-gray-500 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                        <path d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z" />
                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z" />
                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z" />
                    </svg>
                    <span>Invisible</span>
                </li>
                <li v-if="!isPublishable" class="flex flex-col py-2 px-4 dark:hover:bg-gray-600 flex text-gray-500 dark:text-gray-200 cursor-pointer">
                    <span class="font-bold font-sm">Not publishable</span>
                    <span class="text-xs dark:text-gray-300">Cannot not be set to visible as long as the task is not publishable</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";

const props = defineProps<{
    isPublishable: boolean,
    isVisible: boolean,
    route: string
}>();

const showDropdown = ref<boolean>(false)
const visible = ref<boolean>(false)
const loading = ref<boolean>(false)
const bounds = ref<Element>(null)

async function setVisibility(visibility : boolean) {
    loading.value = true;
    showDropdown.value = false;
    await axios.post(props.route);
    visible.value = visibility;
    loading.value = false;
}

function close(e) {
    if (!bounds.value.contains(e.target)) {
        showDropdown.value = false;
    }
}

onMounted(() => {
    document.addEventListener('click', close)
    visible.value = props.isVisible
})

onBeforeUnmount(() => {
    document.removeEventListener('click', close)
})
</script>
