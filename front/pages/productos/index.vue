<template>
  <div>
    <b-container class="mt-3">
      <b-row class="justify-content-center justify-content-lg-start">
        <product
          v-for="(product, i) in products.data"
          :key="i + 'product'"
          :data="product"
        />
      </b-row>
    </b-container>
  </div>
</template>
<script>
import product from '@/components/Card/Product'
import gql from 'graphql-tag'
import { filters } from '@/functions/filters'

export default {
  components: {
    product,
  },
  async asyncData({ $axios, query }) {
    let products = []
    const filter = filters(['category', 'model', 'brand'], query)
    await $axios
      .$get('products?' + filter)
      .then((result) => {
        products = result
      })
      .catch(() => {})
    return {
      products,
    }
  },
  data() {
    return {
      products: {},
      categories: {},
      models: {},
      brands: {},
      currentPage: 0,
      filters: {
        category: null,
        model: null,
        brand: null,
      },
    }
  },
  watch: {
    filters: {
      deep: true,
      handler: [
        async function (val) {
          await this.$router.push({
            path: '/products',
            query: val,
          })
        },
        'getProducts',
      ],
    },
  },
  methods: {
    getProducts() {
      const filter = filters(['category', 'model', 'brand'], this.$route.query)
      this.$axios
        .$get('/products?' + filter)
        .then((result) => {
          this.products = result
        })
        .catch((error) => {})
    },
  },
  apollo: {
    allCategories: {
      query: gql`
        query {
          allCategories {
            id
            name
          }
          allModels {
            id
            name
          }
          allBrands {
            id
            name
          }
        }
      `,
      result(data) {
        this.categories = data.allCategories
        this.models = data.allModels
        this.brands = data.allBrands
      },
    },
  },
}
</script>
