<template>
    <div class="flex h-12 bg-lime-green-700">
        <div class="flex-shrink-0" style="width: 250px">

        </div>
        <div class="w-full justify-between flex">
            <div class="flex flex-col items-center flex-grow justify-center">
                <span v-if="file!==null" class="text-white font-medium text-sm leading-3" v-text="file.basename"></span>
                <!--<span v-if="file!==null" class="text-gray-400 text-sm leading-5">/this/is/a/path</span>-->
                <span v-if="file==null" class="text-white font-medium text-sm leading-3">No file open</span>
            </div>
            <div class="flex">
                <div v-if="context == 'pre-submissions'" class="h-full text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-6 mr-2" viewBox="0 0 24 24"
                         style="transform: ;msFilter:;">
                        <path
                            d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zM17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299A3.111 3.111 0 0 0 10.834 13h2.332c.23.691.704 1.3 1.385 1.702A5.008 5.008 0 0 1 17 19z"></path>
                    </svg>
                    <div class="flex flex-col">
                        <span>Feedback</span>
                        <span class="text-xs -mt-1.5 text-gray-100 font-medium">Not submitted</span>
                    </div>
                </div>
                <div v-else-if="context == 'submitted'" class="h-full text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                        <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex flex-col">
                        <span>Feedback</span>
                        <span class="text-xs -mt-1.5 text-gray-100 font-medium">Submitted</span>
                    </div>
                </div>
                <button @click="$emit('toggleFeedback')" class="transition-colors h-full hover:bg-lime-green-800 text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-2">
                        <path
                            d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z"/>
                        <path
                            d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z"/>
                    </svg>
                    <span>Feedback List</span>
                </button>
                <button class="transition-colors h-full hover:bg-lime-green-800 text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-2">
                        <path fill-rule="evenodd"
                              d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        file: {
            type: Object,
            default: null
        },
        context: {
            type: String,
            required: true
        }
    },
    methods: {
    }
}
</script>
