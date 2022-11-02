import "./bootstrap";
import { createApp, defineAsyncComponent } from "vue";
import VueTippy from "vue-tippy";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

app.component(
    "task",
    defineAsyncComponent(() => import("./components/Task/Task.vue"))
);

app.component(
    "visibility-dropdown",
    defineAsyncComponent(() =>
        import("./components/Tasks/VisibilityDropdown.vue")
    )
);

app.component(
    "line-chart",
    defineAsyncComponent(() => import("./components/Charts/LineChart.vue"))
);
app.component(
    "bar-chart",
    defineAsyncComponent(() => import("./components/Charts/BarChart.vue"))
);

app.component(
    "feedback-review",
    defineAsyncComponent(() => import("./components/Admin/FeedbackReview.vue"))
);

app.component(
    "enrolled",
    defineAsyncComponent(() =>
        import("./components/Course/Management/Enrolled.vue")
    )
);
/**
 *
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(VueTippy);

app.mount("#app");
