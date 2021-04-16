<template>
    <form-section @submitted="submit()">
        <template #title>Crear Producto</template>

        <template #actions>Guardar</template>
    </form-section>
</template>
<script>
import formSection from '@/Jetstream/FormSection'
import formInput from '@/Jetstream/Input'
import formButton from '@/Jetstream/Button'
export default {
    components: {
        formButton,
        formInput,
        formSection,
    },
    data(){
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },
    methods: {
        submit() {

        }
    }
}
</script>
