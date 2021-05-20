<template>
  <b-container
    class="d-flex justify-content-center align-items-center min-vh-100"
  >
    <b-form style="max-width: 400px; min-width: 280px" @submit.prevent="login">
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
          Debe ser valido
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
          Debe ser mínimo 6 caracteres
        </b-form-invalid-feedback>
        <b-form-invalid-feedback
          v-show="!$v.password.max && $v.password.$dirty"
        >
          Debe ser maximo 16 caracteres
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group class="flex justify-content-end">
        <b-button variant="primary" type="submit">Iniciar Sesión</b-button>
      </b-form-group>
    </b-form>
  </b-container>
</template>
<script lang="ts">
import Vue from 'vue'
import { validationMixin } from 'vuelidate'
import { required, email, minLength, maxLength } from 'vuelidate/lib/validators'
export default Vue.extend({
  mixins: [validationMixin],
  middleware: 'guest',
  data() {
    return {
      email: '' as string,
      password: '' as string,
    }
  },
  head() {
    return {
      title: 'Inicio de Sesión | Red De Venta',
      meta: [
        { content: 'Inicio de sesión | Red De Venta', property: 'og:title' },
      ],
    }
  },
  validations: {
    email: {
      required,
      email,
    },
    password: {
      required,
      min: minLength(6),
      max: maxLength(16),
    },
  },
  methods: {
    async login() {
      await this.$auth
        .loginWith('laravelPassport', {
          data: {
            username: this.email,
            password: this.password,
          },
        })
        .then(() => this.$router.push('/'))
        .catch((e) => this.processError(e))
    },
  },
})
</script>
