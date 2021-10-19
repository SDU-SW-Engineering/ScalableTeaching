<template>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-6 items-start">
            <overview v-show="openedGroup == null" :createGroups="createGroups" :create-url="createUrl" :csrf="csrf"
                      :groups="groups" @groups-loaded="loadGroups" @open="open"></overview>
            <group-info v-if="openedGroup != null" :csrf="csrf" :group="openedGroup"
                        @close="openedGroupIndex = null" @removeInvitation="removeInvitation" @invitedUser="addInvitation" @removeUser="removeUserFromGroup"></group-info>
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
import _ from "lodash";

export default {
    components: {GroupInfo, Overview, NoInvitations, Invitation, ModalButton, Modal, Alert},
    props: ['csrf', 'createUrl', 'initialGroups', 'createGroups', 'initialInvitations'],
    data() {
        return {
            groups: [],
            invitations: [],
            openedGroupIndex: null,
            count: 0
        }
    },
    computed: {
        openedGroup: function() {
            if (this.openedGroupIndex == null)
                return null;
            return _.find(this.groups, x => x.id === this.openedGroupIndex);
        }
    },
    methods: {
        open: function (group) {
            this.openedGroupIndex = group.id;
        },
        loadGroups: function (groups) {
            this.groups = groups;
        },
        removeInvitation: function(invitation) {
            let currentGroup = _.find(this.groups, x => x.id === invitation.group_id);
            if (currentGroup == null)
                return;

            this.$delete(currentGroup.invitations, _.findIndex(currentGroup.invitations, x => x.id === invitation.id))
        },
        addInvitation: function(invitation) {
            let currentGroup = _.find(this.groups, x => x.id === invitation.group_id);
            if (currentGroup == null)
                return;

            currentGroup.invitations.push(invitation);
        },
        removeUserFromGroup: function(response, user) {
            let currentGroup = _.find(this.groups, x => x.id === response.group_id);
            if (currentGroup == null)
                return;

            currentGroup.canDelete = response.canDelete;
            this.$delete(currentGroup.users, _.findIndex(currentGroup.users, x => x.id === user.id))
        }
    },
    mounted() {
        this.groups = this.initialGroups;
        this.invitations = this.initialInvitations;
    }
}
</script>
