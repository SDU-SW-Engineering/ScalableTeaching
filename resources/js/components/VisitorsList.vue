<template>
    <div>
        <div class="flex flex-col shadow-s bg-gray-200 dark:bg-gray-700 rounded-md px-4 py-3 mb-3">
            <div class="flex justify-between items-start mb-2">
                <span class="text-sm text-black dark:text-gray-400">Filter</span>
                <div>
                    <button v-if="filtersApplied" @click="resetFilters()" class="hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg p-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <button @click="expanded = !expanded" class="hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg p-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform"
                             :class="{'transform rotate-180': expanded}" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
            </div>
            <input type="text" placeholder="Name" v-model="filter"
                   class="mb-3 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-600  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"/>
            <transition name="slide">
                <div v-if="expanded">
                    <div class="flex items-center border dark:border-none bg-gray-300 dark:bg-gray-800 rounded-lg p-3 mt-3" v-for="(taskName, taskId) in tasks">
                        <span class="text-sm text-gray-600 dark:text-gray-200 flex-grow">{{ taskName }}</span>
                        <div>
                            <button
                                @click="$set(toggleTasks[taskId], 'failed', !toggleTasks[taskId].failed)"
                                :class="[toggleTasks[taskId].failed ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-400 dark:hover:bg-gray-600']"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Failed
                            </button>
                            <button
                                @click="$set(toggleTasks[taskId], 'passed', !toggleTasks[taskId].passed)"
                                :class="[toggleTasks[taskId].passed ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-400 dark:hover:bg-gray-600']"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Passed
                            </button>
                            <button
                                @click="$set(toggleTasks[taskId], 'missing', !toggleTasks[taskId].missing)"
                                :class="[toggleTasks[taskId].missing ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-400 dark:hover:bg-gray-600']"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Missing
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <table class="w-full text-gray-800 dark:text-white">
            <thead>
            <tr>
                <th class="text-left">Student ({{ students.length }})</th>
                <th>Viewed</th>
                <th>Completed</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students">
                <td class="py-2 px-1">{{ student.name }}</td>
            </tr>
            <tr v-for="visitor in visitors">
                <td class="py-2 px-1">{{ visitor.username }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import _ from "lodash";

export default {
    components: {},
    props: {
        students: {
            type: Array,
            required: true
        },
        visitors: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            expanded: false,
            filter: "",
        }
    },
    methods: {

    },
    computed: {
        filtersApplied: function () {
            if (this.filter !== "")
                return true;

            /*for (const [taskId, taskName] of Object.entries(this.tasks)) {
                if (this.toggleTasks[taskId] === undefined)
                    continue;

                if (!(this.toggleTasks[taskId].failed === false
                    && this.toggleTasks[taskId].passed === false
                    && this.toggleTasks[taskId].missing === false))
                    return true;
            }*/

            return false;
        },
        filteredGrades: function () {
            return _.filter(this.grades, function (grade) {
                let found = (new RegExp(this.filter, "i")).test(grade.student.name);

                for (const task of grade.tasks) {

                    if (this.toggleTasks[task.task.id] == null)
                        continue;

                    if (this.toggleTasks[task.task.id].failed === false
                        && this.toggleTasks[task.task.id].passed === false
                        && this.toggleTasks[task.task.id].missing === false)
                        continue;
                    if (task.grade == null && this.toggleTasks[task.task.id].missing === false)
                        return false;


                    found &= this.toggleTasks[task.task.id].missing
                        ? task.grade?.value == null
                        : this.toggleTasks[task.task.id][task.grade.value];
                }

                return found;
            }.bind(this));
        },
        showNewTip: function () {
            if (this.selectedStudent == null)
                return false;
            if (this.saved === true)
                return false;
            return this.selectedStudent.tasks.some(task => task.adding);
        }
    },
    filters: {
        lastPart: function (value) {
            let position = value.lastIndexOf("\\");

            return value.substring(position + 1);
        }
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
