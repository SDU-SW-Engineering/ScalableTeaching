require("./bootstrap");
require("chart.js");

import Vue from "vue";

import VueTippy, { TippyComponent } from "vue-tippy";
import VueTailwind from "vue-tailwind";
import { TRichSelect, TDatepicker } from "vue-tailwind/dist/components";

Vue.component(
    "simple-doughnut-chart",
    require("./components/SimpleDoughnutChart").default
);
Vue.component("task", require("./components/Task").default);
Vue.component("line-chart", require("./components/LineChart").default);
Vue.component("bar-chart", require("./components/BarChart").default);
Vue.component("groups", require("./components/Groups").default);
Vue.component("tippy", TippyComponent);
Vue.component("user-select", require("./components/UserSelect").default);
Vue.component(
    "date-range",
    require("./components/Elements/DateRangePicker").default
);
Vue.component("grading", require("./components/Grading").default);
Vue.component("subtasks", require("./components/Tasks/Subtasks").default);
Vue.component(
    "subtask-list",
    require("./components/Tasks/SubTaskList").default
);
Vue.component(
    "new-task-wizard",
    require("./components/Course/NewTaskWizard").default
);
Vue.component(
    "markdown-editor",
    require("./components/Tasks/Preferences/MarkdownEditor").default
);
Vue.component(
    "visibility-dropdown",
    require("./components/Tasks/VisibilityDropdown").default
);
Vue.component(
    "enrolled",
    require("./components/Course/Management/Enrolled").default
);
Vue.component(
    "exercises",
    require("./components/Course/Management/Exercises").default
);

Vue.component(
    "group-settings",
    require("./components/Course/Management/GroupSettings").default
);

Vue.component(
    "group-rename",
    require("./components/Course/Management/GroupRename").default
);

Vue.component("editor", require("./components/Editor/Editor").default);
Vue.component("directory", require("./components/Editor/Directory").default);
Vue.component(
    "feedback-review",
    require("./components/Admin/FeedbackReview").default
);

Vue.component(
    "repo-selection",
    require("./components/Course/RepoSelection.vue").default
);

Vue.component(
    "enrollment-url",
    require("./components/EnrollmentUrl.vue").default
);

