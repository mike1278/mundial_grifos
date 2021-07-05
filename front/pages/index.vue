<template>
  <div>
    <b-aspect aspect="21:9">
      <div class="h-100 home-form">
        <b-container fluid>
          <b-row align-h="start">
            <b-col cols="12" md="8" class="title">
              <div class="title2">
                <h6>MUNDIAL GRIFOS</h6>
                <h2>CALIDAD</h2>
                <h3>EN CADA PIEZA</h3>
              </div>
            </b-col>
          </b-row>
        </b-container>
        <b-button variant="primary" squared class="mt-4">VER MÁS</b-button>
      </div>
    </b-aspect>
    <div class="new-products pt-4 mb-3">
      <h2
        class="text-secondary text-4xl text-weight-md text-center text-italic"
      >
        Nuevos Productos
      </h2>
      <hr />
      <b-container fluid class="cont">
        <b-row class="justify-content-center fila">
          <product
            v-for="product in products.data"
            :key="product.id"
            :data="product"
          />
        </b-row>
      </b-container>
    </div>
    <b-aspect aspect="4" class="steps-shop">
      <b-container fluid>
        <b-row align-h="start" align-v="start">
          <b-col cols="12" md="7">
            <div class="title">
              <h2>Más de 15 años</h2>
              <p>Ofreciendo lo mejor</p>
            </div>
          </b-col>
        </b-row>
      </b-container>
    </b-aspect>
    <div class="categories pt-4 pb-4">
      <h2
        class="text-secondary text-4xl text-weight-md text-center text-italic"
      >
        Categorías
      </h2>
      <hr />
      <b-container fluid class="cont">
        <b-row align-h="center">
          <category
            v-for="category in categories"
            :key="category.id"
            :data="category"
          />
        </b-row>
      </b-container>
    </div>
    <step-info />
  </div>
</template>

<script>
import gql from 'graphql-tag'
import product from '@/components/Card/Product'
import StepInfo from '@/components/Steps/Info'
import category from '../components/Card/Category.vue'

export default {
  components: {
    category,
    StepInfo,
    product,
  },
  data() {
    return {
      categories: [],
      products: [],
    }
  },
  apollo: {
    products: {
      query: gql`
        query {
          products(first: 4, orderBy: [{ column: CREATED_AT, order: DESC }]) {
            data {
              id
              name
              price
              discount
              images {
                url
              }
              category {
                name
              }
              brand {
                name
              }
              model {
                name
              }
            }
            paginatorInfo {
              currentPage
              lastPage
            }
          }
          categories {
            id
            name
            image {
              url
            }
          }
        }
      `,
      result(data) {
        this.categories = data.data.categories
      },
    },
  },
}
</script>
