<template>
    <div class="grid md:grid-cols-1 xl:grid-cols-2 gap-4">
        <div class="flex flex-col justify-between">
            <div>
                <div class="flex items-center mb-2">
                    <p class="text-black dark:text-white mr-2">Correction type:</p>
                    <select v-model="correctionType"
                            class="py-0 text-black bg-gray-200 dark:bg-gray-700 dark:text-white border-none rounded-sm mr-2">
                        <option value="pipeline_success">Pipeline succeeds (default)</option>
                        <option value="all_tasks">All</option>
                        <option value="number_of_tasks">Number of tasks</option>
                        <option value="required_tasks">Required tasks</option>
                        <option value="points_required">Points</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'pipeline_success'">Task will be considered completed when one pipeline succeeds.</p>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'all_tasks'">All sub-tasks must be completed for the
                    task to be considered complete.</p>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'number_of_tasks'"><b>{{ numberOfTasks }}</b> sub-tasks
                    must be completed for the
                    task to be considered complete.</p>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'required_tasks'">Only sub-tasks marked as required
                    must
                    be completed for the task to be considered complete.</p>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'points_required'">Students need to reach
                    <b>{{ pointThreshold }}</b> points for the
                    task to be considered complete.</p>
                <p class="text-sm text-gray-400 dark:text-gray-300" v-if="correctionType === 'manual'">Tasks are manually graded by designated people attached to the course.</p>
                <div class="mt-4" v-if="correctionType === 'number_of_tasks'">
                    <label
                        class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Number of tasks</label>
                    <input type="number" v-model="numberOfTasks" min="0" :max="maxNumber" class="bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                </div>
                <div class="mt-4" v-if="correctionType === 'points_required'">
                    <label
                        class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Points needed</label>
                    <input type="number" v-model="pointThreshold" min="0" :max="maxPoints" class="bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" @click="saveSubtasks" v-text="saving ? 'Saving...' : 'Save Changes'"
                        class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg px-3 py-2 text-center transition-colors">
                </button>
                <p v-if="saved" class="text-gray-300 text-sm mt-2"><i class="bx text-lg bx-check text-lime-green-400"></i> changes saved</p>
            </div>
        </div>
        <div class="">
            <p class="text-sm dark:text-white" v-if="correctionType !== 'manual'">We found the following tasks within the <code>.gitlab-ci.yml</code>
                file. Please pick relevant tasks</p>
            <div class="flex mt-4 flex-col w-full shadow-md"
                 v-for="(task, index) in subTasks">
                <div
                    class="bg-gray-300 dark:bg-gray-800 py-2 px-4 text-gray-700 dark:text-white cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-900 flex items-center justify-between"
                    :class="{ 'rounded': !task.isSelected, 'rounded-t': task.isSelected }"
                    @click="task.isSelected = !task.isSelected">
                    <div class="flex items-center">
                        <i :class="{ 'bx-check bx-sm text-lime-green-500 dark:text-lime-green-400': task.isSelected, 'bx-x bx-sm text-red-400': !task.isSelected }"
                           class="bx mr-2"></i> <span
                        :class="{ 'line-through text-gray-400': task.alias !== '' }">{{ task.name }}</span> <i
                        v-if="task.alias !== ''" class="bx bx-chevron-right"></i>
                        <span v-if="task.alias !== ''">{{ task.alias }}</span>
                    </div>
                    <span v-if="correctionType==='required_tasks' && task.required && task.isSelected"
                          class="text-red-500 text-2xl -mt-1">∗</span>
                </div>
                <transition name="slide">
                    <div class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-b grid"
                         :class="{'grid-cols-2 gap-4': correctionType === 'points_required' || correctionType === 'required_tasks'}"
                         v-if="task.isSelected">
                        <div>
                            <label
                                class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Alias</label>
                            <input maxlength="70" type="text" name="name" v-model="task.alias" class="bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div v-if="correctionType === 'points_required'">
                            <label
                                class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Points</label>
                            <input min="0" type="number" v-model="task.points" class="bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div v-if="correctionType === 'required_tasks'">
                            <label
                                class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Required</label>
                            <select v-model="task.required"
                                    class="bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                                <option :value="true">Yes</option>
                                <option :value="false">No</option>
                            </select>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import _ from "lodash";

export default {
    props: ['tasks', 'task'],
    data() {
        return {
            saving: false,
            saved: false,
            subTasks: [],
            correctionType: 'all_tasks',
            numberOfTasks: 0,
            pointThreshold: 0
        }
    },
    computed: {
        maxNumber: function () {
            return _.filter(this.subTasks, (task) => task.isSelected === true).length;
        },
        maxPoints: function () {
            let sum = 0;

            _.filter(this.subTasks, (task) => task.isSelected === true).forEach(function (task) {
                sum += Number(task.points);
            });

            return sum;
        }
    },
    methods: {
        saveSubtasks: async function () {
            this.saved = false;
            if (this.saving)
                return;
            this.saving = true;
            await axios.post(`/courses/${this.task.course_id}/manage/tasks/${this.task.id}/subtasks`, {
                tasks: this.subTasks,
                correctionType: this.correctionType,
                requiredTasks: this.numberOfTasks,
                requiredPoints: this.pointThreshold
            });
            this.saving = false;
            this.saved = true;
        }
    }
    ,
    mounted() {
        this.correctionType = this.task.correction_type;
        this.numberOfTasks = this.task.correction_tasks_required;
        this.pointThreshold = this.task.correction_points_required;
        _.each(this.tasks, (task) => this.subTasks.push({
            id: task.id,
            name: task.name,
            alias: task.alias ?? '',
            isSelected: task.isSelected,
            required: task.isRequired,
            points: task.points
        }))
    }
}
</script>

<style>
.slide-enter-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: ease-in;
    -webkit-transition-timing-function: ease-in;
    -o-transition-timing-function: ease-in;
    transition-timing-function: ease-in;
}

.slide-leave-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to, .slide-leave {
    max-height: 100px;
    overflow: hidden;
}

.slide-enter, .slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
