<template>
    <form-section @submitted="submit()" title="Crear Categoria" class="py-2 px-2">
        <template #form>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <form-label for="name" class="h-6">Nombre categoria</form-label>
                    <form-input id="name" v-model="form.name" placeholder="Nombre Categoria"/>
                    <form-field-error v-if="form.errors.name">{{ form.errors.name }}</form-field-error>
                </div>
                <div>
                    <form-label for="image" class="h-6">Imagen</form-label>
                    <div class="flex items-end">
                        <img :src="imageUrl('square-small')+category.image.url" :alt="category.name" class="w-8 h-8 mr-2">
                        <input-file v-model="originalImage" placeholder="Seleccionar Imagen"/>
                    </div>
                    <form-field-error v-if="form.errors.image">{{ form.errors.image }}</form-field-error>
                </div>
                <div>
                    <form-label for="category" class="h-6">Categoria Padre</form-label>
                    <vue-select
                        :options="categories"
                        label="name"
                        v-model="form.category_id"
                        :reduce="(data) => data.id"
                        placeholder="Seleccionar Categoria"
                    />
                    <form-field-error v-if="form.errors.category_id">{{ form.errors.category_id }}</form-field-error>
                </div>
            </div>
        </template>
        <template #actions>
            <form-button type="submit" :disabled="form.processing">Guardar</form-button>
        </template>
    </form-section>
</template>
<script>
import vueSelect from '@/Components/select/index'
import inputFile from '@/Components/InputFile'
import formLabel from '@/Jetstream/Label'
import formSection from '@/Jetstream/FormSection'
import formInput from '@/Jetstream/Input'
import formButton from '@/Jetstream/Button'
import formFieldError from '@/Components/FieldError'
import Compressor from 'compressorjs'
import { useForm } from '@inertiajs/inertia-vue3'
export default {
    components: {
        vueSelect,
        formFieldError,
        formButton,
        formInput,
        formLabel,
        formSection,
        inputFile,
    },
    props:['categories','category'],
    setup (props) {
        const form = useForm({
            name: props.category.name,
            image: null,
            category_id: props.category.category_id,
        })

        return { form }
    },
    data(){
        return {
            originalImage: null,
        }
    },
    watch:{
        originalImage(val){
            const self = this;
            new Compressor(val, {
                maxWidth: 1900,
                maxHeight: 1900,
                quality: 0.9,
                success: function (result) {
                    self.form.image = result
                },
                error: function (err) {},
            })
        }
    },
    methods: {
        submit() {
            this.form
                .transform((data)=>({
                    ...data,
                    _method: 'put',
                }))
                .put(this.route('categories.update',this.category.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                    this.form.clearErrors()
                    this.originalImage = null
                }
            })
        },
    }
}
</script>
