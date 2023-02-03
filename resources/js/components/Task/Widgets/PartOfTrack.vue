<template>
    <div class="shadow-lg px-4 py-6 rounded-md mt-8 bg-lime-green-500 flex">
        <svg class="text-white flex-shrink-0 h-16 w-16 fill-current -ml-2" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24" style="transform: ;msFilter:;">
            <path d="m12 3.879-7.061 7.06 2.122 2.122L12 8.121l4.939 4.94 2.122-2.122z"></path>
            <path
                d="m4.939 17.939 2.122 2.122L12 15.121l4.939 4.94 2.122-2.122L12 10.879z"></path>
        </svg>
        <div class="flex flex-col">
            <div class="flex flex-row my-1 w-full">
                <div class="flex flex-col">
                    <h1 class="font-light text-lg text-white">Track</h1>
                    <h2 class="font-bold text-xl -mt-2 text-white">{{ track.name }}</h2>
                    <span class="text-sm text-white" v-if="isStarted">This task is part of your track.</span>
                    <span class="text-sm text-white" v-else >This task is part of a track, starting it will prevent you from selecting other tracks.</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['isStarted', 'track'],
    data() {
        return {}
    }
}
</script>
