<template>
    <div class="bg-white p-4 rounded-md shadow-md dark:bg-gray-800 flex">
        <div class="w-24 mr-4">
            <simple-doughnut-chart :secondary="[ended ?'#f87171' : '#374151']" style="width: 100%" :data="[tasks.progress, 100 - tasks.progress]"></simple-doughnut-chart>
        </div>
        <div class="flex-1">
            <h1 class="text-white text-2xl font-bold" v-if="correctionType === 'points_required'">{{ pointSum }}/{{ pointMax }} points</h1>
            <h1 class="text-white text-2xl font-bold" v-if="correctionType === 'all_tasks' || correctionType === 'required_tasks' || correctionType === 'number_of_tasks'">Tasks</h1>
            <h2 class="text-gray-300 text-lg" v-if="correctionType === 'all_tasks'">All tasks required</h2>
            <h2 class="text-gray-300 text-lg" v-if="correctionType === 'required_tasks'">Specific tasks required</h2>
            <h2 class="text-gray-300 text-lg" v-if="correctionType === 'number_of_tasks'"><b>{{ tasksRequired }}</b> tasks required</h2>
            <h2 class="text-gray-300 text-lg" v-if="correctionType === 'points_required'"><b>{{ pointsRequired }}</b> points required to complete</h2>
            <div class="mt-4">
                <div v-for="task in tasks.list" class="flex items-center bg-gray-600 rounded-lg mb-4 w-full py-2">
                    <i class="bx bx-x text-3xl w-12 text-center text-red-400" v-if="ended && !task.completed"></i>
                    <i class="bx bx-check text-3xl w-12 text-center" v-else :class="[ task.completed ? 'text-lime-green-300' : 'text-gray-400' ]"></i>
                    <div class="flex flex-col">
                        <span class="text-white text-md">{{ task.name }}</span>
                        <span v-if="correctionType === 'required_tasks' && task.required" class="text-gray-400"><i>Required</i></span>
                        <span v-if="correctionType === 'required_tasks' && !task.required" class="text-gray-400"><i>Not required</i></span>
                        <span v-if="correctionType === 'points_required'" class="text-gray-400">{{ task.points }} points</span>
                    </div>
                    <div class="flex-1 flex flex-col text-right mr-4">
                        <span class="text-white text-md">Completed</span>
                        <span class="text-gray-400">{{ task.when == null ? '-' : task.when }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['tasks', 'correctionType', 'tasksRequired', 'pointsRequired', 'ended'],
    computed: {
        pointSum: function() {
            return this.tasks.list
                .filter(t => t.completed)
                .map(t => t.points)
                .reduce((sum, points) => sum + points);
        },
        pointMax: function() {
            return this.tasks.list
                .map(t => t.points)
                .reduce((sum, points) => sum + points);
        }
    }
}
</script>