const settings = {
    "t-rich-select": {
        component: TRichSelect,
        props: {
            classes: {
                wrapper: "",
                buttonWrapper: "",
                selectButton:
                    "px-3 py-2 text-black transition duration-100 ease-in-out bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-800 rounded shadow-sm focus:border-lime-green-500 focus:ring-2 focus:ring-lime-green-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed",
                selectButtonLabel: "",
                selectButtonTagWrapper: "-mx-2 -my-2.5 py-1 pr-8",
                selectButtonTag:
                    "bg-blue-500 block disabled:cursor-not-allowed disabled:opacity-50 duration-100 ease-in-out focus:border-lime-green-500 focus:outline-none focus:ring-2 focus:ring-lime-green-500 focus:ring-opacity-50 rounded shadow-sm text-sm text-white transition white-space-no m-0.5 max-w-full overflow-hidden h-8 flex items-center",
                selectButtonTagText: "px-3",
                selectButtonTagDeleteButton:
                    "-ml-1.5 h-full hover:bg-blue-600 hover:shadow-sm inline-flex items-center px-2 transition",
                selectButtonTagDeleteButtonIcon: "",
                selectButtonPlaceholder: "text-gray-400",
                selectButtonIcon: "text-gray-600",
                selectButtonClearButton:
                    "hover:bg-blue-100 text-gray-600 rounded transition duration-100 ease-in-out",
                selectButtonClearIcon: "",
                dropdown:
                    "-mt-1 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-800 border-l border-r rounded-b shadow-sm",
                dropdownFeedback: "pb-2 px-3 text-gray-400 text-sm",
                loadingMoreResults: "pb-2 px-3 text-gray-400 text-sm",
                optionsList: "",
                searchWrapper: "p-2 placeholder-gray-400",
                searchBox:
                    "px-3 py-2 bg-gray-50 dark:bg-gray-600 dark:text-white dark:border-gray-800 text-sm rounded border focus:outline-none focus:shadow-outline border-gray-300 ",
                optgroup:
                    "text-gray-400 uppercase text-xs py-1 px-2 font-semibold",
                option: "",
                disabledOption: "",
                highlightedOption: "bg-lime-green-100 dark:bg-lime-green-700",
                selectedOption:
                    "font-semibold bg-gray-100 bg-blue-500 dark:bg-lime-green-800 font-semibold text-white",
                selectedHighlightedOption:
                    "font-semibold bg-gray-100 bg-blue-600 dark:bg-lime-green-700 font-semibold text-white",
                optionContent: "flex justify-between items-center px-3 py-2",
                optionLabel: "",
                selectedIcon: "",
                enterClass: "opacity-0",
                enterActiveClass: "transition ease-out duration-100",
                enterToClass: "opacity-100",
                leaveClass: "opacity-100",
                leaveActiveClass: "transition ease-in duration-75",
                leaveToClass: "opacity-0",
            },
        },
    },
    "t-datepicker": {
        component: TDatepicker,
        props: {
            fixedClasses: {
                navigator: "flex",
                navigatorViewButton: "flex items-center",
                navigatorViewButtonIcon: "flex-shrink-0 h-5 w-5",
                navigatorViewButtonBackIcon: "flex-shrink-0 h-5 w-5",
                navigatorLabel: "flex items-center py-1",
                navigatorPrevButtonIcon: "h-6 w-6 inline-flex",
                navigatorNextButtonIcon: "h-6 w-6 inline-flex",
                inputWrapper: "relative",
                viewGroup: "inline-flex flex-wrap",
                view: "w-64",
                calendarDaysWrapper: "grid grid-cols-7",
                calendarHeaderWrapper: "grid grid-cols-7",
                monthWrapper: "grid grid-cols-4",
                yearWrapper: "grid grid-cols-4",
                input: "block w-full px-3 py-2 dark:bg-gray-700 dark:text-white transition duration-100 ease-in-out border rounded dark:border-gray-700 shadow-sm focus:border-lime-green-500 focus:ring-2 focus:ring-lime-green-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed",
                clearButton:
                    "flex flex-shrink-0 items-center justify-center absolute right-0 top-0 m-2 h-6 w-6",
                clearButtonIcon: "fill-current h-3 w-3",
            },
            classes: {
                wrapper: "flex flex-col",
                dropdownWrapper: "relative z-10",
                dropdown:
                    "origin-top-left absolute rounded shadow dark:bg-gray-700 bg-white overflow-hidden mt-1",
                enterClass: "opacity-0 scale-95",
                enterActiveClass: "transition transform ease-out duration-100",
                enterToClass: "opacity-100 scale-100",
                leaveClass: "opacity-100 scale-100",
                leaveActiveClass: "transition transform ease-in duration-75",
                leaveToClass: "opacity-0 scale-95",
                inlineWrapper: "",
                inlineViews: "rounded bg-white border mt-1 inline-flex",
                inputWrapper: "",
                input: "text-black placeholder-gray-400 border-gray-300",
                clearButton:
                    "hover:bg-gray-100 rounded transition duration-100 ease-in-out text-gray-600",
                clearButtonIcon: "",
                viewGroup: "",
                view: "",
                navigator: "pt-2 px-3",
                navigatorViewButton:
                    "transition ease-in-out duration-100 inline-flex cursor-pointer rounded-full px-2 py-1 -ml-1 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500",
                navigatorViewButtonIcon: "fill-current text-gray-400",
                navigatorViewButtonBackIcon: "fill-current text-gray-400",
                navigatorViewButtonMonth: "text-gray-700 font-semibold",
                navigatorViewButtonYear:
                    "text-gray-500 ml-1 dark:text-lime-green-300",
                navigatorViewButtonYearRange:
                    "text-gray-500 ml-1 dark:text-lime-green-300",
                navigatorLabel: "py-1",
                navigatorLabelMonth:
                    "text-gray-700 font-semibold dark:text-gray-200",
                navigatorLabelYear:
                    "text-gray-500 ml-1 dark:text-lime-green-300",
                navigatorPrevButton:
                    "transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 ml-2 ml-auto disabled:opacity-50 disabled:cursor-not-allowed",
                navigatorNextButton:
                    "transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 -mr-1 disabled:opacity-50 disabled:cursor-not-allowed",
                navigatorPrevButtonIcon: "text-gray-400",
                navigatorNextButtonIcon: "text-gray-400",
                calendarWrapper: "px-3 pt-2",
                calendarHeaderWrapper: "",
                calendarHeaderWeekDay:
                    "uppercase text-xs text-gray-500 w-8 h-8 flex items-center justify-center",
                calendarDaysWrapper: "",
                calendarDaysDayWrapper:
                    "w-full h-8 flex flex-shrink-0 items-center dark:text-gray-200",
                otherMonthDay:
                    "text-sm rounded-full w-8 h-8 mx-auto hover:bg-lime-green-100 text-gray-400 disabled:opacity-50 disabled:cursor-not-allowed",
                emptyDay: "",
                inRangeFirstDay:
                    "text-sm bg-lime-green-500 text-white w-full h-8 rounded-l-full",
                inRangeLastDay:
                    "text-sm bg-lime-green-500 text-white w-full h-8 rounded-r-full",
                inRangeDay:
                    "text-sm bg-lime-green-200 dark:bg-lime-green-400 w-full h-8 disabled:opacity-50 disabled:cursor-not-allowed",
                selectedDay:
                    "text-sm rounded-full w-8 h-8 mx-auto bg-lime-green-500 text-white disabled:opacity-50 disabled:cursor-not-allowed",
                activeDay:
                    "text-sm rounded-full bg-lime-green-100 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed",
                highlightedDay:
                    "text-sm rounded-full bg-lime-green-200 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed",
                day: "text-sm rounded-full w-8 h-8 mx-auto hover:bg-lime-green-100 dark:hover:bg-lime-green-200 dark:hover:text-gray-400 disabled:opacity-50 disabled:cursor-not-allowed",
                today: "text-sm rounded-full w-8 h-8 mx-auto hover:bg-lime-green-100 disabled:opacity-50 disabled:cursor-not-allowed border border-lime-green-500",
                monthWrapper: "px-3 pt-2",
                selectedMonth:
                    "text-sm rounded w-full h-12 mx-auto bg-lime-green-500 text-white",
                activeMonth:
                    "text-sm rounded w-full h-12 mx-auto bg-lime-green-100",
                month: "text-sm rounded w-full h-12 mx-auto hover:bg-lime-green-100 dark:text-gray-200",
                yearWrapper: "px-3 pt-2",
                year: "text-sm rounded w-full h-12 mx-auto hover:bg-lime-green-100 dark:text-gray-200",
                selectedYear:
                    "text-sm rounded w-full h-12 mx-auto bg-lime-green-500 text-white",
                activeYear:
                    "text-sm rounded w-full h-12 mx-auto bg-lime-green-100",
            },
            variants: {
                danger: {
                    input: "border-red-300 bg-red-50 placeholder-red-200 text-red-900",
                    clearButton: "hover:bg-red-200 text-red-500",
                },
            },
        },
    },
};

Vue.use(VueTailwind, settings);

const app = new Vue({
    el: "#app",
});

require("./components/ReactLoader");
