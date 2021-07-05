<template>
  <div class="mb-3 mt-4">
    <b-container>
      <b-row>
        <b-col cols="12" md="5">
          <swiper :options="swiperOptions">
            <swiper-slide
              v-for="(image, i) in product.images"
              :key="i + 'image'"
            >
              <img
                :src="imageUrl('square-large') + image.url"
                :alt="product.name"
                class="w-100 h-100"
              />
            </swiper-slide>
          </swiper>
        </b-col>
        <b-col cols="12" md="7">
          <h2 class="text-gray-700 text-weight-lg text-3xl">
            {{ product.name }}
          </h2>
          <p>{{ product.description }}</p>
          <hr class="border-gray-400 border-t-2" />
          <p class="mt-2 mb-0">
            <span class="text-gray-700 text-weight-lg"
              >Código del producto:</span
            >
            {{ product.serial_code }}
          </p>
          <p class="mb-0">
            <span class="text-gray-700 text-weight-lg">Marca:</span>
            {{ product.brand.name }}
          </p>
          <p class="mb-0">
            <span class="text-gray-700 text-weight-lg">Precio:</span>
            {{ product.price }}$
          </p>
          <div>
            <p class="text-gray-700 text-weight-lg">Colores</p>
            <swiper :options="swiperColorOptions">
              <swiper-slide
                v-for="(color, i) in product.colors"
                :key="i + 'color'"
                class="mr-3"
                style="width: 40px"
              >
                <img
                  :src="imageUrl('square-medium') + color.image.url"
                  :alt="product.name"
                  class="h-100 w-100"
                />
              </swiper-slide>
            </swiper>
          </div>
          <hr class="border-gray-400 border-t-2" />
          <p class="mb-0">
            <span class="text-gray-700 text-weight-lg">Cantidad:</span>
            <client-only>
              <input-step v-model="quantity" :min="1" :max="product.quantity" />
            </client-only>
          </p>
          <hr class="border-gray-400 border-t-2" />
          <b-button variant="primary" squared @click="addToCart">
            Agregar al carrito
          </b-button>
        </b-col>
      </b-row>
      <h2 class="text-secondary mt-4">Productos Similares</h2>
      <swiper :options="swiperColorOptions" class="pb-5">
        <swiper-slide
          v-for="(similarProduct, i) in products.data"
          :key="i + 'color'"
          class="mr-3 w-17"
        >
          <product :data="similarProduct" />
        </swiper-slide>
        <div slot="pagination" class="swiper-pagination"></div>
      </swiper>
    </b-container>
  </div>
</template>
<script>
import gql from 'graphql-tag'
import inputStep from '@/components/form/step-input'
import product from '@/components/Card/Product'

export default {
  components: {
    inputStep,
    product,
  },
  data() {
    return {
      swiperOptions: {},
      swiperColorOptions: {
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
        },
        slidesPerView: 'auto',
      },
      product: {
        colors: [],
        images: [],
        category: {
          name: '',
        },
        brand: {
          name: '',
        },
        model: {
          name: '',
        },
      },
      products: {},
      quantity: 1,
    }
  },
  mounted() {
    this.$apollo
      .mutate({
        mutation: gql`
          mutation($id: ID!) {
            createView(
              input: {
                viewable_id: $id
                viewable_type: "App\\\\Models\\\\Product"
              }
            ) {
              id
            }
          }
        `,
        variables: {
          id: this.$route.params.id,
        },
      })
      .then(() => {})
      .catch(() => {})
  },
  apollo: {
    product: {
      prefetch: ({ route }) => ({ id: route.params.id }),
      variables() {
        return { id: this.$route.params.id }
      },
      query: gql`
        query product($id: ID!) {
          product(id: $id) {
            id
            name
            price
            discount
            description
            serial_code
            quantity
            colors {
              id
              name
              image {
                url
              }
            }
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
          products(first: 10, similar: $id) {
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
        }
      `,
      result(data) {
        this.products = data.data.products
      },
    },
  },
  methods: {
    addToCart() {},
  },
}
</script>
