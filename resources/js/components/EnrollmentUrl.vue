<template>
    <div class="flex items-center text-sm h-8">
        <div
            class="bg-gray-600 text-white h-full rounded-l flex items-center px-2"
        >
            Enrollment URL
        </div>
        <input
            type="text"
            class="text-xs h-full bg-gray-500 text-gray-200 border-none w-52"
            :value="url"
        />
        <button
            @click="copy"
            class="flex h-full items-center bg-lime-green-400 text-white text-sm px-2 rounded-r hover:bg-lime-green-500 transition-colors"
        >
            Copy
        </button>
    </div>
</template>

<script>
export default {
    props: ["url"],
    methods: {
        copy: async function () {
            try {
                await navigator.clipboard.writeText(this.url);
            } catch ($e) {
                alert("Failed to copy url");
            }
        },
    },
};
</script>
