<template>
  <div class="rounded">
    <button class="bg-transparent border-0 mr-2">
      <font-awesome-icon
        icon="minus"
        class="text-gray-700"
        @click="updateInput(-1)"
      />
    </button>
    <input
      v-model.lazy="number"
      type="text"
      class="border-0 text-gray-700"
      style="width: 30px"
    />
    <button class="bg-transparent border-0 ml-2">
      <font-awesome-icon
        icon="plus"
        class="text-gray-700"
        @click="updateInput(1)"
      />
    </button>
  </div>
</template>
<script>
export default {
  props: {
    value: {
      type: Number,
      default: 1,
    },
    min: {
      // eslint-disable-next-line vue/require-prop-type-constructor
      type: Number | String,
      default: '',
    },
    max: {
      // eslint-disable-next-line vue/require-prop-type-constructor
      type: Number | String,
      default: '',
    },
  },
  computed: {
    number: {
      get() {
        return this.value
      },
      set(val) {
        if (parseInt(val) > parseInt(this.max)) {
          return this.$emit('input', this.max)
        }
        if (parseInt(val) < parseInt(this.min)) {
          return this.$emit('input', this.min)
        }
        if (!val) {
          return this.$emit('input', this.min)
        }
        this.$emit('input', val)
      },
    },
  },
  methods: {
    updateInput(val) {
      if (
        this.min !== '' &&
        parseInt(parseInt(this.value) + val) < parseInt(this.min)
      ) {
        return
      }
      if (
        this.max !== '' &&
        parseInt(parseInt(this.value) + val) > parseInt(this.max)
      ) {
        return
      }
      this.$emit('input', parseInt(this.value) + val)
    },
  },
}
</script>
