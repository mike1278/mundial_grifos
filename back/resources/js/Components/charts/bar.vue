<template>
    <div ref="chart" class="w-full"></div>
</template>
<script>
import ApexCharts from 'apexcharts';

export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
        yaxisText: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            instance: null,
            internalOptions: {
                series: [{
                    name: 'Clientes',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '25%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [],
                },
                yaxis: {
                    title: {
                        text: 'Cantidad de nuevos clientes'
                    }
                },
                fill: {
                    opacity: 1
                },
            },
        }
    },
    beforeMount() {
        window.ApexCharts = ApexCharts;
    },
    mounted() {
        this.internalOptions.series[0].data = this.data
        this.internalOptions.series[0].name = this.name
        this.internalOptions.yaxis.title.text = this.yaxisText
        this.internalOptions.xaxis.categories = this.categories

        this.instance = new ApexCharts(this.$refs['chart'], this.internalOptions);
        this.instance.render()
        this.$emit('chart-instance',this.instance)
    },
    beforeUnmount() {
        if(this.instance){
            this.instance.destroy()
        }
    },
}
</script>
