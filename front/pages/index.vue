<template>
  <b-container>{{ users }}</b-container>
</template>

<script>
import gql from 'graphql-tag'

export default {
  apollo: {
    users: gql`
      query {
        users(first: 10) {
          data {
            id
            name
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
