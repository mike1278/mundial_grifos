<template>
    <form-section @submitted="submit()" title="Actualizar modelo" class="py-2 px-2">
        <template #form>
            <div>
                <form-label for="name" class="h-6">Nombre</form-label>
                <form-input id="name" v-model="form.name" placeholder="Nombre"/>
                <form-field-error v-if="form.errors.name">{{ form.errors.name }}</form-field-error>
            </div>
        </template>
        <template #actions>
            <form-button type="submit" :disabled="form.processing">Guardar</form-button>
        </template>
    </form-section>
</template>
<script>
import vueSelect from '@/Components/select/index'
import formLabel from '@/Jetstream/Label'
import formSection from '@/Jetstream/FormSection'
import formInput from '@/Jetstream/Input'
import formButton from '@/Jetstream/Button'
import formFieldError from '@/Components/FieldError'
import {useForm} from '@inertiajs/inertia-vue3';
export default {
    components: {
        vueSelect,
        formFieldError,
        formButton,
        formInput,
        formLabel,
        formSection,
    },
    props: ['model'],
    setup (props) {
        const data = props.model
        const form = useForm({
            name: data.name,
        })

        return { form }
    },
    data(){
        return {}
    },
    methods: {
        submit() {
            this.form.post(this.route('models.update'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                    this.form.clearErrors()
                }
            })
        },
    }
}
</script>
