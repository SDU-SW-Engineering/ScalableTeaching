<template>
    <div class="flex flex-col bg-gray-800" style="width: 600px;">
        <div class="">
            <h2 class="text-xl font-medium text-white mb-2 p-2">Sub-tasks</h2>
            <div class="overflow-auto" style="height: calc(100vh - 164px)">
                <div v-for="group in subTasks" class="mb-4">
                    <div class="flex justify-between items-center">
                        <h3 v-text="group.group_name" class="text-gray-200 text-lg ml-2"></h3>
                        <div class="text-gray-400 ">
                            <span v-text="obtainedPoints(group.tasks)"></span>
                            <span> / </span>
                            <span v-text="maxPoints(group.tasks)"></span>
                        </div>
                    </div>
                    <div v-for="task in group.tasks"
                         :class="{'text-lime-green-400': task.points === task.maxPoints, 'text-gray-400': task.points === null, 'text-red-400': task.points === 0, 'text-yellow-400': task.points > 0 && task.points < task.maxPoints}"
                         class="my-2 flex flex-col items-center hover:bg-gray-900">
                        <div class="flex items-center justify-between w-full">
                            <button @click="toggleGrade(task)"
                                    class="flex py-2 pl-0.5 items-center cursor-pointer hover:bg-black w-full">
                                <span class="text-sm text-left" v-text="task.name"></span>
                            </button>
                            <div class="w-20 h-full text-right flex items-center text-sm ml-4 mr-1">
                                <button @click="promptForComment(task)" class="hover:bg-black p-1.5 mr-4 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-5 h-5 text-white">
                                        <path fill-rule="evenodd"
                                              d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button @click="promptForPoints(task)"
                                        class="flex hover:bg-black p-1.5 mr-4 rounded-full">
                                    <span v-text="Number(task.points)"></span>
                                    <span class="font-bold"> / </span>
                                    <span v-text="task.maxPoints"></span>
                                </button>
                            </div>
                        </div>
                        <div v-if="task.comment != null" class="flex w-full items-center my-1 px-3">
                            <p class="text-sm italic text-blue-300" v-text="task.comment"></p>
                            <button @click="clearComment(task)" class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-5 h-5 text-gray-400">
                                    <path fill-rule="evenodd"
                                          d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {bus} from "./Editor"

export default {
    props: {
        subTasks: {
            required: true
        },
    },
    methods: {
        maxPoints: function (tasks) {
            return tasks.reduce((acc, b) => acc + b.maxPoints, 0)
        },
        obtainedPoints: function (tasks) {
            return tasks.reduce((acc, b) => acc + (b.points ?? 0), 0)
        },
        toggleGrade: function (task) {
            if (task.points == null || task.points === 0)
                this.$set(task, 'points', task.maxPoints);
            else if (task.points === task.maxPoints)
                this.$set(task, 'points', 0);
            this.$forceUpdate();
            this.updateTotal()
        },
        promptForComment(task) {
            let comment = prompt("Enter comment:");
            if (comment == null)
                return;
            task.comment = comment;
            this.$forceUpdate();
        },
        promptForPoints(task) {
            let points = -1;
            while (points > task.maxPoints || points < 0 || isNaN(points)) {
                points = Number(prompt("Enter a between 0  and " + task.maxPoints));
            }
            task.points = points;
            this.updateTotal();
            this.$forceUpdate();
        },
        clearComment(task) {
            task.comment = null
            this.$forceUpdate();
        },
        updateTotal() {
            let pointSum = this.subTasks.reduce((total, group) => {
                return total + group.tasks.filter(t => t.points).reduce((total, c) => total + c.points, 0);
            }, 0)
            bus.$emit('currentPoints', pointSum);
        }
    }
}
</script>
