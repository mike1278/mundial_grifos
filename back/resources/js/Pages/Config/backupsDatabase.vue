<template>
    <div>
        <div class="flex justify-between mb-4 px-2">
            <h2 class="text-gray-700 text-xl">Backups</h2>
            <t-button :href="route('backups.create')" is="link" variant="primary">Crear</t-button>
        </div>
        <c-table>
            <template #header>
                <tr>
                    <td-head>Id</td-head>
                    <td-head>Nombre</td-head>
                    <td-head>Acciones</td-head>
                </tr>
            </template>
            <tr v-for="(backup,i) in backups.data" :key="i">
                <td-body>
                    {{ backup.id }}
                </td-body>
                <td-body class="flex justify-center">
                    {{ backup.file_name }}
                </td-body>
                <td-body>
                    <t-button @click="restore(backup.file_name)" class="mr-2" variant="primary">
                        <i class="fas fa-undo-alt"></i>
                    </t-button>
<!--                    <t-button @click="modalTrash(backup.file_name)" class="mr-2" variant="danger">-->
<!--                        <i class="fas fa-trash"></i>-->
<!--                    </t-button>-->
                </td-body>
            </tr>
        </c-table>
        <paginator :paginator="backups"></paginator>
        <modal :show="modals.trash" v-if="rowTrash" @close="modals.trash = false">
            <div class="flex justify-between border-b border-gray-200 border-solid">
                <h3 class="text-gray-700 text-lg py-2 px-2">
                    Desea eliminar el backup {{ rowTrash.file_name }}
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
import TButton from '@/Components/Button'
import {Inertia} from '@inertiajs/inertia'

export default {
    components: {
        Paginator,
        TButton,
        toast,
        modal,
        cTable,
        tdBody,
        tdHead,
    },
    props: ['backups'],
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
        modalTrash(data) {
            this.rowTrash = data;
            this.modals.trash = true;
        },
        restore(backup) {
            Inertia.post(this.route('restore'),{
                file: backup,
            },{
                preserveScroll: true,
            });
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
