<template>
  <div>
    <principal-banner/>
    <new-products/>
  </div>
</template>

<script>
//import gql from 'graphql-tag'
import category from '@/components/Card/Category'
import PrincipalBanner from '@/components/PrincipalBanner'
import NewProducts from '@/components/NewProducts'

export default {
  components: {
    category,
    "principal-banner": PrincipalBanner,
    "new-products": NewProducts
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
