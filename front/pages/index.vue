<template>
  <div>
    <principal-banner/>
  </div>
</template>

<script>
//import gql from 'graphql-tag'
import category from '@/components/Card/Category'
import PrincipalBanner from '@/components/PrincipalBanner'

export default {
  components: {
    category,
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
