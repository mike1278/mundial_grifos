<template>
  <b-modal id="login" size="md" hide-footer title="Iniciar Sesión">
    <b-form @submit.prevent="login">
      <b-form-group label="Correo">
        <b-form-input
          id="email"
          v-model.trim="$v.email.$model"
          type="email"
          :state="$v.email.$dirty ? !$v.email.$invalid : null"
          placeholder="Correo Electrónico"
          @blur="$v.email.$touch()"
          @input="$v.email.$reset()"
        />
        <b-form-invalid-feedback v-show="!$v.email.required && $v.email.$dirty">
          Debe ingresar el correo electrónico
        </b-form-invalid-feedback>
        <b-form-invalid-feedback v-show="!$v.email.email && $v.email.$dirty">
          Debe ser un correo valido
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group label="Clave">
        <b-form-input
          id="password"
          v-model.trim="$v.password.$model"
          type="password"
          :state="$v.password.$dirty ? !$v.password.$invalid : null"
          placeholder="Clave"
          @blur="$v.password.$touch()"
          @input="$v.password.$reset()"
        />
        <b-form-invalid-feedback
          v-show="!$v.password.required && $v.password.$dirty"
        >
          Debe ingresar un la clave
        </b-form-invalid-feedback>
        <b-form-invalid-feedback
          v-show="!$v.password.min && $v.password.$dirty"
        >
          Debe ser mínimo 8 caracteres
        </b-form-invalid-feedback>
        <b-form-invalid-feedback
          v-show="!$v.password.max && $v.password.$dirty"
        >
          Debe ser maximo 16 caracteres
        </b-form-invalid-feedback>
      </b-form-group>
      <span v-show="error" class="text-danger my-2">
        Las credenciales son incorrectas
      </span>
      <hr />
      <div class="d-flex justify-content-between">
        <b-button variant="transparent" class="underline"
          >¿Olvidó su contraseña?</b-button
        >
        <b-button variant="primary" type="submit">Iniciar Sesión</b-button>
      </div>
    </b-form>
  </b-modal>
</template>
<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength, maxLength } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  middleware: 'guest',
  data() {
    return {
      email: '',
      password: '',
      error: false,
    }
  },
  validations: {
    email: {
      required,
      email,
    },
    password: {
      required,
      min: minLength(8),
      max: maxLength(16),
    },
  },
  methods: {
    async login() {
      this.error = false
      this.$v.$touch()
      if (this.$v.$invalid) {
        return this.toast('Error', 'El formulario tiene errores', 'warning')
      }
      await this.$auth
        .loginWith('laravelPassport', {
          data: {
            username: this.email,
            password: this.password,
          },
        })
        .then(() => {
          this.$bvModal.hide('login')
          this.$store.dispatch('cart/getActiveOrder')
        })
        .catch(() => {
          this.error = true
        })
    },
  },
}
</script>
