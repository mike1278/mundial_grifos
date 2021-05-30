<template>
<div>
  <h2>Soy el home</h2>
</div>
</template>

<script>
//import gql from 'graphql-tag'
import category from '@/components/Card/Category'

export default {
  components: {
    category,
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
