<template>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-6 items-start">
            <overview v-show="openedGroup == null" :createGroups="createGroups" :create-url="createUrl" :csrf="csrf"
                      :groups="groups" @groups-loaded="loadGroups" @open="open"></overview>
            <group-info v-if="openedGroup != null" :csrf="csrf" :group="openedGroup"
                        @close="openedGroup = null"></group-info>
            <invitation v-if="invitations.length > 0" v-for="invitation in invitations" :invitation="invitation"
                        :key="invitation.id"></invitation>
            <no-invitations v-if="invitations.length === 0"></no-invitations>
        </div>
    </div>
</template>

<script>
import Alert from "./Alert";
import Modal from "./Modal/Modal";
import ModalButton from "./Modal/ModalButton";
import Invitation from "./Groups/Invitation";
import NoInvitations from "./Groups/NoInvitations";
import Overview from "./Groups/Overview";
import GroupInfo from "./Groups/GroupInfo";

export default {
    components: {GroupInfo, Overview, NoInvitations, Invitation, ModalButton, Modal, Alert},
    props: ['csrf', 'createUrl', 'initialGroups', 'createGroups', 'initialInvitations'],
    data() {
        return {
            groups: [],
            invitations: [],
            openedGroup: null
        }
    },
    methods: {
        open: function (group) {
            this.openedGroup = group;
        },
        loadGroups: function (groups) {
            this.groups = groups;
        },
    },
    mounted() {
        this.groups = this.initialGroups;
        this.invitations = this.initialInvitations;
    }
}
</script>
