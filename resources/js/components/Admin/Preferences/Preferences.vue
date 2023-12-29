<template>
    <div class="grid grid-cols-4 gap-4 mb-16">
        <div
            class="flex flex-col w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg"
        >
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-black dark:text-white text-2xl font-thin">
                    Title
                </h1>
            </div>
            <div>
                <input
                    type="text"
                    v-model="title"
                    class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"
                />
            </div>
        </div>
        <duration
            :starts-at="newStartsAt"
            :ends-at="newEndsAt"
            @startsAt="newStartsAt = $event"
            @endsAt="newEndsAt = $event"
        ></duration>
        <description
            @change="changed = true"
            ref="description"
            :task="task"
        ></description>
        <div class="flex items-center"></div>
        <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-600">
            <div class="container mx-auto px-6 h-16">
                <div class="flex items-center justify-end h-full">
                    <transition name="slide">
                        <span class="dark:text-white mr-2" v-if="saved"
                            >Changes saved</span
                        >
                    </transition>
                    <button
                        @click="save()" :disabled="!canSave"
                        :class="[!canSave ? 'cursor-not-allowed bg-gray-750' : 'bg-lime-green-300 hover:bg-lime-green-400']"
                        class=" flex items-center justify-center text-lime-green-800 py-2 px-4 rounded "
                    >
                        <svg
                            v-if="saving"
                            class="animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        <svg
                            v-if="!saving"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 mr-1.5 text-white"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 13.5l6.75 6.75L21 4.5"
                            />
                        </svg>
                        <span v-if="!saving" class="text-white"
                            >Save changes</span
                        >
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Duration from "./Duration.vue";
import Description from "./Description.vue";

export default {
    components: { Description, Duration },
    props: {
        task: {
            type: Object,
        },
        startsAt: {
            type: String,
        },
        endsAt: {
            type: String,
        },
    },
    data() {
        return {
            title: this.task.name,
            changed: false,
            saving: false,
            saved: false,
            newStartsAt: this.startsAt,
            newEndsAt: this.endsAt,
        };
    },
    methods: {
        save: async function () {
            this.saving = true;
            const markdown =
                this.$refs.description.$refs.editor.$refs.mdEditor.invoke(
                    "getMarkdown"
                ).trim();

            if (markdown.length <= 0 && this.task.markdown_description.length <= 0) {
                this.$toast.error('Description can not be empty')
                this.saving = false;
                this.changed = false;
                return;
            }

            if (this.title.trim().length <= 0) {
                this.$toast.error('Title can not be empty')
                this.saving = false;
                this.changed = false;
                return;
            }

            if (!this.canSave) {
                this.$toast.error('Some of the details are missing')
                this.saving = false;
                this.changed = false;
                return;
            }

            try {
                await axios.put(
                    `/courses/${this.task.course_id}/tasks/${this.task.id}/admin/preferences`,
                    {
                        markdown,
                        startsAt: this.newStartsAt,
                        endsAt: this.newEndsAt,
                        title: this.title,
                    }
                );
                this.saved = true;
                this.changed = false;
            } catch (e) {
                alert(e.response.data.message);
            } finally {
                this.saving = false;
                setTimeout(() => (this.saved = false), 2000);
            }
        },
        preventNav(e) {
            if (!this.changed) return;
            e.preventDefault();
            e.returnValue = "";
        },
    },
    computed: {
        canSave: function () {
            // We can't check description in here right now, since $refs can't be accessed in computed properties.
            return this.changed && this.title.trim().length > 0 && this.newEndsAt && this.newStartsAt
        }
    },
    watch: {
        title: function (after, before) {
            this.changed = true;
        },
        newStartsAt: function (after, before) {
            this.changed = true;
        },
        newEndsAt: function (after, before) {
            this.changed = true;
        },
    },
    beforeMount() {
        window.addEventListener("beforeunload", this.preventNav);
    },
};
</script>
