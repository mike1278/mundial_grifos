<template>
  <b-container fluid class="py-3" style="background: rgb(243, 243, 243)" v-if="cart">
    <b-row>
      <b-col cols="12" lg="8">
        <div class="bg-white px-3 py-2 rounded">
          <h2 class="text-3xl text-weight-lg">Sumario de los artículos</h2>
          <table class="w-100 my-4">
            <thead>
              <tr class="border-bottom">
                <th class="pb-2">Artículo</th>
                <th class="pb-2">Precio</th>
                <th class="pb-2">Cantidad</th>
                <th class="pb-2">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="product in cart.products"
                :key="product.id + 'product'"
              >
                <th class="pt-3 d-flex">
                  <img
                    :src="
                      imageUrl('square-medium') + '/' + product.images[0].url
                    "
                    style="width: 80px"
                    alt="Desagüe Universal"
                  />
                  <h3 class="text-lg">{{ product.name }}</h3>
                </th>
                <th class="pt-3 text-weight-lg">
                  <span :class="isDiscounted(product) ? 'discounted' : ''"
                    >{{ product.pivot.price | numeral('0,0.00')
                    }}{{ currency }}</span
                  >
                  <span v-show="isDiscounted(product)">
                    {{ discountedPrice(product) | numeral('0,0.00')
                    }}{{ currency }}
                  </span>
                </th>
                <th class="pt-3">
                  <input-step />
                </th>
                <th class="pt-3">
                  {{ discountedPrice(product) * product.pivot.quantity
                  }}{{ currency }}
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </b-col>
      <b-col cols="12" lg="4">
        <div class="bg-white px-3 py-2 rounded">
          <h2 class="text-3xl text-weight-lg">Resumen Del Pedido</h2>
          <hr />
          <div class="d-flex justify-content-between align-items-center">
            <span>Subtotal</span>
            <span class="text-weight-lg text-2xl"
              >{{ total }}{{ currency }}</span
            >
          </div>
          <b-button
            variant="primary"
            class="text-weight-xl text-3xl w-100 mt-3 mb-2"
            squared
          >
            PAGAR
          </b-button>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import inputStep from '@/components/form/step-input'
import { mapGetters } from 'vuex'
export default {
  components: {
    inputStep,
  },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      cart: 'cart/cart',
      currency: 'currency',
    }),
    total() {
      let total = 0
      this.cart.products.forEach((el) => {
        total += this.discountedPrice(el) * el.pivot.quantity
      })
      return total
    },
  },
  methods: {
    isDiscounted(product) {
      return product.pivot.discount > 0
    },
    discountedPrice(product) {
      let price = product.pivot.price
      if (product.pivot.discount > 0) {
        price -= (product.pivot.price / 100) * product.pivot.discount
      }
      return price
    },
  },
}
</script>
