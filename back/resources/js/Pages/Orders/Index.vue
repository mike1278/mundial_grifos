<template>
    <div>
        <div class="flex justify-between mb-4 px-2">
            <h2 class="text-gray-700 text-xl">Ordenes</h2>
        </div>
        <c-table>
            <template #header>
                <tr>
                    <td-head>Id</td-head>
                    <td-head>Cliente</td-head>
                    <td-head>Estado</td-head>
                    <td-head>Tipo de entrega</td-head>
                    <td-head>Total</td-head>
                    <td-head>Total referencial</td-head>
                    <td-head>Fecha</td-head>
                    <td-head>Acciones</td-head>
                </tr>
            </template>
            <tr v-for="data in orders.data" :key="data.id">
                <td-body>
                    {{ data.id }}
                </td-body>
                <td-body>
                    {{ data.client.user.name + ' ' + data.client.lastname }}
                </td-body>
                <td-body>
                    {{ data.state.name }}
                </td-body>
                <td-body>
                    {{ data.delivery_type === 'delivery' ? 'Delivery' : 'Retiro de negocio' }}
                </td-body>
                <td-body>
                    {{ $filters.numeral($page.props.bs * total(data.order_products)) }}$
                </td-body>
                <td-body>
                    {{ $filters.numeral(total(data.order_products)) }}$
                </td-body>
                <td-body>
                    {{ this.$moment(data.updated_at).format('DD-MM-YYYY') }}
                </td-body>
                <td-body>
                    <vue-button
                        :href="route('orders.show',data.id)"
                        class="mr-2"
                        is="link"
                        variant="primary"
                    >
                        <i class="fas fa-eye"></i>
                    </vue-button>
                </td-body>
            </tr>
        </c-table>
        <paginator :paginator="orders"></paginator>
        <modal :show="modals.trash" v-if="rowTrash" @close="modals.trash = false">
            <div class="flex justify-between border-b border-gray-200 border-solid">
                <h3 class="text-gray-700 text-lg py-2 px-2">
                    Desea eliminar el producto {{ rowTrash.name }}
                </h3>
                <button
                    class="px-4 py-2 bg-gray-50 text-gray-700 hover:text-red-700 transition"
                    @click="modals.trash = false"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex justify-center m-8">
                <button class="bg-yellow-500 px-4 py-2 text-white mr-4 rounded" @click="modals.trash = false">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button class="bg-red-500 px-4 py-2 text-white rounded" @click="trash()">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </div>
        </modal>
    </div>
</template>
<script>
import Paginator from "@/Components/Paginator";
import modal from '@/Jetstream/Modal'
import cTable from '@/Components/Table'
import tdBody from '@/Components/TdBody'
import tdHead from '@/Components/TdHead'
import toast from '@/Components/Toast'
import vueButton from '@/Components/Button'
import {Inertia} from '@inertiajs/inertia'

export default {
    components: {
        Paginator,
        vueButton,
        toast,
        modal,
        cTable,
        tdBody,
        tdHead,
    },
    props: ['orders'],
    data() {
        return {
            rowTrash: null,
            modals: {
                trash: false,
                seeImage: false,
            },
        }
    },
    methods: {
        modalTrash(date) {
            this.rowTrash = date;
            this.modals.trash = true;
        },
        closeModal(modal) {
            this.modals[modal] = false;
            this.rowTrash = null;
        },
        total(products){
            let total = 0
            products.forEach(el=>{
                total += (el.price - (el.price / 100 * el.discount)) * el.quantity
            })
            return total
        },
        trash() {
            Inertia.delete(this.route('orders.destroy', this.rowTrash.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal('trash');
                }
            });
        },
    },
}
</script>
