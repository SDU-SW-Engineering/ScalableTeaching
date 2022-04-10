<template>
<div>
    <div>
        <button @click="saveChanges" class="py-2 px-4 bg-lime-green-400 mb-4">Save changes</button>
    </div>
    <div v-for="group in groups" class="dark:bg-gray-600 flex flex-col px-4 py-4 rounded-md mb-4">
        <div class="flex justify-between items-start w-full">
            <input v-if="group.editing" class="w-80 border-none focus:outline-none px-1 bg-gray-700 text-white" @keydown.enter="group.editing = false" v-model="group.name"/>
            <span @click="group.editing = true" v-else class="dark:text-white cursor-pointer">{{ group.name}}</span>
            <span class="font-thin text-lg text-lime-green-400">{{ groupPoints(group) }} pts</span>
        </div>
        <div class="grid w-full grid-cols-1 gap-3">
            <div v-for="task in group.tasks" @click="task.editing = true" :class="{'cursor-pointer hover:shadow-md': !task.editing}" class="flex border justify-between items-center border-lime-green-400 bg-gray-700 px-2 py-2 mt-2 text-white break-all rounded-md ">
                <textarea rows="3" class="bg-gray-800 border-none rounded-sm" v-model="task.name" v-if="task.editing" placeholder="Type description here..."></textarea>
                <span v-else class="font-light">{{ task.name }}</span>
                <div @keydown.enter="task.editing = false" v-if="task.editing" class="my-4 text-center text-lime-green-300">
                    <input v-model="task.points" type="number" class="bg-gray-800 border-none w-20 rounded-sm font-bold"/>
                    <span class="ml-2">pts</span>
                </div>
                <span v-else class="text-center flex-shrink-0 text-lg font-bold text-lime-green-300">{{ task.points }} pts</span>
                <button @click.stop="task.editing = false" class="hover:bg-lime-green-500 bg-lime-green-400 rounded-sm my-0.5" v-if="task.editing">Done</button>
                <button @click.stop="deleteTask(group, task)" class="hover:bg-red-800 bg-red-500 mt-4 rounded-sm my-0.5" v-if="task.editing">Delete</button>
            </div>
            <div @click="newTask(group)" class="flex cursor-pointer hover:shadow-xl opacity-60 hover:opacity-100 transition-opacity items-center justify-center border border-lime-green-400 flex-col bg-gray-700 px-4 py-4 mt-2  text-white break-all rounded-md ">
                <span class="font-light text-lg mb-2">New task</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-lime-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
    <div @click="newGroup()" class="dark:bg-gray-600 opacity-60 hover:opacity-100 flex justify-between items-center px-4 py-4 rounded-md transition-opacity cursor-pointer">
        <span class="dark:text-white">Create Group</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-lime-green-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
        </svg>
    </div>
</div>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true
        },
        subTasks: {
            type: Array,
            required: true
        }
    },
    methods: {
        newTask: function(group) {
            group.tasks.push({
                id: null,
                name: "",
                points: 0,
                editing: true
            })
        },
        newGroup: function() {
            this.groups.push({
                name: "",
                tasks: [],
                editing: true
            })
        },
        deleteTask: function(group, task) {
            group.tasks = group.tasks.filter(t => t.name !== task.name);
        },
        groupPoints: function(group) {
            return group.tasks.map(t => Number(t.points)).reduce((a,b) => a + b, 0);
        },
        saveChanges: async function()
        {
            await axios.post(`/courses/${this.task.course_id}/tasks/${this.task.id}/analytics/sub-tasks`, this.groups);
        }
    },
    data() {
        return {
            groups: [
                {
                    name: "1A: public class Brewery",
                    editing: false,
                    tasks: [
                        {
                            id: null,
                            name: "Constructor with relevant parameters and variables instantiation in 2 constructor",
                            points: 3,
                            editing: false
                        }
                    ]
                },
                {
                    editing: false,
                    name: "1B: public class BreweriesAndBeers",
                    tasks: [
                    ]
                }
            ]
        }
    },
    mounted() {
        this.groups = this.subTasks;
    }
}
</script>
