<template>
    <div
        class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg col-span-3"
    >
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-black dark:text-white text-2xl font-thin">
                Start and end time
            </h1>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div
                class="bg-gray-50 dark:bg-gray-500 dark:border-none rounded border p-3"
            >
                <h3>Starts at</h3>
                <div class="mt-2">
                    <input
                        type="datetime-local"
                        step="1"
                        @change="$emit('startsAt', $event.target.value)"
                        :value="startsAt"
                        name="from"
                        class="disabled:bg-gray-200 col-span-4 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                    />
                </div>
            </div>
            <div
                class="bg-gray-50 dark:bg-gray-500 dark:border-none rounded border p-3"
            >
                <h3>Ends at</h3>
                <div class="mt-2">
                    <input
                        type="datetime-local"
                        step="1"
                        @change="$emit('endsAt', $event.target.value)"
                        :value="endsAt"
                        class="disabled:bg-gray-200 col-span-4 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["startsAt", "endsAt"],
};
</script>
