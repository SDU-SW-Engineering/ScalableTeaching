<script>
import {Bar} from 'vue-chartjs'

export default {
    extends: Bar,
    props: ['data', 'labels'],
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
                            ticks: {
                                fontColor: this.darkMode ? "#ffffff" : '#6A6A6A'
                            },
                            stacked: true,
                            gridLines: {
                                color: this.darkMode ? "#2f2f2f" : '#ECECEC'
                            }
                        }
                    ]
                }
            })
        }
    }
}
</script>

<style>
</style>
