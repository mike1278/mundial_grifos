<template>
  <b-overlay :show="show">
    <b-container fluid class="py-3" style="background: rgb(243, 243, 243)">
      <b-row>
        <b-col cols="12" lg="8">
          <div class="bg-white px-3 py-2 rounded">
            <h2 class="text-3xl text-weight-lg">Datos de factura</h2>
            <table class="w-100 my-4">
              <thead>
                <tr class="border-bottom">
                  <th class="pb-2">Artículo</th>
                  <th class="pb-2">Precio</th>
                  <th class="pb-2">Cantidad</th>
                  <th class="pb-2">Subtotal</th>
                  <th class="pb-2"></th>
                </tr>
              </thead>
              <tbody v-if="cart">
                <tr
                  v-for="product in cart.orderProducts"
                  :key="product.product.id + 'product'"
                >
                  <th class="pt-3 d-flex">
                    <div
                      class="position-relative mr-4"
                      style="width: 80px; height: 80px"
                    >
                      <img
                        class="scale-1.5 w-100"
                        :src="
                          imageUrl('square-medium') +
                          product.product.images[0].url
                        "
                        alt="Desagüe Universal"
                      />
                    </div>
                    <div>
                      <h3 class="text-lg mb-1">{{ product.product.name }}</h3>
                      <p>Color {{ product.color.name }}</p>
                    </div>
                  </th>
                  <th class="pt-3 text-weight-lg">
                    <div :class="isDiscounted(product) ? 'onDiscount' : ''">
                      <span class="mr-2">
                        {{ (product.price * currency.rate) | numeral('0,0.00')
                        }}{{ currency.symbol }}
                      </span>
                      <span v-show="isDiscounted(product)"
                        >(-{{ product.discount }}%)</span
                      >
                    </div>
                    <div v-show="isDiscounted(product)">
                      {{ discountedPrice(product) | numeral('0,0.00')
                      }}{{ currency.symbol }}
                    </div>
                  </th>
                  <th class="pt-3">
                    <input-step
                      :value="product.quantity"
                      @input="(data) => updateQuantity(product, data)"
                    />
                  </th>
                  <th class="pt-3">
                    {{
                      (discountedPrice(product) * product.quantity)
                        | numeral('0,0.00')
                    }}{{ currency.symbol }}
                  </th>
                  <th class="pt-3">
                    <b-button variant="transparent">
                      <font-awesome-icon
                        icon="trash"
                        class="text-danger"
                        @click="updateQuantity(product, 0)"
                      />
                    </b-button>
                  </th>
                </tr>
              </tbody>
            </table>
          </div>
        </b-col>
        <b-col cols="12" lg="4">
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
              to="/checkout"
              class="text-weight-xl text-3xl w-100 mt-3 mb-2"
              squared
            >
              PAGAR
            </b-button>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </b-overlay>
</template>
<script>
import inputStep from '@/components/form/step-input'
import { mapGetters } from 'vuex'
export default {
  components: {
    inputStep,
  },
  data() {
    return {
      show: false,
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
    updateQuantity(product, quantity) {
      this.$nuxt.$loading.start()
      this.$store
        .dispatch('cart/updateQuantity', {
          id: product.product.id,
          color_id: product.product_color_id,
          quantity,
        })
        .then((result) => {
          this.$bvToast.toast(result.message, {
            variant: 'success',
          })
        })
        .catch((error) => {
          this.processError(error)
        })
        .finally(() => {
          this.$nuxt.$loading.finish()
        })
    },
  },
}
</script>
