<template>
  <div :id="id">
    <label :for="id + 'input'" class="p-1 pointer" :class="classes">
      <slot></slot>
    </label>
    <input
      :id="id + 'input'"
      v-model="select"
      :value="data"
      type="radio"
      class="d-none"
    />
  </div>
</template>
<script>
export default {
  props: {
    id: {
      type: String,
      required: true,
    },
    data: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
  },
  computed: {
    select: {
      get() {
        return this.value
      },
      set(val) {
        this.$emit('input', val)
      },
    },
    classes() {
      return this.value === this.data
        ? 'border border-primary rounded-circle'
        : ''
    },
  },
}
</script>
