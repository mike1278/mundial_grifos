<template>
    <form-section @submitted="submit()" class="py-2 px-2">
        <template #title>
            <div class="flex justify-between">
                <span>Crear Producto</span>
                <div class="flex">
                    <form-label for="brand" class="h-6 hidden md:inline-block">Publicado:</form-label>
                    <form-switch v-model="form.published"/>
                </div>
            </div>
        </template>
        <template #form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <form-label for="name" class="h-6">Nombre</form-label>
                    <form-input id="name" v-model="form.name" placeholder="Nombre"/>
                    <form-field-error v-if="form.errors.name">{{ form.errors.name }}</form-field-error>
                </div>
                <div>
                    <form-label for="price" class="h-6">Precio</form-label>
                    <form-input-group append="$">
                        <form-input id="price" v-model="form.price" placeholder="Precio"/>
                    </form-input-group>
                    <form-field-error v-if="form.errors.price">{{ form.errors.price }}</form-field-error>
                </div>
                <div>
                    <form-label for="discount" class="h-6">Descuento</form-label>
                    <form-input-group append="%">
                        <form-input id="discount" v-model="form.discount" placeholder="Descuento"/>
                    </form-input-group>
                    <form-field-error v-if="form.errors.discount">{{ form.errors.discount }}</form-field-error>
                </div>
                <div>
                    <form-label for="quantity" class="h-6">Cantidad</form-label>
                    <form-input id="quantity" v-model="form.quantity" placeholder="Cantidad"/>
                    <form-field-error v-if="form.errors.quantity">{{ form.errors.quantity }}</form-field-error>
                </div>
                <div>
                    <form-label for="serialCode" class="h-6">Código Serial</form-label>
                    <form-input id="serialCode" v-model="form.serial_code" placeholder="Código Serial"/>
                    <form-field-error v-if="form.errors.serial_code">{{ form.errors.serial_code }}</form-field-error>
                </div>
                <div>
                    <form-label class="h-6">Categoria</form-label>
                    <vue-select
                        :options="categories"
                        label="name"
                        v-model="form.category_id"
                        :reduce="(data) => data.id"
                        placeholder="Seleccionar Categoria"
                    />
                    <form-field-error v-if="form.errors.category_id">{{ form.errors.category_id }}</form-field-error>
                </div>
                <div>
                    <form-label class="h-6">Marca</form-label>
                    <vue-select
                        :options="brands"
                        label="name"
                        v-model="form.brand_id"
                        :reduce="(data) => data.id"
                        placeholder="Seleccionar Marca"
                    />
                    <form-field-error v-if="form.errors.brand_id">{{ form.errors.brand_id }}</form-field-error>
                </div>
                <div>
                    <form-label class="h-6">Colores</form-label>
                    <vue-select
                        multiple
                        :options="colors"
                        label="name"
                        v-model="form.colors"
                        :reduce="(data) => data.id"
                        placeholder="Seleccionar Colores"
                    />
                    <form-field-error v-if="form.errors.colors">{{ form.errors.colors }}</form-field-error>
                </div>
                <div>
                    <form-label class="h-6">Modelo</form-label>
                    <vue-select
                        :options="models"
                        label="name"
                        v-model="form.model_id"
                        :reduce="(data) => data.id"
                        placeholder="Seleccionar Modelo"
                    />
                    <form-field-error v-if="form.errors.model_id">{{ form.errors.model_id }}</form-field-error>
                </div>
            </div>
            <div class="w-full mb-4">
                <form-label for="description" class="h-6">Descripción</form-label>
                <textarea
                    id="description"
                    v-model="form.description"
                    placeholder="Descripción"
                    class="w-full border-2 border-gray-400 hover:border-blue-600"
                ></textarea>
                <form-field-error v-if="form.errors.description">{{ form.errors.description }}</form-field-error>
            </div>
            <div class="w-full">
                <form-label for="image" class="h-6">Imágenes</form-label>
                <dropzone :options="optionsDropzone" @new-file="pushFile"/>
                <form-field-error v-if="form.errors.images">{{ form.errors.images }}</form-field-error>
            </div>
        </template>
        <template #actions>
            <form-button type="submit" :disabled="form.processing">Guardar</form-button>
        </template>
    </form-section>
</template>
<script>
import inputFile from '@/Components/InputFile'
import dropzone from '@/Components/Dropzone'
import formLabel from '@/Jetstream/Label'
import formSection from '@/Jetstream/FormSection'
import formInput from '@/Jetstream/Input'
import formSwitch from '@/Components/switch'
import formInputGroup from '@/Components/InputGroup'
import formButton from '@/Jetstream/Button'
import formFieldError from '@/Components/FieldError'
import Compressor from 'compressorjs'
import vueSelect from '@/Components/select/index'

export default {
    components: {
        formSwitch,
        formInputGroup,
        formInput,
        formLabel,
        formFieldError,
        formButton,
        vueSelect,
        dropzone,
        formSection,
        inputFile,
    },
    props:['categories','brands','colors','models'],
    data(){
        return {
            form: this.$inertia.form({
                name: '',
                description: '',
                published: true,
                serial_code: '',
                discount: 0,
                price: 0,
                quantity: 0,
                images: [],
                colors: [],
                category_id: null,
                brand_id: null,
                model_id: null,
            }),
            optionsDropzone:{
                acceptedFiles: 'image/*',
                url: this.route('files.store'),
                maxFilesize: 10,
                dictDefaultMessage: 'Suelta aquí los archivos',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                paramName: "file",
                withCredentials: true,
                transformFile: (file, done) => {
                    new Compressor(file, {
                        maxWidth: 1900,
                        maxHeight: 1900,
                        quality: 0.9,
                        success: function (result) {
                            done(result)
                        },
                        error: function (err) {},
                    })
                },
            },
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('products.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                    this.form.clearErrors()
                }
            })
        },
        pushFile(file){
            this.form.images.push(file)
        },
    }
}
</script>
