<template>
    <div>
        <button @click="showSettings = true"
                class="bg-gray-400 hover:bg-gray-500 transition-colors items-center text-white flex p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
            </svg>
            <span>Group Settings</span>
        </button>
        <modal @cancel="showSettings = false" v-if="showSettings">
            <h2 class="dark:text-white text-lg font-medium">Group settings</h2>
            <div class="mt-2">
                <label for="max" class="block text-sm font-medium text-gray-900 dark:text-gray-400">Max groups</label>
                <p class="text-xs dark:text-gray-400 mb-1">The number of groups a user can be a member of</p>
                <div class="flex">
                    <select v-model="maxGroups" id="max" name="kind"
                            :class="[maxGroups === 'custom' ? 'rounded-l-lg w-3/5' : 'rounded-lg w-full' ]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-blue-500">
                        <option value="same_as_assignments">Same as assignments</option>
                        <option value="custom">Custom</option>
                        <option value="none">None</option>
                    </select>
                    <input v-if="maxGroups === 'custom'" v-model="custom" type="number"
                           class="bg-gray-50 w-2/5 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-blue-500"/>
                </div>
                <p v-if="maxGroups === 'same_as_assignments'" class="text-xs dark:text-blue-400 mt-1">
                    <span>Each user can have a different group for each assignment</span>
                </p>
            </div>
            <div v-if="maxGroups !== 'none'" class="mt-4">
                <label for="max" class="block text-sm font-medium text-gray-900 dark:text-gray-400">Group size</label>
                <p class="text-xs dark:text-gray-400 mb-1">The max number of members a group can contain</p>
                <input  v-model="groupSize" type="number"
                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-blue-500"/>
            </div>
            <template v-slot:buttons>
                <modal-button @click="save" :is-loading="saving" type="success">Save changes</modal-button>
            </template>
        </modal>
    </div>
</template>
<script>
import Modal from "../../Modal/Modal";
import ModalButton from "../../Modal/ModalButton";

export default {
    components: {ModalButton, Modal},
    props: {
        saveRoute: {
            required: true,
            type: String
        },
        maxGroupsInput: {
            required: true,
            type: String
        },
        maxGroupCustom: {
            required: true,
            type: Number
        },
        groupSizeInput: {
            required: true,
            type: Number
        }
    },
    methods: {
        save: async function () {
            this.saving = true;
            await axios.put(this.saveRoute, {
                'max-groups': this.maxGroups,
                'max-group-size': this.groupSize,
                'max-groups-amount': this.custom
            })
            location.reload()
        }
    },
    data() {
        return {
            showSettings: false,
            maxGroups: 'same_as_assignments',
            custom: 1,
            groupSize: 1,
            saving: false
        }
    },
    mounted() {
        this.maxGroups = this.maxGroupsInput;
        this.custom = this.maxGroupCustom;
        this.groupSize = this.groupSizeInput
    }
}
</script>
