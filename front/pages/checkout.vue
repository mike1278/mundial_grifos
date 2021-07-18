<template>
  <b-overlay :show="show">
    <b-container fluid class="py-3">
      <b-row>
        <b-col cols="12" lg="6" class="border-right">
          <div class="bg-white px-3 py-2 rounded">
            <h2 class="text-3xl text-weight-lg">Sumario de los artículos</h2>
            <hr />
            <b-form @submit.prevent="register">
              <b-row>
                <b-col cols="12" md="6">
                  <b-form-group label="Nombre">
                    <b-form-input
                      v-model="name"
                      class="border-right-0 border-left-0 border-top-0 rounded-0"
                      type="text"
                      disabled
                      placeholder="Nombre"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6">
                  <b-form-group label="Teléfono">
                    <b-form-input
                      v-model="phone"
                      class="border-right-0 border-left-0 border-top-0 rounded-0"
                      type="text"
                      disabled
                      placeholder="Teléfono"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6">
                  <b-form-group label="Tipo de entrega">
                    <b-form-select
                      v-model="delivery_type"
                      class="mb-3 border-right-0 border-left-0 border-top-0 rounded-0"
                    >
                      <b-form-select-option :value="null" disabled>
                        Seleccione un tipo de entrega
                      </b-form-select-option>
                      <b-form-select-option value="delivery">
                        Envío de la compra
                      </b-form-select-option>
                      <b-form-select-option value="pick up">
                        Retiro al negocio
                      </b-form-select-option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6">
                  <b-form-group label="Dirección">
                    <b-form-select
                      v-model="address"
                      class="mb-3 border-right-0 border-left-0 border-top-0 rounded-0"
                    >
                      <b-form-select-option :value="null" disabled>
                        Seleccione una dirección
                      </b-form-select-option>
                      <b-form-select-option
                        v-for="(location, i) in addresses"
                        :key="i"
                        class="border-right-0 border-left-0 border-top-0 rounded-0"
                        :value="location.id"
                      >
                        {{ location.location.address }}
                      </b-form-select-option>
                      <b-form-select-option
                        v-b-modal.newAddress
                        :value="null"
                        class="border-right-0 border-left-0 border-top-0 rounded-0"
                      >
                        Agregar una nueva dirección
                      </b-form-select-option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6">
                  <b-form-group label="Forma de pago">
                    <b-form-select
                      v-model="payment_type"
                      class="mb-3 border-right-0 border-left-0 border-top-0 rounded-0"
                    >
                      <b-form-select-option :value="null" disabled>
                        Seleccione la forma de pago
                      </b-form-select-option>
                      <b-form-select-option value="pay_on_shop">
                        Punto de venta
                      </b-form-select-option>
                      <b-form-select-option value="national_transfer">
                        Transferencia nacional
                      </b-form-select-option>
                      <b-form-select-option value="international_transfer">
                        Transferencia internacional
                      </b-form-select-option>
                      <b-form-select-option value="cash">
                        Efectivo
                      </b-form-select-option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6">
                  <b-form-group label="Referencia del pago">
                    <b-form-input
                      v-model="payment_code"
                      class="border-right-0 border-left-0 border-top-0 rounded-0"
                      type="text"
                      placeholder="Código de referencia"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="12">
                  <b-form-group label="Nota">
                    <b-form-textarea
                      id="textarea"
                      v-model="note"
                      placeholder="Nota"
                      class="border-right-0 border-left-0 border-top-0 rounded-0 overflow-auto"
                      rows="3"
                      max-rows="6"
                    ></b-form-textarea>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-form>
          </div>
        </b-col>
        <b-col cols="12" lg="6">
          <div class="bg-white px-3 py-2 rounded">
            <h2 class="text-3xl text-weight-lg">Resumen del pedido</h2>
            <hr />
            <ul v-if="cart" class="list-unstyled">
              <li
                v-for="product in cart.orderProducts"
                :key="product.product_id"
                class="d-flex justify-content-between border-bottom mb-2 pb-2"
              >
                <span class="pr-3">
                  {{ product.quantity }} x {{ product.product.name }} /
                  {{ product.color.name }}
                </span>
                <span>
                  {{
                    (discountedPrice(product) * product.quantity)
                      | numeral('0,0.00')
                  }}{{ currency.symbol }}
                </span>
              </li>
            </ul>
            <div
              v-if="cart"
              class="d-flex justify-content-between align-items-center"
            >
              <span>Total</span>
              <span class="text-weight-lg text-2xl"
                >{{ total | numeral('0,0.00') }}{{ currency.symbol }}</span
              >
            </div>
            <b-button
              variant="primary"
              class="text-weight-xl text-3xl w-100 mt-3 mb-2"
              squared
              @click="confirm"
            >
              CONFIRMAR ORDEN
            </b-button>
          </div>
        </b-col>
      </b-row>
    </b-container>
    <b-modal id="newAddress"></b-modal>
  </b-overlay>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  asyncData({ $auth }) {
    const user = $auth.user
    return {
      name: user.name + ' ' + user.client.lastname,
      addresses: user.client.addresses,
      phone: user.client.phone,
      dni: user.client.dni,
    }
  },
  data() {
    return {
      name: '',
      addresses: '',
      address: null,
      delivery_type: null,
      phone: '',
      note: '',
      payment_code: null,
      payment_type: null,
      show: false,
      errors: null,
    }
  },
  computed: {
    ...mapGetters({
      cart: 'cart/cart',
      currency: 'currency',
    }),
    total() {
      let total = 0
      this.cart.orderProducts.forEach((el) => {
        total += this.discountedPrice(el) * el.quantity
      })
      return total
    },
  },
  methods: {
    isDiscounted(product) {
      return product.discount > 0
    },
    discountedPrice(product) {
      let price = product.price
      if (product.discount > 0) {
        price -= (product.price / 100) * product.discount
      }
      price *= this.currency.rate
      return price
    },
    confirm() {
      this.$axios
        .$post('/orders/confirm', {
          name: this.name,
          address_id: this.address,
          delivery_type: this.delivery_type,
          phone: this.phone,
          note: this.note,
          payment_details: JSON.stringify({
            type: this.payment_type,
            code: this.payment_code,
          }),
        })
        .then(() => {
          this.$router.push('/thanks')
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
  },
}
</script>
