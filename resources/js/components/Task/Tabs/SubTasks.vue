<template>
    <div class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800 flex">
        <div class="w-24 mr-4" v-if="projectStatus !== null">
            <simple-doughnut-chart v-if="correctionType === 'all_tasks'" :secondary="[ended ?'#f87171' : '#374151']" style="width: 100%"
                                   :data="[pointSum, lengthMax - pointSum]"></simple-doughnut-chart>
            <simple-doughnut-chart v-else :secondary="[ended ?'#f87171' : '#374151']" style="width: 100%"
                                   :data="[pointSum, pointMax - pointSum]"></simple-doughnut-chart>
        </div>
        <div class="flex-1">
            <div class="flex">
                <div class="flex-1">
                    <h1 class="text-black dark:text-white text-2xl font-medium"
                        v-if="correctionType === 'points_required'">{{ pointSum }}/{{ pointMax }} points</h1>
                    <h1 class="text-black dark:text-white text-2xl font-medium"
                        v-if="correctionType === 'all_tasks' || correctionType === 'required_tasks' || correctionType === 'number_of_tasks' || correctionType === 'manual'">
                        Tasks</h1>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'all_tasks'">All tasks
                        required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'required_tasks'">
                        Specific tasks required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'number_of_tasks'"><b>{{
                            tasksRequired
                        }}</b> tasks required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'points_required'"><b>{{
                            pointsRequired
                        }}</b> points required to complete</h2>
                    <div v-if="projectStatus != null">
                        <h2 class="text-gray-600 dark:text-gray-300 text-lg"
                            v-if="correctionType === 'manual' && !graded">Your assignment has <strong
                            class="text-lime-green-500 dark:text-lime-green-400">not</strong> been graded yet.</h2>
                        <h2 class="text-gray-600 dark:text-gray-300 text-lg"
                            v-if="correctionType === 'manual' && graded">Your assignment has been graded.</h2>
                    </div>
                </div>
                <h3 v-if="graded" class="font-thin dark:text-lime-green-400 text-2xl flex-shrink-0">
                    <span v-if="correctionType === 'all_tasks'">{{ pointSum }} / {{ lengthMax }}</span>
                    <span v-else>{{ pointSum }} / {{ pointMax }} points</span>
                </h3>
            </div>
            <div v-if="tasks.gradeDelegations != null && tasks.gradeDelegations.length > 0"
                 class="text-sm mt-2 text-black dark:text-gray-200">
                Graded by:
                <ul>
                    <li class="text-black dark:text-gray-300" v-for="gradeDelegation in tasks.gradeDelegations"><strong
                        class="text-lime-green-600 dark:text-lime-green-400">{{ gradeDelegation.by }}</strong> (id: <i>{{
                            gradeDelegation.identifier
                        }})</i></li>
                </ul>
                <span
                    class="text-xs text-gray-500 dark:text-gray-400">Use the id when communicating with the grader.</span>
            </div>

            <div class="mt-4" v-if="tasks.list.length === 1 && correctionType !== 'all_tasks'">
                <div v-for="task in tasks.list"
                     class="flex items-center bg-gray-300 dark:bg-gray-600 rounded-lg mb-4 w-full py-2">
                    <i class="bx bx-x text-3xl w-12 text-center text-red-400" v-if="ended && !task.completed"></i>
                    <i class="bx bx-check text-3xl w-12 text-center" v-else
                       :class="[ task.completed ? 'text-lime-green-300' : 'text-gray-400' ]"></i>
                    <div class="flex flex-col">
                        <span class="text-black dark:text-white text-md">{{ task.name }}</span>
                        <span v-if="correctionType === 'required_tasks' && task.required"
                              class="text-gray-500 dark:text-gray-400"><i>Required</i></span>
                        <span v-if="correctionType === 'required_tasks' && !task.required"
                              class="text-gray-500 dark:text-gray-400"><i>Not required</i></span>
                        <span v-if="correctionType === 'points_required'"
                              class="text-gray-500 dark:text-gray-400">{{ task.points }} points</span>
                    </div>
                    <div class="flex-1 flex flex-col text-right mr-4">
                        <span class="text-gray-700 dark:text-white text-md">Completed</span>
                        <span class="text-gray-500 dark:text-gray-400">{{ task.when == null ? '-' : task.when }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div v-for="group in tasks.list"
                     class="flex flex-col bg-white dark:bg-gray-600 rounded-lg mb-4 w-full py-2 px-4 shadow-md border dark:border-none">
                    <h1 class="font-medium text-lg text-black dark:text-gray-200">{{ group.group }}</h1>
                    <div class="flex flex-col">
                        <ul>
                            <li class="flex flex-col hover:bg-gray-200 dark:hover:bg-gray-700 rounded-sm"
                                v-for="task in group.tasks">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg
                                            v-if="ended && (task.pointsAcquired === null || task.pointsAcquired === 0) && projectStatus != null"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-red-400 mr-1 flex-shrink-0" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <svg
                                            v-else-if="ended && task.pointsAcquired < task.points  && projectStatus != null"
                                            class="h-4 w-4 text-yellow-400 mr-1 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <svg
                                            v-else-if="ended && task.pointsAcquired === task.points && projectStatus != null"
                                            class="h-4 w-4 text-lime-green-600 mr-1 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="text-xs mr-2 text-black dark:text-gray-300">{{ task.name }}</span>
                                    </div>
                                    <template v-if="correctionType === 'manual'">
                                        <span v-if="task.pointsAcquired === null"
                                              class="text-xs py-0.5 text-black dark:text-gray-400 font-medium">Ungraded</span>
                                        <span v-else class="text-xs py-0.5 text-black dark:text-gray-300 font-medium">{{
                                                task.pointsAcquired
                                            }}/{{ task.points }}</span>
                                    </template>
                                    <template v-else>
                                        <span v-if="task.pointsAcquired === null"
                                              class="text-xs py-0.5 text-black dark:text-gray-400 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-400 w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </span>
                                        <span v-else class="text-xs py-0.5 text-black dark:text-gray-300 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-lime-green-400 w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </span>
                                    </template>
                                </div>
                                <div class="flex ml-5 mb-0.5" v-for="comment in task.comments">
                                    <span class="mr-1 text-blue-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                        </svg>
                                    </span>
                                    <span class="text-xs text-blue-500">{{ comment.text }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-between font-bold text-black dark:text-gray-200"
                         v-if="projectStatus != null && correctionType === 'manual'">
                        <span>Total</span>
                        <span>{{ completedPoints(group) }}/{{ maxPoints(group) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {computed, defineAsyncComponent} from "vue";
import { SubTaskList } from "../../../Interfaces/SubTaskList"
import {SubTaskListItem} from "../../../Interfaces/SubTaskListItem";
import {GroupedSubTaskList} from "../../../Interfaces/GroupedSubTaskList";
import {GroupedSubTaskListGroup} from "../../../Interfaces/GroupedSubTaskListGroup";

const SimpleDoughnutChart = defineAsyncComponent(() => import('../../Charts/SimpleDoughnutChart.vue'))

const props = defineProps<{
    tasks: GroupedSubTaskList
    correctionType: 'manual',
    pointsRequired?: number,
    ended: boolean,
    projectStatus?: 'overdue' | 'finished',
    tasksRequired?: []
}>();

const pointSum = computed(() =>  props.tasks.list.reduce((total, group) => total + group.tasks.filter(t => t.pointsAcquired).reduce((total, c) => total + c.pointsAcquired, 0), 0));
const pointMax = computed(() =>  props.tasks.list.reduce((total, group) => total + group.tasks.reduce((total, c) => total + c.points, 0), 0))
const lengthMax = computed(() => this.tasks.list.reduce((total, group) => total + group.tasks.length, 0))
const graded = computed(() => {
    if (props.projectStatus === null)
        return false;
    if (props.correctionType === 'manual')
        return props.projectStatus === 'finished';

    return true;
})

function maxPoints(group: GroupedSubTaskListGroup)
{
    return group.tasks.map(g => g.points).reduce((a, b) => a + b);
}

function completedPoints(group: GroupedSubTaskListGroup)
{
    let completed = group.tasks.filter(g => g.pointsAcquired !== null || g.pointsAcquired === 0);
    if (completed.length === 0)
        return 0;

    return completed.map(g => g.pointsAcquired).reduce((a, b) => a + b);
}

</script>
