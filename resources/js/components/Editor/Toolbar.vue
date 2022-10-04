<template>
    <div class="flex h-12 bg-lime-green-700">
        <div class="flex-shrink-0" style="width: 250px">

        </div>
        <div class="w-full justify-between flex">
            <div class="flex flex-col items-start justify-center">
                <span v-if="file!==null" class="text-white font-medium text-sm leading-3" v-text="file.basename"></span>
                <!--<span v-if="file!==null" class="text-gray-400 text-sm leading-5">/this/is/a/path</span>-->
                <span v-if="file==null" class="text-white font-medium text-sm leading-3">No file open</span>
            </div>
            <div class="flex">
                <button class="transition-colors h-full hover:bg-lime-green-800 text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-5 h-5 mr-2">
                        <path
                            d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                    </svg>
                    <span>Submit Feedback</span>
                </button>
                <button class="transition-colors h-full hover:bg-lime-green-800 text-white px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
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
        }
    }
}
</script>
