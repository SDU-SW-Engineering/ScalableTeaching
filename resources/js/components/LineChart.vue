<script>
import {Line} from 'vue-chartjs'

export default {
    extends: Line,
    props: ['data'],
    mounted() {
        this.renderChart({
            datasets: this.data,
            labels: [
                'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'
            ]
        }, {
            responsive: true,
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
