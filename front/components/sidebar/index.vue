<template>
  <div class="box-sidebar" :class="{ 'is-collapse': !show }">
    <ul
      v-outside-click="toggleOutsideClick"
      class="d-flex flex-column shadow sidebar p-0 mb-0"
      :class="{ collapsed: !show }"
    >
      <li class="nav-item">
        <div class="text-center text-white logo mx-4 pt-3">
          <font-awesome-icon
            icon="times"
            class="text-white text-decoration-none float-right pointer"
            @click.stop="toggle()"
          />
        </div>
      </li>
      <slot></slot>
    </ul>
  </div>
</template>
<script>
import outsideClick from '@/directives/outsideClick'

export default {
  directives: {
    outsideClick,
  },
  data() {
    return {
      show: true,
    }
  },
  watch: {
    $route() {
      this.toggleOutsideClick()
    },
  },
  mounted() {
    // eslint-disable-next-line nuxt/no-env-in-hooks
    if (process.client) {
      window.addEventListener('resize', this.resize)
      this.resize()
      this.$root.$on('toggleSidebar', this.toggle)
    }
  },
  destroyed() {
    window.removeEventListener('resize', this.resize)
  },
  methods: {
    toggle(xl = true) {
      if (!xl && window.outerWidth > 992) {
        return
      }
      this.show = !this.show
    },
    toggleOutsideClick() {
      if (this.show && !(window.outerWidth > 992)) {
        this.show = false
      }
    },
    resize() {
      if (window.outerWidth < 992 && this.show) {
        this.show = false
      } else if (window.outerWidth > 992 && !this.show) {
        this.show = true
      }
    },
  },
}
</script>
<style lang="scss">
//@import '~/assets/css/components/sidebar.scss';
</style>
