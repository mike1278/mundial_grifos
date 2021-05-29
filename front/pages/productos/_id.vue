<template>
  <div>
    <b-container>
      <b-row>
        <b-col cols="12" md="6">
          <swiper :options="swiperOptions">
            <swiper-slide v-for="(images, i) in product.images" :key="i">
              <img
                :src="imageUrl('square-large') + images.url"
                :alt="product.name"
              />
            </swiper-slide>
          </swiper>
        </b-col>
        <b-col cols="12" md="6">
          <h2 class="">{{ product.name }}</h2>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import gql from 'graphql-tag'

export default {
  data() {
    return {
      swiperOptions: {},
      product: {},
    }
  },
  apollo: {
    product: gql`
      query {
        product {
          id
          name
          images {
            url
          }
        }
      }
    `,
  },
}
</script>
