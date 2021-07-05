<template>
    <div>
        <div class="w-full lg:w-1/2 xl:w-1/3 xl:mr-4">
            <h2 class="text-xl text-center text-gray-600 mb-2">Nuevos clientes</h2>
            <chart :options="charts.column"></chart>
        </div>
    </div>
</template>
<script>
import chart from '@/Components/Chart'
export default {
    components: {
        chart,
    },
    data(){
        return {
            charts: {
                column: {
                    series: [{
                        name: 'Clientes',
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
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
                        categories: ['Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct'],
                    },
                    yaxis: {
                        title: {
                            text: 'Cantidad de nuevos clientes'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                }
            },
        }
    },
}
</script>
