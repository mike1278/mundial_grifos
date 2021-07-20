<template>
  <div class="mb-3 mt-4">
    <b-container>
      <b-row>
        <b-col cols="12" md="5">
          <swiper ref="swiperTop" :options="swiperOptions">
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
          <swiper
            v-if="product.images.length > 1"
            ref="swiperThumbs"
            :options="swiperOptionsThumbs"
            @ready="setThumb"
          >
            <swiper-slide
              v-for="(image, i) in product.images"
              :key="i + 'imageThumb'"
              style="height: 50px; width: 50px"
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
            {{ price | numeral('0,0.00') }}{{ currency.symbol }}
          </p>
          <div>
            <p class="text-gray-700 text-weight-lg">Colores</p>
            <div class="d-flex justify-content-start">
              <div
                v-for="(color, i) in product.colors"
                :key="i + 'color'"
                class="mr-1"
                style="width: 40px"
              >
                <color
                  :id="color.id + 'color'"
                  v-model="color_id"
                  :data="color.id"
                >
                  <img
                    :src="imageUrl('square-medium') + color.image.url"
                    :alt="product.name"
                    class="h-100 w-100"
                  />
                </color>
                <b-popover
                  :target="color.id + 'color'"
                  triggers="hover focus"
                  placement="top"
                >
                  {{ color.name }}
                </b-popover>
              </div>
            </div>
          </div>
          <hr class="border-gray-400 border-t-2" />
          <p class="mb-0">
            <span class="text-gray-700 text-weight-lg">Cantidad:</span>
            <client-only>
              <input-step v-model="quantity" :min="1" :max="product.quantity" />
            </client-only>
          </p>
          <hr class="border-gray-400 border-t-2" />
          <b-overlay :show="loading" class="d-inline-block">
            <b-button
              v-if="!hasColor"
              variant="primary"
              squared
              @click="addToCart"
            >
              Agregar al carrito
            </b-button>
            <b-button
              v-else
              variant="primary"
              squared
              :disabled="hasColor.quantity === quantity"
              @click="updateProductCart"
            >
              Actualizar cantidad carrito
            </b-button>
          </b-overlay>
        </b-col>
      </b-row>
      <div v-if="products.data.length > 0">
        <h2 class="text-secondary mt-4">Productos Similares</h2>
        <swiper :options="swiperOtherOptions" class="pb-5">
          <swiper-slide
            v-for="(similarProduct, i) in products.data"
            :key="i + 'color'"
            class="mr-3 w-17"
          >
            <product :data="similarProduct" />
          </swiper-slide>
          <div slot="pagination" class="swiper-pagination"></div>
        </swiper>
      </div>
    </b-container>
  </div>
</template>
<script>
import gql from 'graphql-tag'
import inputStep from '@/components/form/step-input'
import color from '@/components/color'
import product from '@/components/Card/Product'
import { mapGetters } from 'vuex'

export default {
  components: {
    inputStep,
    product,
    color,
  },
  data() {
    return {
      swiperOptions: {
        thumbs: {
          swiper: null,
        },
        slidesPerView: 1,
      },
      swiperOtherOptions: {
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
        },
        slidesPerView: 'auto',
      },
      swiperOptionsThumbs: {
        touchRatio: 0.2,
        slideToClickedSlide: true,
        spaceBetween: 10,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
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
      loading: false,
      color_id: null,
      products: {
        data: [],
      },
      quantity: 1,
    }
  },
  computed: {
    ...mapGetters({
      currency: 'currency',
    }),
    price() {
      return this.product.price * this.currency.rate
    },
    hasProduct() {
      const cart = this.$store.getters['cart/cart']
      if (!cart) return []
      return cart.orderProducts.filter((el) => {
        return el.product.id === this.product.id
      })
    },
    hasColor() {
      if (this.hasProduct.length < 1) return false
      return this.hasProduct.find((el) => {
        return el.product_color_id === parseInt(this.color_id)
      })
    },
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
        this.color_id = data.data.product.colors[0].id
      },
    },
  },
  methods: {
    addToCart() {
      if (!this.$auth.loggedIn) {
        return this.$bvToast.toast(
          'Debe iniciar sesión para poder realizar ordenes',
          {
            title: 'Acción necesaria',
            variant: 'warning',
          }
        )
      }
      this.loading = true
      this.$store
        .dispatch('cart/setProduct', {
          id: this.product.id,
          quantity: this.quantity,
          color_id: this.color_id,
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
          this.loading = false
        })
    },
    updateProductCart() {
      this.loading = true
      this.$store
        .dispatch('cart/updateQuantity', {
          id: this.product.id,
          quantity: this.quantity,
          color_id: this.color_id,
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
          this.loading = false
        })
    },
    setThumb(swiper) {
      this.swiperOptions.thumbs.swiper = swiper
    },
  },
}
</script>
