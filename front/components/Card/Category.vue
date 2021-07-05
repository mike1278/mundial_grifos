<template>
  <nuxt-link
    class="w-18 card category p-1 m-2 position-relative d-flex align-items-center justify-content-center"
    :to="'/productos?category=' + data.id"
  >
    <b-aspect aspect="1">
      <img
        :src="imageUrl('square-large') + data.image.url"
        :alt="data.name"
        class="w-100 h-100"
      />
    </b-aspect>
    <div class="name position-absolute w-100">
      <h2 class="text-white text-center text-2xl py-3 mb-0">
        {{ data.name }}
      </h2>
    </div>
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
