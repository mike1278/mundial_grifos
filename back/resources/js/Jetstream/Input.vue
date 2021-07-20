<template>
    <input
        class="border-gray-400 border-r-0 border-l-0 border-t-0 w-full hover:border-green-blue placeholder-gray-400 focus:border-green-blue outline-none border-b-2 px-1 pb-1 shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
</template>

<script>
    export default {
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

