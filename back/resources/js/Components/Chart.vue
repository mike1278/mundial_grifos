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
    beforeMount() {
        window.ApexCharts = ApexCharts;
    },
    mounted() {
        this.instance = new ApexCharts(this.$refs['chart'], this.options);
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
