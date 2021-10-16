<script>
import {Bar} from 'vue-chartjs'

export default {
    extends: Bar,
    props: ['data', 'labels'],
    mounted() {
        this.renderChart({
            datasets: this.data,
            labels: this.labels
        }, {
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
                    }
                ],
                yAxes: [
                    {
                        stacked: true,
                        gridLines: {}
                    }
                ]
            }
        })
    }
}
</script>

<style>
</style>
