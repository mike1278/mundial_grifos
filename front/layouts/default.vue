<template>
  <div>
    <nav-bar></nav-bar>
    <Nuxt />
  </div>
</template>
<script>
import navBar from '@/components/NavBar'

export default {
  components: {
    navBar,
  },
}
</script>
