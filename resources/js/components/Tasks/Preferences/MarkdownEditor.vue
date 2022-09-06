<template>
    <div>
        <div class="toastui-editor-dark">
            <editor :options="options" ref="mdEditor" height="500px"/>
        </div>
    </div>
</template>

<script>

import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';

import {Editor} from '@toast-ui/vue-editor';

export default {
    components: {
        editor: Editor
    },
    data() {

        return {
            options: {
                usageStatistics: false,
                hideModeSwitch: true,
                previewStyle: 'tab'
            }
        }
    }
};

</script>
