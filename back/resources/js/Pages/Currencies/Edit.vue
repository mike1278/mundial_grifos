<template>
    <form-section @submitted="submit()" title="Actualizar moneda" class="py-2 px-2">
        <template #form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <form-label for="name" class="h-6">Nombre</form-label>
                    <form-input id="name" v-model="form.name" placeholder="Nombre"/>
                    <form-field-error v-if="form.errors.name">{{ form.errors.name }}</form-field-error>
                </div>
                <div>
                    <form-label for="acronym" class="h-6">Acrónimo</form-label>
                    <form-input id="acronym" v-model="form.acronym" placeholder="USD, BS, EUR"/>
                    <form-field-error v-if="form.errors.acronym">{{ form.errors.acronym }}</form-field-error>
                </div>
                <div>
                    <form-label for="symbol" class="h-6">Símbolo</form-label>
                    <form-input id="symbol" v-model="form.symbol" placeholder="$, BS, €"/>
                    <form-field-error v-if="form.errors.symbol">{{ form.errors.symbol }}</form-field-error>
                </div>
                <div>
                    <form-label for="rate" class="h-6">Tasa cambiaria</form-label>
                    <form-input
                        id="rate"
                        v-model="form.rate"
                        placeholder="Tasa cambiaria desde $"
                        :disabled="!form.canModifyRate"
                    />
                    <form-field-error v-if="form.errors.rate">{{ form.errors.rate }}</form-field-error>
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
    props: ['currency'],
    setup (props) {
        const currency = props.currency
        const form = useForm({
            name: currency.name,
            acronym: currency.acronym,
            symbol: currency.symbol,
            rate: currency.rate ? currency.rate.rate : 1,
            canModifyRate: !!currency.rate,
        })

        return { form }
    },
    data(){
        return {}
    },
    methods: {
        submit() {
            this.form.put(this.route('currencies.update', this.currency.id), {
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
