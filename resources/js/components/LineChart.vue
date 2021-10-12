<script>
import {Line} from 'vue-chartjs'

export default {
    extends: Line,
    props: ['data'],
    methods: {
        days: function(count) {

        }
    },
    mounted() {
        this.renderChart({
            datasets: this.data,
            labels: Array(this.data[0].data.length).fill("Day").map((e, i) => e + " " + (i+1))
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
