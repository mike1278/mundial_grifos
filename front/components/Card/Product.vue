<template>
  <nuxt-link
    :to="'/productos/' + data.id"
    class="w-17 card product shadow p-1 m-2"
  >
    <b-aspect aspect="1">
      <img
        :src="imageUrl('square-medium') + data.images[0].url"
        :alt="data.name"
        class="w-100 h-100"
      />
    </b-aspect>
    <h3 class="text-xl text-secondary text-center px-1">
      {{ data.name }}
    </h3>
  </nuxt-link>
</template>
<script>
export default {
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
}
</script>
