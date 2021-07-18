<template>
  <nav v-if="paginator !== undefined" role="navigation">
    <div class="d-flex align-items-center justify-content-center">
      <div class="position-relative d-inline-flex shadow-sm rounded-md">
        <div v-for="(link, i) in paginator.links" :key="i">
          <nuxt-link
            v-if="!link.active && link.url !== null"
            :to="link.url"
            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
            v-html="link.label"
          ></nuxt-link>
          <span
            v-else
            aria-disabled="true"
            :class="
              link.active
                ? 'bg-secondary border border-secondary text-white'
                : ''
            "
            class="position-relative d-inline-flex align-items-center px-4 py-2 text-sm font-medium border cursor-default leading-5"
            v-html="link.label"
          ></span>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Paginator',
  props: {
    paginator: {
      currentPage: Number,
      data: Array,
      first_page_url: String,
      from: Number,
      lastPage: Number,
      last_page_url: String,
      links: Array,
      next_page_url: String,
      path: String,
      per_page: Number,
      prev_page_url: String,
      to: Number,
      total: Number,
    },
  },
  computed: {
    total() {
      return this.paginator.total
    },
  },
}
</script>
