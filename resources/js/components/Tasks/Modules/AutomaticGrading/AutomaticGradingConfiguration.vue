<template>
    <div>
        <select name="gradingType" @change="updateGradingType" class="dark:bg-gray-600 rounded dark:text-gray-200">
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
        <div
            class="mt-4 rounded"
            v-if="this.selectedGradingType && this.selectedGradingType === 'required_subtasks'">
            <p class="text-gray-200 font-light text-sm">Tasks will automatically be graded with a pass or fail based on if the student completes all subtasks marked as required.</p>
            <div id="subtask-wrapper" class="mt-4 flex flex-col gap-2">
                <div v-for="subTask in subTasks" class="flex justify-between items-center dark:bg-gray-900 p-2 rounded">
                    <label :for="subTask.name" class="text-gray-200 font-heavy text-sm break-all">{{subTask.name}}</label>
                    <input class="cursor-pointer rounded text-lime-green-400 ml-2" type="checkbox" :id="subTask.name" name="requiredSubtaskIds[]" :value="subTask.id" :checked="mappedRequiredSubtaskIds.includes(subTask.id)"/>
                </div>
            </div>
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
        },
        subTasks: {
            type: Array,
            required: true
        },
        requiredSubtaskIds: {
            type: Array,
            required: true
        }
    },
    methods: {
        updateGradingType(event) {
            this.selectedGradingType = event.target.value;
        }
    },
    data() {
        return {
            selectedGradingType: this.currentGradingType, // The value of the enum.
            mappedRequiredSubtaskIds: this.requiredSubtaskIds.map((val) => Number(val))
        }
    },
}
</script>
