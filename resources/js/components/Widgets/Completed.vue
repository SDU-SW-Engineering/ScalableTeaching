<template>
    <div class="shadow-lg">
        <div
            class="bg-white px-4 py-6 rounded-md mt-8 dark:bg-gray-800">
            <div class="flex flex-col items-center gap-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-24 w-24 text-lime-green-300 dark:text-lime-green-400 mr-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex flex-col w-full justify-center">
                        <h3 class="font-bold text-lg dark:text-white">Assignment handed in</h3>
                        <p class="text-gray-600 dark:text-gray-300">You have successfully handed in your assignment.
                            <!-- TODO: Should this text still be here? We do overwrite the status now, but maybe that is something we can discuss.
                            Subsequent builds will not be tracked.
                            -->
                        </p>
                    </div>
                </div>
                <div class="flex justify-start gap-4">
                    <a :href="'https://gitlab.sdu.dk/projects/' +  project.gitlab_project_id" target="_blank"
                       class="flex items-center px-2 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-lime-green-600 rounded-md hover:bg-lime-green-500 focus:outline-none focus:ring focus:ring-lime-green-300 focus:ring-opacity-80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <span class="mx-1">Go to repository</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['project']
}
</script>
