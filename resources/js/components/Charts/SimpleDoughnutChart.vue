<template>
    <Doughnut :chart-options="chartOptions" :chart-data="chartData"></Doughnut>
</template>

<script setup lang="ts">
import {Doughnut} from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    CategoryScale,
    LinearScale,
    ChartData, ArcElement,
} from 'chart.js'
import {ref} from "vue";

ChartJS.register(Title, Tooltip, Legend, CategoryScale, LinearScale, ArcElement)

const props = defineProps<{
    data: [Number],
    secondary: [String]
}>()

const chartData = ref<any>({
    datasets: [{
        data: props.data,
        backgroundColor: [
            '#7BB026',
            props.secondary,
        ]
    }],
});

const chartOptions = ref<any>({
    legend: {
        display: false
    },
    elements: {
        arc: {
            borderWidth: 0
        }
    },
    tooltips: {
        enabled: false
    },
    hover: {
        mode: null
    },
    responsive: true
});
</script>

<style>
</style>
