<template>
    <div class="container mx-auto px-6 pt-4">
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full lg:w-2/3 xl:w-4/6">
                <div class="flex gap-5 mb-3">
                    <button @click="tab = 'description'"
                            :class="[tab === 'description' ? 'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300']"
                            class="py-2 px-3 rounded-md font-semibold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>
                            Description
                        </span>
                    </button>
                    <button @click="tab = 'builds'"
                            :class="[tab === 'builds' ? 'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300']"
                            class="py-2 px-3 rounded-md font-semibold flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>
                            Builds
                        </span>
                    </button>
                    <button @click="tab = 'settings'"
                            :class="[tab === 'settings' ? 'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300']"
                            class="py-2 px-3 rounded-md font-semibold flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>
                            Settings
                        </span>
                    </button>
                </div>
                <div v-show="tab === 'description'" class="relative">
                    <div
                        class="absolute bg-white p-4 rounded-md shadow-md max-h-screen overflow-x-hidden overflow-scroll backdrop-brightness-50 dark:bg-gray-800">
                        <div class="prose-sm dark:prose-light"
                             :class="[hideMissingAssignmentWarning ? '': 'filter blur-sm']" v-html="description"/>
                    </div>
                    <div class="absolute flex w-full justify-center" v-if="!hideMissingAssignmentWarning">
                        <div class="bg-white shadow-lg px-4 py-6 rounded-md mt-8 dark:bg-gray-800">
                            <div class="flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="mr-4 h-14 w-14 text-red-300 dark:text-red-400" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h3 class="font-bold text-lg mb-4 dark:text-white">You haven't started your
                                        assignment!</h3>
                                    <div class="flex justify-center gap-4">
                                        <a href="#"
                                           class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-lime-green-600 rounded-md hover:bg-lime-green-500 focus:outline-none focus:ring focus:ring-lime-green-300 focus:ring-opacity-80">
                                            <span class="mx-1">Start Assignment</span>
                                        </a>

                                        <button @click="hideMissingAssignmentWarning = true"
                                                class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-600 rounded-md hover:bg-gray-500 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                                            <span class="mx-1">Close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="tab === 'builds'">
                    <build-table></build-table>
                </div>
            </div>
            <div class="w-full lg:w-1/3 xl:w-2/6 mt-4 mb-4">
                <div v-if="hideMissingAssignmentWarning || tab !== 'description'"
                     class="bg-white shadow-lg px-4 py-6 rounded-md mt-8 dark:bg-gray-800">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-24 w-24 text-red-300 dark:text-red-400" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex flex-col w-full items-center justify-center">
                            <h3 class="font-bold text-lg mb-4 dark:text-white text-center">You
                                haven't started your
                                assignment yet</h3>
                            <div class="flex justify-start gap-4">
                                <button @click="hideMissingAssignmentWarning = true"
                                        class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-lime-green-600 rounded-md hover:bg-lime-green-500 focus:outline-none focus:ring focus:ring-lime-green-300 focus:ring-opacity-80">
                                    <span class="mx-1">Start Assignment</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg p-4 rounded-md mt-8 dark:bg-gray-800">
                    <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Builds</h3>
                    <div>
                        <line-chart :height="200" :data="datasets"></line-chart>
                    </div>
                    <p class="dark:text-gray-300">A total of <b
                        class="text-lime-green-400 dark:text-lime-green-500">322</b> builds have
                        completed during the task, of which
                        you account for <b class="text-lime-green-400 dark:text-lime-green-500">44</b>.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LineChart from "./LineChart";
import BuildTable from "./BuildTable";

export default {
    components: {BuildTable, LineChart},
    props: ['description'],
    data: function () {
        return {
            tab: 'builds',
            hideMissingAssignmentWarning: false,
            datasets: [
                {
                    borderColor: '#7BB026',
                    backgroundColor: '#7BB02644',
                    label: "Yours",
                    data: [1, 3, 5, 7, 0, 2, 0]
                },
                {
                    borderColor: '#6B7280',
                    backgroundColor: '#6B728077',
                    label: "Total",
                    data: [10, 32, 28, 33, 3, 11, 32]
                },

            ]
        }
    }
}
</script>
