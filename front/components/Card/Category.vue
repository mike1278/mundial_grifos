<template>
  <nuxt-link
    class="w-18 card category p-1 shadow m-2"
    :to="'/productos?category=' + data.id"
  >
    <b-aspect aspect="1">
      <img
        :src="imageUrl('square-medium') + data.image.url"
        :alt="data.name"
        class="w-100 h-100"
      />
    </b-aspect>
    <h3 class="text-secondary text-center mt-2 text-2xl px-1">
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
