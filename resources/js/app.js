require('./bootstrap');
require('chart.js')

import Vue from 'vue'

import VueTippy, { TippyComponent } from "vue-tippy";
import VueTailwind from 'vue-tailwind'
import {
    TRichSelect,
} from 'vue-tailwind/dist/components';

Vue.component('simple-doughnut-chart', require('./components/SimpleDoughnutChart').default);
Vue.component('task', require('./components/Task').default);
Vue.component('line-chart', require('./components/LineChart').default);
Vue.component('bar-chart', require('./components/BarChart').default);
Vue.component('groups', require('./components/Groups').default);
Vue.component("tippy", TippyComponent);
Vue.component("user-select", require('./components/UserSelect').default)

const settings = {
    't-rich-select': {
        component: TRichSelect,
        props: {
            classes: {
                wrapper: '',
                buttonWrapper: '',
                selectButton: 'px-3 py-2 text-black transition duration-100 ease-in-out bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-800 rounded shadow-sm focus:border-lime-green-500 focus:ring-2 focus:ring-lime-green-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
                selectButtonLabel: '',
                selectButtonTagWrapper: '-mx-2 -my-2.5 py-1 pr-8',
                selectButtonTag: 'bg-blue-500 block disabled:cursor-not-allowed disabled:opacity-50 duration-100 ease-in-out focus:border-lime-green-500 focus:outline-none focus:ring-2 focus:ring-lime-green-500 focus:ring-opacity-50 rounded shadow-sm text-sm text-white transition white-space-no m-0.5 max-w-full overflow-hidden h-8 flex items-center',
                selectButtonTagText: 'px-3',
                selectButtonTagDeleteButton: '-ml-1.5 h-full hover:bg-blue-600 hover:shadow-sm inline-flex items-center px-2 transition',
                selectButtonTagDeleteButtonIcon: '',
                selectButtonPlaceholder: 'text-gray-400',
                selectButtonIcon: 'text-gray-600',
                selectButtonClearButton: 'hover:bg-blue-100 text-gray-600 rounded transition duration-100 ease-in-out',
                selectButtonClearIcon: '',
                dropdown: '-mt-1 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-800 border-l border-r rounded-b shadow-sm',
                dropdownFeedback: 'pb-2 px-3 text-gray-400 text-sm',
                loadingMoreResults: 'pb-2 px-3 text-gray-400 text-sm',
                optionsList: '',
                searchWrapper: 'p-2 placeholder-gray-400',
                searchBox: 'px-3 py-2 bg-gray-50 dark:bg-gray-600 dark:text-white text-sm rounded border focus:outline-none focus:shadow-outline border-gray-300 dark:border-gray-800',
                optgroup: 'text-gray-400 uppercase text-xs py-1 px-2 font-semibold',
                option: '',
                disabledOption: '',
                highlightedOption: 'bg-lime-green-100 dark:bg-lime-green-700',
                selectedOption: 'font-semibold bg-gray-100 bg-blue-500 dark:bg-lime-green-800 font-semibold text-white',
                selectedHighlightedOption: 'font-semibold bg-gray-100 bg-blue-600 dark:bg-lime-green-700 font-semibold text-white',
                optionContent: 'flex justify-between items-center px-3 py-2',
                optionLabel: '',
                selectedIcon: '',
                enterClass: 'opacity-0',
                enterActiveClass: 'transition ease-out duration-100',
                enterToClass: 'opacity-100',
                leaveClass: 'opacity-100',
                leaveActiveClass: 'transition ease-in duration-75',
                leaveToClass: 'opacity-0',
            }
        }
    }
};

Vue.use(VueTailwind, settings);

const app = new Vue({
    el: '#app',

});
