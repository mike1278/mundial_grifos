<template>
  <nuxt-link
    :to="'/productos/' + data.id"
    class="w-16 card product shadow p-1 m-2"
  >
    <b-aspect aspect="1">
      <img
        :src="imageUrl('square-medium') + data.images[0].url"
        :alt="data.name"
        class="w-100 h-100"
      />
    </b-aspect>
    <div class="info px-2 mt-2">
      <p class="pt-2 category mb-3">
        {{ data.category.name }} / {{ data.model.name }}
      </p>
      <p class="title mb-3 text-weight-lg">{{ data.name }}</p>
      <client-only>
        <p class="price text-2xl mb-4">
          {{ currency.symbol }} {{ discountedPrice | numeral('0,0.00') }}
        </p>
      </client-only>
    </div>
  </nuxt-link>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  computed: {
    ...mapGetters({
      currency: 'currency',
    }),
    price() {
      return this.data.price * this.currency.rate
    },
    isDiscounted() {
      return this.data.discount > 0
    },
    discountedPrice() {
      let price = this.data.price
      if (this.data.discount > 0) {
        price -= (this.data.price / 100) * this.data.discount
      }
      price *= this.currency.rate
      return price
    },
  },
}
</script>
