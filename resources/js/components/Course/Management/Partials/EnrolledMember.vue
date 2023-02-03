<template>
    <div v-if="booted"
         class="group flex justify-between items-center shadow border transition-colors border-gray-200 dark:border-gray-700 p-3 rounded-lg mb-4 mt-4 first:mt-0 last:mb-0 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-800">
        <div class="flex items-center">
            <div>
                <svg v-if="userInfo.avatar == null" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="currentColor"
                     class="text-lime-green-800 dark:text-lime-green-300 opacity-50 w-14 h-14">
                    <path fill-rule="evenodd"
                          d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                          clip-rule="evenodd"/>
                </svg>
                <img v-else class="w-14 h-14 rounded-full p-1" :src="userInfo.avatar"/>
            </div>
            <span class="text-lg ml-4 font-medium dark:text-white" v-text="member.name"></span>
        </div>
        <div class="flex items-center">
            <role-dropdown @new-role="newRole" :user-id="userInfo.id" :roles="availableRoles" :route="roleRoute"
                           :current-role="userInfo.role"></role-dropdown>
            <a :href="activityRoute + '?user=' + userInfo.id"
               class="justify-between flex transition-colors duration-200 focus:ring-4 focus:outline-none
                bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:ring-gray-300 dark:focus:ring-gray-600 text-gray-500 dark:text-gray-200
                border dark:border-gray-700 font-medium text-sm px-4 py-2.5 text-center inline-flex items-center"
               type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z"
                          clip-rule="evenodd"/>
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z"/>
                </svg>
            </a>
            <button @click="kick(userInfo)"
                    class="justify-between flex transition-colors duration-200 focus:ring-4 focus:outline-none
                bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500  rounded-r-lg  focus:ring-gray-300 dark:focus:ring-gray-600 text-gray-500 dark:text-gray-200
                border dark:border-gray-700 font-medium text-sm px-4 py-2.5 text-center inline-flex items-center"
                    type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import RoleDropdown from "./RoleDropdown.vue";
import {ref} from "vue";
import {User} from "../../../../Interfaces/Models/User";
import axios from "axios";
import {UserInfo} from "../Enrolled.vue"


const props = defineProps<{
    member: UserInfo
    availableRoles: object,
    roleRoute: string,
    kickRoute: string,
    activityRoute: string
}>()

const booted = ref<boolean>(true);
const userInfo = ref<UserInfo>(props.member);

function newRole(role : string) {
    userInfo.value.role = role;
}

async function kick(user : User)
{
    if (confirm("Are you sure you want to kick " + user.name + " from the course?") !== true)
        return;
    await axios.delete(props.kickRoute, {
        data: {
            user: user.id
        }
    })
    location.reload()
}
</script>
