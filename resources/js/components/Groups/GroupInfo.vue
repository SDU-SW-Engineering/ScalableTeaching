<template>
    <section
        class="rounded-xl bg-white dark:bg-gray-600 px-4 sm:px-6 lg:px-4 xl:px-6 pt-4 pb-4 sm:pb-6 lg:pb-4 xl:pb-6 space-y-4 shadow-lg row-start-2 lg:col-start-1 xl:col-span-2 2xl:col-span-3">
        <header class="flex items-center justify-between">
            <button @click="$emit('close')"
                    class="hover:bg-gray-200 hover:text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-white dark:hover:text-white group flex items-center rounded-md bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="dark:text-white text-gray-600 mr-2 h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </button>
            <button
                class="hover:bg-red-200 hover:text-red-800 group flex items-center rounded-md bg-red-100 text-red-700 text-sm font-medium px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 mr-2 h-4 w-4 h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Leave
            </button>
        </header>
        <h1 class="text-xl font-medium text-black dark:text-white">{{ group.name }}</h1>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg dark:text-gray-200">Members</h2>
                <div class="mt-2">
                    <div
                        class="bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 px-3 py-1 flex justify-between rounded-lg mb-2"
                        v-for="i in 3">
                        <div class="flex items-center">
                            <span class="text-white dark:text-gray-300">Niels Faurskov</span>
                            <div class="ml-2">
                                <div
                                    class="bg-lime-green-100 text-lime-green-800 text-xs px-2 py-0.5 font-medium rounded-lg tracking-wide">
                                    Invited
                                </div>
                            </div>
                        </div>
                        <button class="hover:text-gray-400 dark:text-gray-100 dark:hover:text-gray-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div>
                        <label class="text-sm text-gray-100">Add user to group</label>
                        <div class="flex mt-1">
                            <input type="email" placeholder="someone@somewhere.com"
                                   class="focus:outline-none text-sm flex-grow bg-gray-700 text-gray-300 pl-4 py-1.5 rounded-l-lg">
                            <button class="text-white px-3 hover:bg-gray-900 bg-gray-800 rounded-r-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                        <span class="text-red-700 dark:text-red-500 text-xs font-semibold"
                             >There has been an error</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <h2 class="text-lg  dark:text-gray-200">Projects</h2>
                <div class="mt-2 grid grid-cols-3 gap-4 h-full">
                    <a href="#" v-for="i in 7"
                       class="border py-6 dark:border-gray-500 dark:hover:border-lime-green-500 text-white flex hover:bg-lime-green-500 rounded-lg justify-center items-center font-medium text-sm ">
                        Assignment 1
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import GroupBox from "../GroupBox";

export default {
    components: {GroupBox},
    props: ['group']
}
</script>
