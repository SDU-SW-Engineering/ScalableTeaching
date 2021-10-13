<script>
import {Line} from 'vue-chartjs'

export default {
    extends: Line,
    props: ['data', 'labels'],
    mounted() {
        this.renderChart({
            datasets: this.data,
            labels: this.labels
        }, {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
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
