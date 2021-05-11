<template>
    <div class="flex justify-between mb-4 px-2">
        <h2 class="text-gray-700 text-xl">Marcas</h2>
        <link-button :href="route('brands.create')">Crear</link-button>
    </div>
    <c-table>
        <template #header>
            <tr>
                <td-head>Id</td-head>
                <td-head>Nombre</td-head>
                <td-head>Editar</td-head>
                <td-head>Eliminar</td-head>
            </tr>
        </template>
        <tr v-for="data in brands.data" :key="data.id">
            <td-body>{{ data.id }}</td-body>
            <td-body>{{ data.name }}</td-body>
            <td-body>
                <link-button :href="route('brands.edit',data.id)">
                    <i class="fas fa-edit"></i>
                </link-button>
            </td-body>
            <td-body>
                <jet-button @click="modalTrash(data)">
                    <i class="fas fa-trash"></i>
                </jet-button>
            </td-body>
        </tr>
    </c-table>
    <paginator :paginator="brands"></paginator>
    <modal :show="trash" v-if="rowTrash">
        <div class="flex justify-between border-b border-gray-200 border-solid">
            <h3 class="text-gray-700 text-lg py-2 px-2">
                Desea eliminar la marca '{{ rowTrash.name }}'
            </h3>
            <button
                class="px-4 py-2 bg-gray-50 text-gray-700 hover:text-red-700 transition"
                @click="closeModal('trash')"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex justify-center m-8">
            <button class="bg-yellow-500 px-4 py-2 text-white mr-4 rounded" @click="closeModal('trash')">
                <i class="fas fa-times"></i> Cancelar
            </button>
            <button class="bg-red-500 px-4 py-2 text-white rounded" @click="trash()">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </div>
    </modal>
</template>
<script>
import Paginator from "@/Components/Paginator";
import modal from '@/Jetstream/Modal'
import cTable from '@/Components/Table'
import tdBody from '@/Components/TdBody'
import tdHead from '@/Components/TdHead'
import toast from '@/Components/Toast'
import jetButton from '@/Jetstream/Button'
import linkButton from '@/Components/ButtonLink'
import { Inertia } from '@inertiajs/inertia'
export default {
    components: {
        Paginator,
        jetButton,
        linkButton,
        toast,
        modal,
        cTable,
        tdBody,
        tdHead,
    },
    props: ['brands'],
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
        modalTrash(data){
            this.rowTrash = data;
            this.modals.trash = true;
        },
        closeModal(modal){
            this.modals[modal] = false;
            this.rowTrash = null;
        },
        trash(){
            Inertia.delete(this.route('brands.destroy',this.rowTrash.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal('trash');
                }
            });
        },
    },
}
</script>
