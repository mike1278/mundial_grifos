<template>
  <div class="mt-3">
    <b-container fluid>
      <b-row class="justify-content-center">
        <category
          v-for="(category, i) in categories.data"
          :key="i + 'category'"
          :data="category"
        />
      </b-row>
    </b-container>
  </div>
</template>
<script>
import gql from 'graphql-tag'
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
}
</script>
