<template>
  <div>
    <nav-bar></nav-bar>
    <Nuxt />
    <Footer/>
  </div>
</template>
<script>
import navBar from '@/components/NavBar'
import Footer from '@/components/Footer'

export default {
  components: {
    navBar,
    Footer
  },
}
</script>
