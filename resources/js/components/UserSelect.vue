<template>
    <div>
        <t-rich-select v-model="value" :fetch-options="fetchOptions" :minimum-input-length="3" placeholder="Pick a user"
                       text-attribute="name"
                       value-attribute="id">
            <template slot="label" slot-scope="{ className, option, query }">
                <div class="flex items-center">
                    <span class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white"
                             height="48" width="48" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <div class="flex flex-col ml-2 text-gray-800 dark:text-gray-100">
                        <strong>{{ option.
                            raw.name }}</strong>
                        <span class="text-sm leading-tight text-gray-700 dark:text-gray-400">{{
                                option.raw.email
                            }}</span>
                    </div>
                </div>
            </template>
            <template slot="option" slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                <div :class="className">
                    <span class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 rounded-full bg-gray-100 text-black border-2 border-white"
                             height="48" width="48" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <div class="flex flex-col w-full ml-2 text-gray-800 dark:text-gray-100">
                        <strong>
                            {{ option.raw.name }}
                            <span v-if="isSelected">(Selected)</span>
                        </strong>
                        <span class="text-sm leading-tight text-gray-700 dark:text-gray-400">{{
                                option.raw.email
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
    props: ["name"],
    data() {
        return {
            value: null
        }
    },
    methods: {
        async fetchOptions(q) {
            let response = await fetch(`/api/users/search?q=${q}`);
            return {results: await response.json()};
        }
    }
}
</script>
