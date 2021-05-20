<template>
  <li class="nav-item">
    <nuxt-link class="nav-link active text-left" :to="to">
      <font-awesome-icon :icon="icon" class="text-decoration-none mx-3" />
      <span class="text-nowrap">
        <slot></slot>
      </span>
    </nuxt-link>
  </li>
</template>
<script>
export default {
  props: {
    icon: {
      type: String,
      required: true,
    },
    to: {
      type: String,
      required: true,
    },
  },
}
</script>
