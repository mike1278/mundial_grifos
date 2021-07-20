<template>
    <div>
        <div class="flex justify-between mb-4 px-2">
            <h2 class="text-gray-700 text-xl">Productos</h2>
            <vue-button :href="route('products.create')" is="link" variant="primary">Crear</vue-button>
        </div>
        <c-table>
            <template #header>
                <tr>
                    <td-head>Id</td-head>
                    <td-head>Imagen</td-head>
                    <td-head>Nombre</td-head>
                    <td-head>Precio</td-head>
                    <td-head>Precio referencial</td-head>
                    <td-head>Acciones</td-head>
                </tr>
            </template>
            <tr v-for="data in products.data" :key="data.id">
                <td-body>
                    {{ data.id }}
                </td-body>
                <td-body class="flex justify-center">
                    <img :src="imageUrl('square-small') + data.images[0].url" class="w-8 h-8" :alt="data.name">
                </td-body>
                <td-body>{{ data.name }}</td-body>
                <td-body>{{ $filters.numeral($page.props.bs * data.price) }}Bs</td-body>
                <td-body>{{ $filters.numeral(data.price) }}$</td-body>
                <td-body>
                    <vue-button :href="route('products.show',data.id)" class="mr-2" is="link" variant="primary">
                        <i class="fas fa-eye"></i>
                    </vue-button>
                    <vue-button :href="route('products.edit',data.id)" class="mr-2" is="link" variant="primary">
                        <i class="fas fa-edit"></i>
                    </vue-button>
                    <vue-button @click="modalTrash(data)" class="mr-2" variant="danger">
                        <i class="fas fa-trash"></i>
                    </vue-button>
                </td-body>
            </tr>
        </c-table>
        <paginator :paginator="products"></paginator>
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
    props: ['products'],
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
        modalTrash(category) {
            this.rowTrash = category;
            this.modals.trash = true;
        },
        closeModal(modal) {
            this.modals[modal] = false;
            this.rowTrash = null;
        },
        trash() {
            Inertia.delete(this.route('products.destroy', this.rowTrash.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal('trash');
                }
            });
        },
    },
}
</script>
