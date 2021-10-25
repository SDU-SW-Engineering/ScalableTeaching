<script>
import {Bar} from 'vue-chartjs'

export default {
    extends: Bar,
    props: {
        data: {
            type: Array,
            required: true
        },
        labels: {
            type: Array,
            required: true
        },
        route: {
            type: String,
            required: false,
            default: null
        },
        disableAnimations: {
            type: Boolean,
            required: false,
            default: false
        }
    },
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
            let that = this;
            this.renderChart({
                datasets: this.data,
                labels: this.labels
            }, {
                onClick(event, activeElements) {
                    if (that.route == null)
                        return;
                    let activeElement = this.getElementAtEvent(event)
                    if (activeElement.length === 0)
                        return;
                    let label = activeElement[0]._view.label;
                    window.location.href = `${that.route}?q=${label}`;
                },
                onHover(event, activeElements) {
                    if (that.route == null)
                        return;
                    let activeElement = this.getElementAtEvent(event)
                    if (activeElement.length) event.target.style.cursor = 'pointer';
                    else event.target.style.cursor = 'default';
                },
                animation: {
                    duration: that.disableAnimations ? 0 : 400
                },
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
                                color: this.darkMode ? "#3d3d3d" : '#ECECEC'
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
