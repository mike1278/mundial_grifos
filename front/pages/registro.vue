<template>
  <div class="d-flex px-5 py-5 bg-gray-100">
    <b-form
      class="col col-12 col-md-7 bg-white px-5 pb-5 pt-2 rounded-left"
      @submit.prevent="register"
    >
      <div class="d-flex justify-content-center">
        <h2
          class="text-gray-700 text-3xl text-weight-xl mt-4 text-center mb-4 border-bottom"
        >
          Registro
        </h2>
      </div>
      <b-overlay :show="show">
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group label="Nombre">
              <b-form-input
                v-model="name"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="text"
                placeholder="Nombre"
                :state="$v.name.$dirty ? !$v.name.$invalid : null"
                @blur="$v.name.$touch()"
                @input="$v.name.$reset()"
              />
              <span v-if="errors && errors.name" class="text-danger">
                {{ errors.name[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.name.required && $v.name.$dirty"
              >
                Debe ingresar un nombre
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.name.minLength && $v.name.$dirty"
              >
                Debe contener mínimo 4 caracteres
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Apellido">
              <b-form-input
                v-model="lastname"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="text"
                placeholder="Apellido"
                :state="$v.lastname.$dirty ? !$v.lastname.$invalid : null"
                @blur="$v.lastname.$touch()"
                @input="$v.lastname.$reset()"
              />
              <span v-if="errors && errors.lastname" class="text-danger">
                {{ errors.lastname[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.lastname.required && $v.lastname.$dirty"
              >
                Debe ingresar un apellido
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.lastname.minLength && $v.lastname.$dirty"
              >
                Debe contener mínimo 4 caracteres
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Correo electrónico">
              <b-form-input
                id="email"
                v-model.trim="$v.email.$model"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="email"
                :state="$v.email.$dirty ? !$v.email.$invalid : null"
                placeholder="ej. maria@gmail.com"
                @blur="$v.email.$touch()"
                @input="$v.email.$reset()"
              />
              <span v-if="errors && errors.email" class="text-danger">
                {{ errors.email[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.email.required && $v.email.$dirty"
              >
                Debe ingresar el correo electrónico
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.email.email && $v.email.$dirty"
              >
                Debe ser valido
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Cédula">
              <b-form-input
                v-model="dni"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                placeholder="ej. 24567134"
                :state="$v.dni.$dirty ? !$v.dni.$invalid : null"
                @blur="$v.dni.$touch()"
                @input="$v.dni.$reset()"
              />
              <span v-if="errors && errors.dni" class="text-danger">
                {{ errors.dni[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.dni.required && $v.dni.$dirty"
              >
                La cédula es necesario
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.dni.minLength && $v.dni.$dirty"
              >
                La cédula es mínimo de 7 dígitos
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.password.max && $v.password.$dirty"
              >
                Debe ser maximo 8 dígitos
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Clave">
              <b-form-input
                id="password"
                v-model.trim="$v.password.$model"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="password"
                :state="$v.password.$dirty ? !$v.password.$invalid : null"
                placeholder="Clave"
                @blur="$v.password.$touch()"
                @input="$v.password.$reset()"
              />
              <span v-if="errors && errors.password" class="text-danger">
                {{ errors.password[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.password.required && $v.password.$dirty"
              >
                Debe ingresar una clave
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
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Confirmación de clave">
              <b-form-input
                id="password_confirmation"
                v-model.trim="password_confirmation"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="password"
                :state="
                  $v.password_confirmation.$dirty
                    ? !$v.password_confirmation.$invalid
                    : null
                "
                placeholder="Confirmación de clave"
                @blur="$v.password_confirmation.$touch()"
                @input="$v.password_confirmation.$reset()"
              />
              <b-form-invalid-feedback
                v-if="errors && errors.password_confirmation"
              >
                {{ errors.password_confirmation[0] }}
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="
                  !$v.password_confirmation.required &&
                  $v.password_confirmation.$dirty
                "
              >
                Debe ingresar una clave
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="
                  !$v.password_confirmation.same &&
                  $v.password_confirmation.$dirty
                "
              >
                Las claves deben ser iguales
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Teléfono">
              <b-form-input
                v-model="phone"
                class="border-right-0 border-left-0 border-top-0 rounded-0"
                type="tel"
                placeholder="ej. 04147562154"
                :state="$v.phone.$dirty ? !$v.phone.$invalid : null"
                @blur="$v.phone.$touch()"
                @input="$v.phone.$reset()"
              />
              <span v-if="errors && errors.phone" class="text-danger">
                {{ errors.phone[0] }}
              </span>
              <b-form-invalid-feedback
                v-show="!$v.phone.required && $v.phone.$dirty"
              >
                Debe ingresar un numero de teléfono
              </b-form-invalid-feedback>
              <b-form-invalid-feedback
                v-show="!$v.phone.phone && $v.phone.$dirty"
              >
                El numero de teléfono debe ser valido
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group label="Dirección">
              <b-input-group>
                <b-form-input
                  v-model="location.address"
                  v-b-modal.modal-location
                  class="border-right-0 border-left-0 border-top-0 rounded-0 bg-white"
                  readonly
                  placeholder="Dirección"
                />
                <template #append>
                  <b-button
                    v-b-modal.modal-location
                    class="pointer border-right-0 border-left-0 border-top-0"
                    squared
                    variant="outline-secondary"
                  >
                    <font-awesome-icon icon="map-marker-alt" />
                  </b-button>
                </template>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
      </b-overlay>
      <div class="d-flex justify-content-center mt-2">
        <b-button variant="primary" pill type="submit">Registrarse</b-button>
      </div>
    </b-form>
    <div class="bg-white col col-12 col-md-5 px-0 rounded-right">
      <img
        src="/img/registro.jpg"
        alt="registro"
        class="w-100 h-100 rounded-right"
      />
    </div>
    <b-modal
      id="modal-location"
      size="xl"
      centered
      class="map-register"
      hide-header
    >
      <map-autocomplete
        :center="center"
        @ubication="
          (data) => {
            location.lat = data.lat
            location.lng = data.lng
          }
        "
        @address="(data) => (location.address = data)"
      />
    </b-modal>
  </div>
</template>
<script>
import { validationMixin } from 'vuelidate'
import {
  required,
  email,
  minLength,
  maxLength,
  sameAs,
} from 'vuelidate/lib/validators'
import axios from 'axios'
import mapAutocomplete from '@/components/googleMaps'
import { phone } from '~/functions/validations'

export default {
  components: {
    mapAutocomplete,
  },
  mixins: [validationMixin],
  middleware: 'guest',
  data() {
    return {
      name: '',
      lastname: '',
      phone: '',
      dni: '',
      email: '',
      password: '',
      show: false,
      location: {
        address: '',
        lat: 10.952042061520643,
        lng: -63.866300351074486,
      },
      password_confirmation: '',
      errors: null,
    }
  },
  computed: {
    center() {
      return {
        lat: this.location.lat,
        lng: this.location.lng,
      }
    },
  },
  mounted() {
    const origin = this.location.lat + ',' + this.location.lng
    axios
      .get(
        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${origin}&key=${this.$config.apiGoogleMaps}`
      )
      .then((result) => {
        this.direccion = result.data.results[0].formatted_address
      })
  },
  validations: {
    name: {
      required,
      minLength: minLength(2),
    },
    lastname: {
      required,
      minLength: minLength(2),
    },
    password_confirmation: {
      sameAsPassword: sameAs('password'),
    },
    dni: {
      required,
      min: minLength(7),
      max: maxLength(8),
    },
    email: {
      required,
      email,
    },
    password: {
      required,
      min: minLength(8),
      max: maxLength(16),
    },
    phone: {
      required,
      phone,
    },
  },
  methods: {
    register() {
      this.error = null
      this.$v.$touch()
      if (this.$v.$invalid) {
        return this.$bvToast.toast('El formulario tiene errores', {
          variant: 'warning',
          title: 'Error',
        })
      }
      this.show = true
      this.$axios
        .$post('/auth/register', {
          name: this.name,
          lastname: this.lastname,
          phone: this.phone,
          dni: this.dni,
          email: this.email,
          password: this.password,
          location: this.location,
          password_confirmation: this.password_confirmation,
        })
        .then((result) => {
          this.clean()
          this.$v.$reset()
          return this.$bvToast.toast(result.message, {
            variant: 'success',
          })
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
            return
          }
          this.processError(error)
        })
        .finally(() => {
          this.show = false
        })
    },
    clean() {
      this.name = null
      this.lastname = null
      this.phone = null
      this.dni = null
      this.email = null
      this.password = null
      this.location = {
        address: '',
        lat: 10.952042061520643,
        lng: -63.866300351074486,
      }
      this.password_confirmation = null
    },
  },
}
</script>
