<template>
  <div>
    <principal-banner/>
    <new-products/>
    <category/>
  </div>
</template>

<script>
//import gql from 'graphql-tag'
import category from '@/components/Category'
import NewProducts from '@/components/NewProducts'
import PrincipalBanner from '@/components/PrincipalBanner'
import Category from '../components/Card/Category.vue'

export default {
  components: {
    category,
    "new-products": NewProducts,
    "principal-banner": PrincipalBanner
  },
  data() {
    return {
      categories: [],
    }
  },
  /*
  apollo: {
    categories: gql`
      query {
        categories(first: 10) {
          data {
            id
            name
            image {
              url
            }
          }
          paginatorInfo {
            currentPage
            lastPage
          }
        }
      }
    `,
  },
  */
}
</script>
