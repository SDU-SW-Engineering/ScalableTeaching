<template>
        <div class="bg-white p-4 rounded-md shadow-md max-vh70 overflow-x-hidden overflow-scroll dark:bg-gray-800">
        <h1 class="text-xl font-semibold dark:text-white">Survey</h1>
        <h2 class="mb-4 font-light text-gray-700 dark:text-gray-400" v-if="!submitted">Due date: <abbr :title="survey.deadline.date">{{ survey.deadline.forHumans }}</abbr></h2>
        <div v-if="!submitted" v-for="(field, index) in survey.details.fields" class="mb-4">
            <h2 class="font-light text-lg mb-2 dark:text-white"><span class="font-medium">{{ index + 1 }}</span>. {{ field.question }}</h2>
            <h3 class="font-medium text-sm text-red-800 dark:text-red-500 mb-2 -mt-1" v-if="validated['v'+field.id] != null" v-text="validated['v'+field.id]"></h3>
            <div>
                <div v-for="item in field.items" class="flex items-start mb-2">
                    <div class="flex items-center h-5">
                        <input :id="item.id" v-model="fields['v'+field.id]" :value="item.id" :name="'field-' + field.id" v-if="field.allowed_selections === 1" type="radio" class="mt-1 w-4 h-4 bg-gray-50 rounded-full text-lime-green-500 border border-gray-300 focus:ring-3 focus:ring-lime-green-300 dark:bg-gray-700 dark:border-lime-green-600 dark:focus:ring-lime-green-600 dark:ring-offset-lime-green-800">
                        <input :id="item.id" v-model="fields['v'+field.id]" :value="item.id" :name="'field-' + field.id + '[]'" v-else type="checkbox" class="mt-1 w-4 h-4 bg-gray-50 text-lime-green-500 rounded border border-gray-300 focus:ring-3 focus:ring-lime-green-300 dark:bg-gray-700 dark:border-lime-green-600 dark:focus:ring-lime-green-600 dark:ring-offset-lime-green-800" required>
                    </div>
                    <div class="block w-full">
                        <div class="ml-2">
                            <label :for="item.id" class="text-gray-900 dark:text-gray-300" v-text="item.name"></label>
                        </div>
                        <div class="ml-2 mt-2" v-if="item.allow_input">
                            <textarea v-model="extras['v'+item.id]" class="block text-sm w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-lime-green-500 focus:border-lime-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div v-if="!submitted">
            <button :disabled="submitting" :class="{'hover:bg-lime-green-600': !submitting, 'cursor-default' : submitting}" @click="submit" class="flex items-center w-full bg-lime-green-500 justify-center py-2 rounded-md shadow-md text-white  transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span v-text="submitting ? 'Submitting...' : 'Submit'"></span>
            </button>
        </div>
        <div v-if="submitted" class="flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-lime-green-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h1 class="font-medium text-lg text-gray-700 dark:text-gray-200">Your survey has been submitted</h1>
            <h2 class="text-gray-400 dark:text-gray-500 text-sm">Submitted on 22/22/2022</h2>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        survey: {
            type: Object,
            required: true
        },
        projectId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            fields: {},
            extras: {},
            validated: {},
            submitting: false,
            submitted: false
        }
    },
    methods: {
        async submit() {
            this.validate();
            if (Object.values(this.validated).some(v => v != null)) {
                return;
            }
            this.submitting = true;
            let response = await axios.post(`/projects/${this.projectId}/surveys/${this.survey.details.id}`, {
                values: this.fields,
                extras: this.extras
            });
            this.submitting = false;
            this.submitted = true;
        },
        validate() {
            for (let field of this.survey.details.fields)
            {
                this.validated['v' + field.id] = null;
                if (field.required)
                {
                    const isArray = Array.isArray(this.fields['v' + field.id]);
                    let value = this.fields['v' + field.id];


                    let requireAdditionalInput = field.items
                        .filter(x => isArray ? value.includes(x.id) : x.id === value)
                        .find(x => x.allow_input);

                    if (requireAdditionalInput)
                    {
                        let extraVal = this.extras['v' + requireAdditionalInput.id];
                        if (!(extraVal != null && extraVal !== "")){
                            this.validated['v' + field.id] = "You need to enter some additional input.";
                            continue;
                        }
                        if (extraVal.trim().length < 10 || extraVal.trim().length >= 3000)
                        {
                            this.validated['v' + field.id] = "Your input needs to be between 10 and 3000 characters";
                            continue;
                        }
                    }

                    if (!isArray && value != null)
                        continue;
                    if (isArray && value != null && value.length > 0)
                        continue;


                    this.validated['v' + field.id] = "This field is required.";
                }
            }
        }
    },
    mounted() {
        this.submitted = this.survey.submitted;
        let obj = {};
        let extras = {};
        let validated = {};
        for (let field of this.survey.details.fields)
        {
            obj["v" + field.id] =  field.allowed_selections > 1 || field.allowed_selections === 0 ? [] : null;
            validated["v" + field.id] = null;

            if (Array.isArray(field.items)){
                field.items.filter(item => item.allow_input).forEach(item => extras["v" + item.id] = null);
            }
        }
        this.fields = obj;
        this.extras = extras;
        this.validated = validated;
    }
}
</script>
