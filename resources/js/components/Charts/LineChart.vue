<template>
    <Line :chart-data="chartData" :chart-options="chartOptions"></Line>
</template>

<script setup lang="ts">
import {Line} from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    ChartOptions,
    Filler
} from 'chart.js'
import {onBeforeMount, onMounted, ref} from "vue";

ChartJS.register(Title, Tooltip, CategoryScale, LinearScale, PointElement, LineElement, Filler)

const props = defineProps<{
    data: [],
    labels: []
}>();


const darkMode = ref<boolean>(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)

const chartData = ref<any>({
    datasets: props.data,
    labels: props.labels
})


onBeforeMount(() => {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        darkMode.value = e.matches;
    });
})

const chartOptions = ref<ChartOptions<LineElement>>({
    elements: {
        line: {
            tension: 0,
        }
    },
    responsive: true,
    maintainAspectRatio: false,
    tooltips: {
        mode: "index",
        intersect: false
    },
    scales: {
        y: {
            ticks: {
                beginAtZero: true,
                color: darkMode ? "#ffffff" : '#6A6A6A'
            },
            grid: {
                color: darkMode ? "#3d3d3d" : '#ECECEC'
            }
        },
        x: {
            ticks: {
                display: false
            },
            grid: {
                display: false
            }
        }
    }
});

/*import {Line} from 'vue-chartjs'


export default {
    extends: Line,
    props: ['data', 'labels'],
    data() {
        return {
            darkMode: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }
    },
    methods: {
        render: function (){
            this.renderChart({
                datasets: this.data,
                labels: this.labels
            }, {

                }
            })
        }
    },
    mounted() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            this.darkMode = e.matches;
            this.render();
        });
        this.render()
    }
}*/
</script>

<style>
</style>
