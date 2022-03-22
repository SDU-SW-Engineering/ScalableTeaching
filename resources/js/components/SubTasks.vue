<template>
    <div class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800 flex">
        <div class="w-24 mr-4" v-if="projectStatus !== null">
            <simple-doughnut-chart :secondary="[ended ?'#f87171' : '#374151']" style="width: 100%" :data="[tasks.progress, 100 - tasks.progress]"></simple-doughnut-chart>
        </div>
        <div class="flex-1">
            <div class="flex">
                <div class="flex-1">
                    <h1 class="text-black dark:text-white text-2xl font-medium" v-if="correctionType === 'points_required'">{{ pointSum }}/{{ pointMax }} points</h1>
                    <h1 class="text-black dark:text-white text-2xl font-medium" v-if="correctionType === 'all_tasks' || correctionType === 'required_tasks' || correctionType === 'number_of_tasks' || correctionType === 'manual'">Tasks</h1>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'all_tasks'">All tasks required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'required_tasks'">Specific tasks required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'number_of_tasks'"><b>{{ tasksRequired }}</b> tasks required</h2>
                    <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'points_required'"><b>{{ pointsRequired }}</b> points required to complete</h2>
                    <div v-if="projectStatus != null">
                        <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'manual' && !graded">Your assignment has <strong class="text-lime-green-500 dark:text-lime-green-400">not</strong> been graded yet.</h2>
                        <h2 class="text-gray-600 dark:text-gray-300 text-lg" v-if="correctionType === 'manual' && graded">Your assignment has been graded.</h2>
                    </div>
                </div>
                <h3 v-if="graded" class="font-thin dark:text-lime-green-400 text-2xl flex-shrink-0">{{ pointSum }} / {{ pointMax }} points</h3>
            </div>
            <div v-if="tasks.gradeDelegations != null && tasks.gradeDelegations.length > 0" class="text-sm mt-2 text-black dark:text-gray-200">
                Graded by:
                <ul>
                    <li class="text-black dark:text-gray-300" v-for="gradeDelegation in tasks.gradeDelegations"><strong class="text-lime-green-600 dark:text-lime-green-400">{{ gradeDelegation.by }}</strong> (id: <i>{{ gradeDelegation.identifier }})</i></li>
                </ul>
                <span class="text-xs text-gray-500 dark:text-gray-400">Use the id when communicating with the grader.</span>
            </div>

            <div class="mt-4" v-if="tasks.list.length === 1">
                <div v-for="task in tasks.list" class="flex items-center bg-gray-300 dark:bg-gray-600 rounded-lg mb-4 w-full py-2">
                    <i class="bx bx-x text-3xl w-12 text-center text-red-400" v-if="ended && !task.completed"></i>
                    <i class="bx bx-check text-3xl w-12 text-center" v-else :class="[ task.completed ? 'text-lime-green-300' : 'text-gray-400' ]"></i>
                    <div class="flex flex-col">
                        <span class="text-black dark:text-white text-md">{{ task.name }}</span>
                        <span v-if="correctionType === 'required_tasks' && task.required" class="text-gray-500 dark:text-gray-400"><i>Required</i></span>
                        <span v-if="correctionType === 'required_tasks' && !task.required" class="text-gray-500 dark:text-gray-400"><i>Not required</i></span>
                        <span v-if="correctionType === 'points_required'" class="text-gray-500 dark:text-gray-400">{{ task.points }} points</span>
                    </div>
                    <div class="flex-1 flex flex-col text-right mr-4">
                        <span class="text-gray-700 dark:text-white text-md">Completed</span>
                        <span class="text-gray-500 dark:text-gray-400">{{ task.when == null ? '-' : task.when }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div v-for="group in tasks.list" class="flex flex-col bg-white dark:bg-gray-600 rounded-lg mb-4 w-full py-2 px-4 shadow-md border dark:border-none">
                    <h1 class="font-medium text-lg text-black dark:text-gray-200">{{ group.group }}</h1>
                    <div class="flex flex-col">
                        <ul>
                            <li class="flex justify-between items-center hover:bg-gray-200 dark:hover:bg-gray-700 rounded-sm" v-for="task in group.tasks">
                                <div class="flex items-center">
                                    <svg v-if="ended && !task.completed && projectStatus != null" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <svg v-else-if="ended && task.completed && projectStatus != null"  class="h-4 w-4 text-lime-green-600 mr-1 flex-shrink-0"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-xs mr-2 text-black dark:text-gray-300">{{ task.name }}</span>
                                </div>
                                <span class="text-xs py-0.5 text-black dark:text-gray-300 font-medium">{{ task.points}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-between font-bold text-black dark:text-gray-200" v-if="projectStatus != null">
                        <span>Total</span>
                        <span>{{ completedPoints(group) }}/{{ maxPoints(group) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['tasks', 'correctionType', 'tasksRequired', 'pointsRequired', 'ended', 'projectStatus'],
    computed: {
        pointSum: function() {
            return this.tasks.list.reduce((total, group) => {
                return total + group.tasks.filter(t => t.completed).reduce((total, c) => total + c.points, 0);
            }, 0)
        },
        pointMax: function() {
            return this.tasks.list.reduce((total, group) => {
                return total + group.tasks.reduce((total, c) => total + c.points, 0);
            }, 0)
        },
        graded: function() {
            if (this.projectStatus === null)
                return false;
            if (this.correctionType === 'manual')
                return this.projectStatus === 'finished';

            return true;
        }
    },
    methods: {
        maxPoints: function(group)
        {
            return group.tasks.map(g => g.points).reduce((a,b) => a+b);
        },
        completedPoints: function(group)
        {
            let completed = group.tasks.filter(g => g.completed);
            if (completed.length === 0)
                return 0;
            return completed.map(g => g.points).reduce((a,b) => a+b);
        }
    }
}
</script>
