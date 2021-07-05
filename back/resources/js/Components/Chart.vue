<template>
    <div ref="chart" class="w-full"></div>
</template>
<script>
import ApexCharts from 'apexcharts';

export default {
    props: {
        options: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            instance: null,
        }
    },
    mounted() {
        let chart = new ApexCharts(this.$refs['chart'], this.options);
        chart.render()
        this.$emit('chart-instance',chart)
        this.instance = chart
    },
}
</script>
