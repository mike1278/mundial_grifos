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
    <div class="info px-2 mt-2">
      <p class="pt-2 category mb-3">
        {{ data.category.name }} / {{ data.model.name }}
      </p>
      <p class="title mb-3 text-weight-lg">{{ data.name }}</p>
      <p class="price text-2xl mb-4">$ {{ data.price }}</p>
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
