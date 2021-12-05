<template>
    <div>
        <modal @cancel="selectedStudent = null" v-if="selectedStudent !== null" :title="'Edit grading for ' + selectedStudent.student.name" type="info">
            <div class="mt-4">
                <div v-for="task in selectedStudent.tasks" class="flex justify-between items-center bg-gray-900 px-3 py-2 mb-2 rounded-lg">
                    <span class="text-gray-300">{{ task.task.name }}</span>
                    <div>
                        <select v-model="task.grade" class="py-0 bg-gray-900 text-gray-400 focus:ring-lime-green-500 rounded-sm border-gray-600">
                            <option value="overdue">Overdue</option>
                            <option value="finished">Finished</option>
                            <option value="active">Active</option>
                            <option :value="null">Unbegun</option>
                        </select>
                    </div>
                </div>
            </div>
        </modal>
        <div class="flex flex-col bg-gray-700 rounded-md px-4 py-3 mb-3">
            <div class="flex justify-between items-start mb-2">
                <span class="text-sm text-gray-400">Filter</span>
                <div>
                    <button v-if="filtersApplied" @click="resetFilters()" class="hover:bg-gray-600 rounded-lg p-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <button @click="expanded = !expanded" class="hover:bg-gray-600 rounded-lg p-0.5">
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
                    <div class="flex items-center bg-gray-800 rounded-lg p-3 mt-3" v-for="(taskName, taskId) in tasks">
                        <span class="text-sm text-gray-200 flex-grow">{{ taskName }}</span>
                        <div>
                            <button @click="$set(toggleTasks[taskId], 'unbegun', !toggleTasks[taskId].unbegun)"
                                    :class="[toggleTasks[taskId].unbegun ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-600']"
                                    class="text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Unbegun
                            </button>
                            <button
                                @click="$set(toggleTasks[taskId], 'overdue', !toggleTasks[taskId].overdue)"
                                :class="[toggleTasks[taskId].overdue ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-600']"
                                class="text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Failed
                            </button>
                            <button
                                @click="$set(toggleTasks[taskId], 'active', !toggleTasks[taskId].active)"
                                :class="[toggleTasks[taskId].active ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-600']"
                                class="text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                In
                                Progress
                            </button>
                            <button
                                @click="$set(toggleTasks[taskId], 'finished', !toggleTasks[taskId].finished)"
                                :class="[toggleTasks[taskId].finished ? 'bg-lime-green-400 hover:bg-lime-green-500' : 'hover:bg-gray-600']"
                                class="text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors">
                                Finished
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <table class="w-full text-white">
            <thead>
            <tr>
                <th class="text-left">Student ({{ filteredGrades.length }})</th>
                <th v-for="task in tasks">{{ task }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="grade in filteredGrades" class="hover:bg-gray-700 cursor-pointer" @click="selectedStudent = grade">
                <td class="py-2 px-1">{{ grade.student.name }}</td>
                <td class="text-center" v-for="task in grade.tasks">
                    <svg v-if="task.grade === 'finished'" xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-full text-lime-green-300" fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    <svg v-else-if="task.grade === 'overdue'" xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-full text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <svg v-else-if="task.grade === 'active'" xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-full text-blue-300"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-full text-gray-300" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import _ from "lodash";
import Modal from "./Modal/Modal";

export default {
    components: {Modal},
    props: {
        grades: {
            type: Object,
            required: true
        },
        tasks: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            expanded: false,
            filter: "",
            toggleTasks: {},
            selectedStudent: null
        }
    },
    methods: {
        resetFilters: function () {
            for (const [taskId, taskName] of Object.entries(this.tasks)) {
                this.$set(this.toggleTasks, taskId, {
                    unbegun: false,
                    finished: false,
                    active: false,
                    overdue: false
                })
                this.filter = ""
            }
        }
    },
    computed: {
        filtersApplied: function() {
            if (this.filter !== "")
                return true;

            for (const [taskId, taskName] of Object.entries(this.tasks)) {
                if (this.toggleTasks[taskId] === undefined)
                    continue;

                if (!(this.toggleTasks[taskId].unbegun === false
                    && this.toggleTasks[taskId].finished === false
                    && this.toggleTasks[taskId].active === false
                    && this.toggleTasks[taskId].overdue === false))
                    return true;
            }

            return false;
        },
        filteredGrades: function () {
            return _.filter(this.grades, function (grade) {
                let found = (new RegExp(this.filter, "i")).test(grade.student.name);

                for (const task of grade.tasks) {

                    if (this.toggleTasks[task.task.id] === undefined)
                        continue;
                    if (this.toggleTasks[task.task.id].unbegun === false
                        && this.toggleTasks[task.task.id].finished === false
                        && this.toggleTasks[task.task.id].active === false
                        && this.toggleTasks[task.task.id].overdue === false)
                        continue;
                    let lookFor = task.grade === null ? 'unbegun' : task.grade;
                    found &= this.toggleTasks[task.task.id][lookFor];
                }

                return found;
            }.bind(this));
        }
    },
    mounted() {
        for (const [taskId, taskName] of Object.entries(this.tasks)) {
            this.$set(this.toggleTasks, taskId, {
                unbegun: false,
                finished: false,
                active: false,
                overdue: false
            })
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
