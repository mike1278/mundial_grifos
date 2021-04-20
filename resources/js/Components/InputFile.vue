<template>
    <div class="w-full">
        <input
            id="image"
            type="file"
            :multiple="multiple"
            class="hidden invisible"
            placeholder="Imagen"
            @change="setImage"
        />
        <label for="image" class="block border-gray-500 w-full hover:border-indigo-600 placeholder-gray-400 focus:border-indigo-600 outline-none border-b-2 p-2 shadow-sm">
            {{ isFile(modelValue) ? modelValue.name : placeholder }}
        </label>
    </div>
</template>
<script>
import formLabel from '@/Jetstream/Label'
export default {
    props: {
        modelValue: {
            default: null,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        label: {
            type: String,
            default: 'Archivo',
        },
        placeholder: {
            type: String,
            default: 'Seleccionar Archivo',
        }
    },
    components: {
        formLabel,
    },
    methods: {
        isFile(file) {
            return file instanceof File || file instanceof Blob
        },
        setImage(event){
            if(event.target.files.length === 0){
                return;
            }
            let files = event.target.files[0];
            if(this.multiple){
                files = event.target.files
            }
            this.$emit('update:modelValue',files)
        }
    }
}
</script>
