<template>
    <div class="container">
        <highcharts class="chart" :options="chartOptions" :updateArgs="updateArgs"></highcharts>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                updateArgs: [true, true, {duration: 1000}],
                chartOptions: {
                    xAxis: {
                        categories: [
                            'Create account',
                            'Activate account',
                            'Provide profile info',
                            'Jobs interests',
                            'Relevant Experience',
                            'Freelancer',
                            'Waiting for approval',
                            'Approval'
                        ],
                        title: {
                            text: "Onboarding Steps"
                        },
                        labels: {
                            format: "{value}"
                        },
                    },
                    yAxis: {
                        title: {
                            text: "Users (%)"
                        },
                        labels: {
                            format: "{value}%"
                        },
                        min: 0,
                        max: 100
                    },
                    tooltip: {
                        valueSuffix: '%'
                    },
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Weekly Retention'
                    },
                    series: []
                }
            }
        },
        mounted: function () {
            this.$http.get('/api/get-chart-data')
                .then(response => {
                    this.chartOptions.series = response.data;
                });
        },
    }
</script>
