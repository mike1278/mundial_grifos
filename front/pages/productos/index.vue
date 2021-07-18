<template>
  <div>
    <b-container fluid="" class="my-5">
      <b-row>
        <b-col cols="12" lg="3" xl="2">
          <div>
            <h2>Categorías</h2>
            <ul class="list-unstyled">
              <li class="pointer" @click="updateCategory(null)">Todas</li>
              <li
                v-for="category in categories"
                :key="category.id + 'category'"
                class="pointer"
                @click="updateCategory(category.id)"
              >
                {{ category.name }}
              </li>
            </ul>
          </div>
        </b-col>
        <b-col>
          <b-row v-if="!$apollo.loading" class="justify-content-center">
            <product
              v-for="(product, i) in products.data"
              :key="i + 'product'"
              :data="product"
            />
            <b-col cols="12">
              <b-pagination
                v-model="currentPage"
                class="mt-3"
                align="center"
                :total-rows="products.paginatorInfo.total"
                :per-page="products.paginatorInfo.perPage"
                aria-controls="my-table"
              />
            </b-col>
          </b-row>
          <b-row v-else class="mb-2">
            <b-col
              v-for="i in 10"
              :key="i"
              cols="12"
              sm="6"
              md="4"
              lg="3"
              xl="2"
              class="px-3 py-2"
            >
              <b-skeleton-img width="100%" />
              <b-skeleton animation="wave" width="100%" />
              <b-skeleton animation="wave" width="100%" />
              <b-skeleton animation="wave" width="100%" />
            </b-col>
          </b-row>
        </b-col>
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
  data() {
    return {
      products: {},
      categories: {},
      models: {},
      brands: {},
      currentPage: 1,
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
      async handler(val) {
        await this.$router.push({
          path: '/productos',
          query: val,
        })
        this.$apollo.queries.allCategories.refresh()
      },
    },
    currentPage() {
      window.scrollTo({ top: 0, behavior: 'smooth' })
    },
  },
  methods: {
    updateCategory(id) {
      this.filters.category = id
    },
  },
  apollo: {
    categories: {
      variables() {
        return {
          page: this.currentPage,
        }
      },
      query() {
        const wheres = filters(
          ['category', 'model', 'brand'],
          this.$route.query
        )
        return gql`
          query products($page: Int!) {
            products (
              first: 8,
              page: $page,
              orderBy: [{ column: CREATED_AT, order: DESC }],
              ${wheres}
            ) {
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
                count
                perPage
                total
              }
            }
            categories {
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
        `
      },
      result(data) {
        this.models = data.data.allModels
        this.products = data.data.products
        this.brands = data.data.allBrands
      },
    },
  },
}
</script>
