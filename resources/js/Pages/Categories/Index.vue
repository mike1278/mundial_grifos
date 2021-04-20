<template>
    <div class="flex justify-between mb-4 px-2">
        <h2 class="text-gray-700 text-xl">Categorías</h2>
        <link-button :href="route('categories.create')">Crear</link-button>
    </div>
    <c-table>
        <template #header>
            <tr>
                <td-head>Id</td-head>
                <td-head>Nombre</td-head>
                <td-head>Imagen</td-head>
                <td-head>Editar</td-head>
                <td-head>Eliminar</td-head>
            </tr>
        </template>
        <tr v-for="category in categories.data" :key="category.id">
            <td-body>{{ category.id }}</td-body>
            <td-body>{{ category.name }}</td-body>
            <td-body class="flex justify-center">
                <img :src="imageUrl('square-small')+category.image.url" class="w-8 h-8" :alt="category.name">
            </td-body>
            <td-body>
                <link-button :href="route('categories.edit',category.id)">
                    <i class="fas fa-edit"></i>
                </link-button>
            </td-body>
            <td-body>
                <jet-button @click="modalTrash(category)">
                    <i class="fas fa-trash"></i>
                </jet-button>
            </td-body>
        </tr>
    </c-table>
    <paginator :paginator="categories"></paginator>
    <modal :show="trash" v-if="categoryTrash">
        <div class="flex justify-between border-b border-gray-200 border-solid">
            <h3 class="text-gray-700 text-lg py-2 px-2">
                Desea eliminar la categoria {{ categoryTrash.name }}
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
    props: ['categories'],
    data() {
        return {
            categoryTrash: null,
            modals: {
                trash: false,
                seeImage: false,
            },
        }
    },
    methods: {
        modalTrash(category){
            this.categoryTrash = category;
            this.modals.trash = true;
        },
        closeModal(modal){
            this.modals[modal] = false;
            this.categoryTrash = null;
        },
        trash(){
            Inertia.delete(this.route('categories.destroy',this.categoryTrash.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal('trash');
                }
            });
        },
    },
}
</script>
