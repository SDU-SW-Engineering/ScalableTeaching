<template>
    <Bar></Bar>
</template>
<script setup lang="ts">
import {Bar} from 'vue-chartjs'
import {
    CategoryScale,
    Chart as ChartJS,
    Legend,
    LinearScale,
    Title,
    Tooltip
} from "chart.js";
import {ref} from "vue";

ChartJS.register(Title, Tooltip, Legend, CategoryScale, LinearScale)

const props = defineProps<{
    data: [],
    labels: [],
    route: string | null,
    disableAnimations: boolean,
    displayCategories: boolean
}>();

const darkMode = ref<boolean>(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)

const chartData = ref<any>({
    datasets: props.data
})

/*import {Bar} from 'vue-chartjs'

export default {
    extends: Bar,
    props: {
        data: {
            type: Array,
            required: true
        },
        labels: {
            type: Array,
            required: true
        },
        route: {
            type: String,
            required: false,
            default: null
        },
        disableAnimations: {
            type: Boolean,
            required: false,
            default: false
        },
        displayCategories: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    data() {
        return {
            darkMode: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }
    },
    mounted() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            this.darkMode = e.matches;
            this.render();
        });
        this.render()
    },
    methods: {
        render: function () {
            let that = this;
            this.renderChart({
                datasets: this.data,
                labels: this.labels
            }, {
                onClick(event, activeElements) {
                    if (that.route == null)
                        return;
                    let activeElement = this.getElementAtEvent(event)
                    if (activeElement.length === 0)
                        return;
                    let label = activeElement[0]._view.label;
                    window.location.href = `${that.route}?q=${label}`;
                },
                onHover(event, activeElements) {
                    if (that.route == null)
                        return;
                    let activeElement = this.getElementAtEvent(event)
                    if (activeElement.length) event.target.style.cursor = 'pointer';
                    else event.target.style.cursor = 'default';
                },
                animation: {
                    duration: that.disableAnimations ? 0 : 400
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: "index",
                },
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                            ticks: {
                                display: false
                            },
                            gridLines: {
                                display: false
                            }
                        },
                        {
                            type: "category",
                            gridLines: {
                                drawOnChartArea: false
                            },
                            display: this.displayCategories,
                            ticks: {
                                callback(value, index, values) {
                                    let categories = values.map(v => v.split(";")[1]);
                                    if (categories.every(v  => v == null))
                                        return null;
                                    value = categories[index];
                                    let applicableCategories = categories.filter(v => v === value);
                                    let normalizeIndex = index - categories.indexOf(value);
                                    let showLabel = normalizeIndex + 1 === applicableCategories.length;

                                    if (showLabel === false)
                                        return null;

                                    return value;
                                }
                            }
                        }
                    ],
                    yAxes: [
                        {
                            ticks: {
                                fontColor: this.darkMode ? "#ffffff" : '#6A6A6A'
                            },
                            stacked: true,
                            gridLines: {
                                color: this.darkMode ? "#3d3d3d" : '#ECECEC'
                            }
                        }
                    ]
                }
            })
        }
    }
}*/
</script>

<style>
</style>
