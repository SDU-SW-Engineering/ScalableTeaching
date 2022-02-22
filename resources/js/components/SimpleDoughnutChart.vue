<script>
import {Doughnut} from 'vue-chartjs'

export default {
    extends: Doughnut,
    props: ['data', 'secondary'],
    mounted() {
        this.renderChart({
            datasets: [{
                data: this.data,
                backgroundColor: [
                    '#7BB026',
                    //'#F87171',
                    this.secondary,
                ]
            }],
        }, {
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
        })
    }
}
</script>

<style>
</style>
