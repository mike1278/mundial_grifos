<template>
  <div>
    <sidebar>
      <nav-item></nav-item>
    </sidebar>
    <Nuxt />
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
import sidebar from '~/components/sidebar/index'
import navItem from '~/components/sidebar/navItem'
import dropDown from '~/components/sidebar/dropdown'

export default Vue.extend({
  components: {
    sidebar,
    navItem,
    dropDown,
  },
})
</script>
