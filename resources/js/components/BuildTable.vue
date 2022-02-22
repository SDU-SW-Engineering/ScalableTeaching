<template>
    <div class="">
        <div class="flex flex-col">
            <div class="-my-1 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow-md overflow-x-auto max-vh70 border-b border-gray-200 dark:border-gray-600 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-500">
                            <thead class="bg-gray-100 dark:bg-gray-900">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Author
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Run Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    When
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-500">
                            <tr v-for="build in builds">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 rounded-full h-8 w-8 flex items-center justify-center" :class="{ 'bg-lime-green-200': build.status === 'success', 'bg-red-200': build.status === 'failed', 'bg-yellow-200': build.status === 'pending',  'bg-blue-200': build.status === 'running', 'bg-gray-200': build.status === 'canceled'}">
                                            <svg v-if="build.status === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-lime-green-700"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700" fill="none"
                                                 v-if="build.status === 'failed'" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-700"
                                                 fill="none" v-if="build.status === 'pending'" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700"
                                                 fill="none" v-if="build.status === 'running'" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700"
                                                 fill="none" v-if="build.status === 'canceled'" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                                <span class="capitalize" v-text="build.status"></span>
                                            </div>
                                            <div class="text-lime-green-500 text-xs dark:text-lime-green-400">
                                                {{ build.prettySubTasks.filter(t => t.completed).length }}/{{ build.prettySubTasks.length }} tasks completed
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-200">{{ build.user_name }}</div>
                                    <div class="text-sm text-gray-500">{{ build.user_email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span>{{ build.run_time }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 overflow">
                                        Queued for {{ build.queued_for}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span v-text="build.ran"></span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ build.ran_date }}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['projectId'],
    data: function() {
        return {
            builds: []
        }
    },
    mounted: async function() {
        let response = await axios.get(`/projects/${this.projectId}/builds`);
        this.builds = response.data;
    }
}
</script>
