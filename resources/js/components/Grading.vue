<template>
    <div>
        <modal
            @cancel="closeModal"
            v-if="selectedStudent !== null"
            :title="'Edit grading for ' + selectedStudent.student.name"
            type="info"
        >
            <div class="mt-4">
                <div
                    v-for="task in selectedStudent.tasks"
                    class="flex flex-col bg-gray-100 dark:bg-gray-900 px-3 py-2 mb-2 rounded-lg group"
                >
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <span
                                class="text-gray-600 dark:text-gray-300 mr-1"
                                >{{ task.task.name }}</span
                            >
                            <button
                                v-if="task.grade != null"
                                @click="toggleHistory(task)"
                                class="hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-0.5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="h-4 w-4 text-gray-400 transition-transform"
                                    :class="{
                                        'transform rotate-180': task.history,
                                    }"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                        <div v-if="task.adding">
                            <div
                                v-if="task.saving"
                                class="text-black dark:text-white flex items-center"
                            >
                                <svg
                                    class="animate-spin -ml-1 mr-2 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                <span class="text-sm">Saving...</span>
                            </div>
                            <div class="flex items-center" v-else>
                                <select
                                    v-model="task.saveAs"
                                    class="py-0 text-black dark:bg-gray-700 dark:text-white border-none rounded-sm mr-2"
                                >
                                    <option value="passed">Passed</option>
                                    <option value="failed">Failed</option>
                                </select>
                                <button @click="saveGrade(task)" class="mr-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-lime-green-400 hover:text-lime-green-300"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                </button>
                                <button @click="task.adding = false">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-red-500 hover:text-red-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div v-else>
                            <div
                                v-if="task.grade != null"
                                class="flex items-center"
                            >
                                <button
                                    @click="task.adding = true"
                                    class="hover:bg-gray-200 dark:hover:bg-gray-400 rounded-sm mr-2 text-gray-400 dark:text-white hidden group-hover:block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                        />
                                    </svg>
                                </button>
                                <span
                                    :class="{
                                        'text-lime-green-300':
                                            task.grade.value === 'passed',
                                        'text-red-400':
                                            task.grade.value === 'failed',
                                    }"
                                    v-text="task.grade.value"
                                ></span>
                            </div>
                            <div class="flex items-center" v-else>
                                <button
                                    class="hover:bg-gray-200 dark:hover:bg-gray-400 rounded-sm text-gray-400 dark:text-white"
                                    @click="task.adding = true"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <transition name="slide">
                        <div
                            class="flex flex-col mt-2"
                            v-if="task.grade != null"
                            v-show="task.history"
                        >
                            <div
                                v-if="task.historyEntries == null"
                                class="flex mb-1 flex-col text-white text-sm justify-between bg-gray-200 dark:bg-gray-800 px-2 py-2 rounded-md animate-pulse"
                            >
                                <div class="flex justify-between h-5">
                                    <div class="flex">
                                        <div
                                            class="bg-gray-300 dark:bg-gray-600 rounded-md"
                                            style="width: 40px"
                                        ></div>
                                    </div>
                                    <div class="flex">
                                        <div
                                            class="bg-gray-300 dark:bg-gray-600 rounded-md"
                                            style="width: 50px"
                                        ></div>
                                    </div>
                                </div>
                                <div
                                    class="bg-gray-300 dark:bg-gray-600 rounded-md h-4 mt-2"
                                    style="width: 60px"
                                ></div>
                            </div>
                            <div v-else class="mb-1">
                                <div
                                    class="flex text-gray-700 dark:text-white text-sm border justify-between bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer px-2 py-1 rounded-md"
                                    :class="{
                                        'mt-2': index > 0,
                                        'border-lime-green-300 dark:border-lime-green-700':
                                            entry.selected,
                                        'border-gray-300 dark:border-gray-700':
                                            !entry.selected,
                                    }"
                                    @click="setSelectedGrade(entry, task)"
                                    v-for="(
                                        entry, index
                                    ) in task.historyEntries"
                                >
                                    <div>
                                        <div>
                                            <b>Grade:</b>
                                            <span
                                                :class="{
                                                    'text-lime-green-300':
                                                        entry.value ===
                                                        'passed',
                                                    'text-red-400':
                                                        entry.value ===
                                                        'failed',
                                                }"
                                                >{{ entry.value }}</span
                                            >
                                        </div>
                                        <span class="text-xs text-gray-400">{{
                                            new Date(
                                                entry.created_at
                                            ).toDateString()
                                        }}</span>
                                    </div>
                                    <div>
                                        <b>Source:</b>
                                        <span>{{
                                            entry.source_type | lastPart
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
            <transition name="slide">
                <div
                    class="flex text-sm text-white items-center"
                    v-if="showNewTip"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 text-blue-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span class="ml-2 text-xs text-black dark:text-gray-300"
                        >User assigned grades takes precedence over other
                        assigned grades.</span
                    >
                </div>
            </transition>
        </modal>
        <div
            class="flex flex-col shadow-s bg-gray-200 dark:bg-gray-700 rounded-md px-4 py-3 mb-3"
        >
            <div class="flex justify-between items-start mb-2">
                <span class="text-sm text-black dark:text-gray-400"
                    >Filter</span
                >
                <div>
                    <button
                        v-if="filtersApplied"
                        @click="resetFilters()"
                        class="hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg p-0.5"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                    <button
                        @click="expanded = !expanded"
                        class="hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg p-0.5"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400 transition-transform"
                            :class="{ 'transform rotate-180': expanded }"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <input
                type="text"
                placeholder="Name"
                v-model="filter"
                class="mb-3 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-600 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
            />
            <transition name="slide">
                <div v-if="expanded">
                    <div
                        :class="{
                            'opacity-50':
                                taskId in toggleTasks &&
                                toggleTasks[taskId].hidden,
                        }"
                        class="flex items-center transition-opacity justify-between border dark:border-none bg-gray-300 dark:bg-gray-800 rounded-lg p-3 mt-3"
                        v-for="(taskName, taskId) in tasks"
                    >
                        <div class="flex items-center">
                            <button
                                @click="
                                    $set(
                                        toggleTasks[taskId],
                                        'hidden',
                                        !toggleTasks[taskId].hidden
                                    )
                                "
                                :class="[
                                    toggleTasks[taskId].hidden
                                        ? 'bg-gray-800 hover:bg-gray-700 text-white'
                                        : 'hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800',
                                ]"
                                class="dark:text-white text-sm px-1.5 py-0.5 mr-2 rounded-lg transition-colors"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z"
                                    />
                                    <path
                                        d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z"
                                    />
                                    <path
                                        d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z"
                                    />
                                </svg>
                            </button>
                            <span
                                class="text-sm text-gray-600 dark:text-gray-200 flex-grow"
                                >{{ taskName }}</span
                            >
                        </div>

                        <div>
                            <button
                                @click="
                                    $set(
                                        toggleTasks[taskId],
                                        'failed',
                                        !toggleTasks[taskId].failed
                                    )
                                "
                                :class="[
                                    toggleTasks[taskId].failed
                                        ? 'bg-lime-green-400 hover:bg-lime-green-500'
                                        : 'hover:bg-gray-400 dark:hover:bg-gray-600',
                                ]"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors"
                            >
                                Failed
                            </button>
                            <button
                                @click="
                                    $set(
                                        toggleTasks[taskId],
                                        'passed',
                                        !toggleTasks[taskId].passed
                                    )
                                "
                                :class="[
                                    toggleTasks[taskId].passed
                                        ? 'bg-lime-green-400 hover:bg-lime-green-500'
                                        : 'hover:bg-gray-400 dark:hover:bg-gray-600',
                                ]"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors"
                            >
                                Passed
                            </button>
                            <button
                                @click="
                                    $set(
                                        toggleTasks[taskId],
                                        'missing',
                                        !toggleTasks[taskId].missing
                                    )
                                "
                                :class="[
                                    toggleTasks[taskId].missing
                                        ? 'bg-lime-green-400 hover:bg-lime-green-500'
                                        : 'hover:bg-gray-400 dark:hover:bg-gray-600',
                                ]"
                                class="text-gray-800 dark:text-white text-sm px-1.5 py-0.5 rounded-lg transition-colors"
                            >
                                Missing
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full table-fixed text-gray-800 dark:text-white">
                <thead>
                    <tr>
                        <th class="text-left w-60">
                            Student ({{ filteredGrades.length }})
                        </th>
                        <th class="w-40" v-for="task in shownTasks">
                            {{ task }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="gradeEntry in filteredGrades"
                        class="hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                        @click="selectedStudent = gradeEntry"
                    >
                        <td class="py-2 px-1 font-medium">
                            {{ gradeEntry.student.name }}
                        </td>
                        <td
                            class="text-center"
                            v-for="task in gradeEntry.tasks"
                        >
                            <svg
                                v-if="
                                    task.grade != null &&
                                    task.grade.value === 'passed'
                                "
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-full text-lime-green-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <svg
                                v-else-if="
                                    task.grade != null &&
                                    task.grade.value === 'failed'
                                "
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-full text-red-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import _ from "lodash";
import Modal from "./Modal/Modal";
import ModalButton from "./Modal/ModalButton";

export default {
    components: { ModalButton, Modal },
    props: {
        grades: {
            type: Object,
            required: true,
        },
        tasks: {
            type: Object,
            required: true,
        },
        courseId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            expanded: false,
            filter: "",
            toggleTasks: {},
            selectedStudent: null,
            gradeHistory: null,
        };
    },
    methods: {
        resetFilters: function () {
            for (const [taskId, taskName] of Object.entries(this.tasks)) {
                this.$set(this.toggleTasks, taskId, {
                    passed: false,
                    failed: false,
                    missing: false,
                });
                this.filter = "";
            }
        },
        saveGrade: async function (task) {
            if (task.saveAs == null) return;
            task.saving = true;
            let response = await axios.put(
                `/courses/${this.courseId}/manage/grading/users/${this.selectedStudent.student.id}`,
                {
                    grade: task.saveAs,
                    taskId: task.task.id,
                }
            );
            let grades = await this.loadTaskHistory(task);
            task.saving = false;
            task.adding = false;
            task.grade = grades[0];
        },
        toggleHistory: async function (task) {
            task.history = !task.history;
            if (!(task.history === true && task.historyEntries == null)) return;

            await this.loadTaskHistory(task);
        },
        loadTaskHistory: async function (task) {
            let resp = await axios.get(
                `/courses/${this.courseId}/manage/grading/tasks/${task.task.id}`,
                {
                    params: {
                        user: this.selectedStudent.student.id,
                    },
                }
            );
            task.historyEntries = resp.data;
            return resp.data;
        },
        closeModal: function () {
            this.selectedStudent = null;
        },
        setSelectedGrade: async function (grade, task) {
            if (grade.selected) return;
            await axios.post(
                `/courses/${this.courseId}/manage/grading/${grade.id}/set-selected`
            );
            task.historyEntries.forEach(
                (entry) => (entry.selected = entry.id === grade.id)
            );
            task.grade = grade;
        },
    },
    computed: {
        shownTasks: function () {
            let shown = {};
            for (let taskId of Object.keys(this.tasks)) {
                if (this.toggleTasks[taskId].hidden) continue;
                shown[taskId] = this.tasks[taskId];
            }
            return shown;
        },
        filtersApplied: function () {
            if (this.filter !== "") return true;

            for (const [taskId, taskName] of Object.entries(this.tasks)) {
                if (this.toggleTasks[taskId] === undefined) continue;

                if (
                    !(
                        this.toggleTasks[taskId].failed === false &&
                        this.toggleTasks[taskId].passed === false &&
                        this.toggleTasks[taskId].missing === false
                    )
                )
                    return true;
            }

            return false;
        },
        filteredGrades: function () {
            let grades = {};
            for (let grade of Object.keys(this.grades)) {
                let currentStudent = this.grades[grade];
                grades[grade] = {
                    student: currentStudent.student,
                    tasks: currentStudent.tasks.filter(
                        (t) => !this.toggleTasks[t.task.id].hidden
                    ),
                };
            }

            return _.filter(
                grades,
                function (grade) {
                    let found = new RegExp(this.filter, "i").test(
                        grade.student.name
                    );

                    for (const task of grade.tasks) {
                        if (this.toggleTasks[task.task.id] == null) continue;

                        if (
                            this.toggleTasks[task.task.id].failed === false &&
                            this.toggleTasks[task.task.id].passed === false &&
                            this.toggleTasks[task.task.id].missing === false
                        )
                            continue;
                        if (
                            task.grade == null &&
                            this.toggleTasks[task.task.id].missing === false
                        )
                            return false;

                        found &= this.toggleTasks[task.task.id].missing
                            ? task.grade?.value == null
                            : this.toggleTasks[task.task.id][task.grade.value];
                    }
                    return found;
                }.bind(this)
            );
        },
        showNewTip: function () {
            if (this.selectedStudent == null) return false;
            if (this.saved === true) return false;
            return this.selectedStudent.tasks.some((task) => task.adding);
        },
    },
    filters: {
        lastPart: function (value) {
            let position = value.lastIndexOf("\\");

            return value.substring(position + 1);
        },
    },
    mounted() {
        for (const [taskId, taskName] of Object.entries(this.tasks)) {
            this.$set(this.toggleTasks, taskId, {
                hidden: false,
                failed: false,
                passed: false,
                missing: false,
            });
        }
    },
};
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

.slide-enter-to,
.slide-leave {
    max-height: 100px;
    overflow: hidden;
}

.slide-enter,
.slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
