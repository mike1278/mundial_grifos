<template>
    <div class="">
        <div
            class="col-span-3 min-h-screen"
            style="background: rgba(0, 0, 0, 0) url('/login.jpg') no-repeat scroll center center; background-size: cover;"
        >
            <jet-authentication-card>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="bg-white bg-opacity-80 px-4 py-3 rounded">
                    <div class="flex justify-center mb-2">
                        <jet-authentication-card-logo class="rounded-full" />
                    </div>
                    <div>
                        <jet-label for="email" value="Correo Electrónico" />
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
                    </div>
                    <div>
                        <label v-if="hasErrors" class="mt-3 list-disc list-inside text-sm text-red-600">
                            {{ Object.values(errors)[0] }}
                        </label>
                    </div>

                    <div class="mt-4">
                        <jet-label for="password" value="Clave" />
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <jet-checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-2 text-sm text-gray-600">Recuerdame</span>
                        </label>
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <inertia-link :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            ¿Recuperar Contraseña?
                        </inertia-link>

                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Iniciar Sesión
                        </jet-button>
                    </div>
                </form>
            </jet-authentication-card>
        </div>
    </div>
</template>
<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import withOutSession from '@/Layouts/withOutSession'

export default {
    layout: withOutSession,
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors
    },
    props: {
        status: String
    },
    data() {
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
            this.form.transform(data => ({
                ... data,
                remember: this.form.remember ? 'on' : ''
            }))
            .post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    },
    computed: {
        errors() {
            return this.$page.props.errors
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0;
        },
    },
}
</script>
