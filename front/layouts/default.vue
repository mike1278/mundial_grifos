<template>
  <div>
    <nav-bar></nav-bar>
    <Nuxt />
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
import navBar from '~/components/NavBar'

export default Vue.extend({
  components: {
    navBar,
  },
})
</script>
