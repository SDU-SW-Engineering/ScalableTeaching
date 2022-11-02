<template>
    <Bar ref="bar" :chart-data="chartData" :chart-options="chartOptions"></Bar>
</template>

<script setup lang="ts">
import {Bar} from 'vue-chartjs'
import {
    BarElement, BarOptions,
    CategoryScale, Chart,
    Chart as ChartJS, ChartOptions,
    LinearScale,
    Title,
    Tooltip
} from "chart.js";
import {ref} from "vue";

ChartJS.register(Title, Tooltip, BarElement, CategoryScale, LinearScale)

const props = defineProps<{
    data: [],
    labels: [],
    route: string | null,
    disableAnimations?: boolean,
    displayCategories?: boolean
}>();

const darkMode = ref<boolean>(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
const bar = ref(null);
const chartData = ref<any>({
    datasets: props.data,
    labels: props.labels
})

const chartOptions = ref<ChartOptions<BarElement>>({
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: {
            stacked: true,
            ticks: {
                display: false
            }
        },
        y: {
            ticks: {
                beginAtZero: true,
                color: darkMode ? "#ffffff" : '#6A6A6A'
            },
            grid: {
                color: darkMode ? "#3d3d3d" : '#ECECEC'
            }
        },
    },
    animation: {
        duration: props.disableAnimations ? 0 : 400
    },
    onClick: (e, activeElements) => {
        if (props.route == null)
            return;
        let activeElement = bar.value.chart.getElementsAtEventForMode(e, 'nearest', {intersect: true}, false) // this.getElementAtEvent(event)
        if (activeElement.length === 0)
            return;
        let label = chartData.value.labels[activeElement[0].index];
        window.location.href = `${props.route}?q=${label}`;
    },
    onHover: (e, activeElements) => {
        if (props.route == null)
            return;
        let activeElement = bar.value.chart.getElementsAtEventForMode(e, 'nearest', {intersect: true}, false) // this.getElementAtEvent(event)
        e.native.target.style.cursor = activeElement.length ? 'pointer' : 'default';
    }
});
</script>

<style>
</style>
