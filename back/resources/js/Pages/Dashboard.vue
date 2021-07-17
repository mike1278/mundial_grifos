<template>
    <div>
        <div class="flex justify-between mb-3">
            <h2 class="text-2xl text-gray-600 ml-3 mb-2">Estadísticas</h2>
            <vue-button variant="primary" @click="pdf">Exportar</vue-button>
        </div>
        <div class="flex flex-wrap" id="graphics">
            <div class="w-full md:w-1/2 xl:w-1/3 xl:pr-2">
                <h2 class="text-xl text-center text-gray-600 mb-2">Nuevos clientes</h2>
                <bar-chart
                    name="Clientes"
                    :data="clientsData"
                    yaxis-text="Cantidad de nuevos clientes"
                    :categories="clientsCategories"
                />
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 xl:pr-2">
                <h2 class="text-xl text-center text-gray-600 mb-2">Ordenes</h2>
                <bar-chart
                    name="Ordenes"
                    :data="ordersData"
                    yaxis-text="Cantidad de ordenes"
                    :categories="ordersCategories"
                />
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 xl:pr-2">
                <h2 class="text-xl text-center text-gray-600 mb-2">Visualización de productos</h2>
                <bar-chart
                    name="Productos visualizados"
                    :data="productsData"
                    yaxis-text="Productos visualizados"
                    :categories="productsCategories"
                />
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 xl:pr-2">
                <h2 class="text-xl text-center text-gray-600 mb-2">Productos más vendidos</h2>
                <!--                <chart :options="charts.column"></chart>-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 xl:pr-2">
                <h2 class="text-xl text-center text-gray-600 mb-2">Productos más vistos</h2>
                <vue-table>
                    <template #header>
                        <tr>
                            <td-head text-align="">Id</td-head>
                            <td-head text-align="">Nombre</td-head>
                            <td-head text-align="">Vistas</td-head>
                            <td-head>Ver</td-head>
                        </tr>
                    </template>
                    <tr v-for="data in listProducts" :key="data.id">
                        <td-body text-align="">{{ data.id }}</td-body>
                        <td-body text-align="">{{ data.name.slice(0,10) + '...' }}</td-body>
                        <td-body text-align="">{{ data.views }}</td-body>
                        <td-body>
                            <vue-button
                                is="link"
                                :href="route('products.show',data.id)"
                                variant="primary"
                                class="mr-2"
                            >
                                <i class="fas fa-eye"></i>
                            </vue-button>
                        </td-body>
                    </tr>
                </vue-table>
            </div>
        </div>
    </div>
</template>
<script>
import { jsPDF } from "jspdf"
import chart from '@/Components/Chart'
import barChart from '@/Components/charts/bar'
import vueButton from '@/Components/Button'
import html2canvas from 'html2canvas'
import moment from 'moment'
import vueTable from '@/Components/Table'
import tdBody from '@/Components/TdBody'
import tdHead from '@/Components/TdHead'

export default {
    components: {
        chart,
        vueButton,
        vueTable,
        tdBody,
        tdHead,
        barChart,
    },
    props: {
        newClients: {
            type: Array,
        },
        productsViews: {
            type: Array,
        },
        orders: {
            type: Array,
        },
        listProducts: {
            type: Array,
        },
    },
    setup(props) {
        moment.locale('es')
        let clientsData = [];
        let productsData = [];
        let ordersData = [];
        let clientsCategories = [];
        let productsCategories = [];
        let ordersCategories = [];
        props.newClients.forEach(el=>{
            clientsData.push(el.total)
            clientsCategories.push(moment(el.date, "M-YYYY").format('MMM'))
        })
        props.productsViews.forEach(el=>{
            productsData.push(el.total)
            productsCategories.push(moment(el.date, "M-YYYY").format('MMM'))
        })
        props.orders.forEach(el=>{
            ordersData.push(el.total)
            ordersCategories.push(moment(el.date, "M-YYYY").format('MMM'))
        })
        return {
            clientsData,
            productsData,
            ordersData,
            clientsCategories,
            productsCategories,
            ordersCategories,
        }
    },
    data(){
        return {}
    },
    methods: {
        pdf(){
            let canvas = [];
            let graphics = document.querySelectorAll("#graphics > div")
            graphics.forEach(async (el,i) => {
                await html2canvas(el).then(can => {
                    canvas.push(can)
                    if(graphics.length === (i+1)){
                        const doc = new jsPDF('landscape', 'mm');
                        console.log(canvas, canvas.length)
                        canvas.forEach((can,i)=>{
                            const width = (150 / (can.height / can.width))
                            doc.addImage(can, 'JPEG', 10, 10, width, 150);
                            if(canvas.length > (i + 1)){
                                doc.addPage();
                            }
                        })
                        doc.save()
                    }
                });
            })
        }
    },
}
</script>
