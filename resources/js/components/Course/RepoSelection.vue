<template>
    <div>
        <div class="bg-gray-500 border border-gray-600 border-2 rounded-md flex justify-between items-center text-white" v-if="!update">
            <div class="px-2">
                <span>Repo: </span>
                <span>{{ value }}</span>
            </div>
            <button type="button" @click="update = true" class="bg-gray-200 p-2 rounded-r md text-black hover:bg-gray-300 transition-colors">Change</button>
        </div>
        <t-rich-select v-else v-model="value" :fetch-options="fetchOptions" :minimum-input-length="3"
                       placeholder="Pick a repository"
                       text-attribute="name"
                       value-attribute="id">
            <template slot="label" slot-scope="{ className, option, query }">
                <div class="flex items-center">
                    <span class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 rounded-full bg-gray-100 border-2 border-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5"/>
                        </svg>
                    </span>
                    <div class="flex flex-col ml-2 text-gray-800 dark:text-gray-100">
                        <strong>{{
                                option.raw.name
                            }}</strong>
                    </div>
                </div>
            </template>
            <template slot="option" slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                <div :class="className">
                    <span class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 rounded-full bg-gray-100 border-2 border-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5"/>
                        </svg>
                    </span>
                    <div class="flex flex-col w-full ml-2 text-gray-800 dark:text-gray-100">
                        <strong>
                            {{ option.raw.name }}
                            <span v-if="isSelected">(Selected)</span>
                        </strong>
                        <span v-if="option.raw.namespace !== null" class="text-sm leading-tight text-lime-green-400 dark:text-lime-green-300">{{
                                option.raw.namespace.fullName
                            }}</span>
                        <span class="text-xs leading-tight text-gray-700 dark:text-gray-400">{{
                                option.raw.createdAt
                            }}</span>
                    </div>
                </div>
            </template>
        </t-rich-select>
        <input type="hidden" :name="name" :value="value">
    </div>
</template>

<script>
export default {
    props: ["name", "currentValue"],
    data() {
        return {
            value: null,
            update: true
        }
    },
    methods: {
        async fetchOptions(q) {

            const response = await fetch(`/api/user/repositories?q=${q}`, {
                headers: 'Content-Type: application/json'
            });
            return {results: await response.json()};
        }
    },
    mounted() {
        if  (this.currentValue != "")
            this.update = false;
        this.value = this.currentValue
    }
}
</script>
