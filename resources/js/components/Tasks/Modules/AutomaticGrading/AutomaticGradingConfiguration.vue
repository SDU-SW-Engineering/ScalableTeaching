<template>
    <div>
        <select name="gradingType" @change="updateGradingType">
            <option v-for="gradingType in gradingTypes" :value="gradingType.value"
                    :selected="gradingType.value === selectedGradingType">{{ gradingType.name }}
            </option>
        </select>
        <div
            class="mt-4"
            v-if="this.selectedGradingType && this.selectedGradingType === 'pipeline_success'">
            <p class="text-gray-200 font-light text-sm">Tasks will automatically be graded with a pass or fail based on the latest pipeline run status.</p>
        </div>
        <div
            class="mt-4"
            v-if="this.selectedGradingType && this.selectedGradingType === 'all_subtasks'">
            <p class="text-gray-200 font-light text-sm">Tasks will automatically be graded with a pass or fail based on if the student succeeds all subtasks.</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        gradingTypes: {
            type: Array,
            required: true
        },
        currentGradingType: {
            type: String,
            required: false,
        }
    },
    methods: {
        updateGradingType(event) {
            this.selectedGradingType = event.target.value;
        }
    },
    data() {
        return {
            selectedGradingType: this.currentGradingType // The value of the enum.
        }
    },
}
</script>
