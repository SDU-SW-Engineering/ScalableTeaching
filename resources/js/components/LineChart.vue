<script>
import {Line} from 'vue-chartjs'

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
                elements: {
                    line: {
                        tension: 0
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    mode: "index",
                    intersect: false
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
                            ticks: {
                                beginAtZero: true,
                                fontColor: this.darkMode ? "#ffffff" : '#6A6A6A'
                            },
                            gridLines: {
                                color: this.darkMode ? "#3d3d3d" : '#ECECEC'
                            }
                        }
                    ]
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
}
</script>

<style>
</style>
