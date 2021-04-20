<template>
    <input class="border-gray-500 w-full hover:border-indigo-600 placeholder-gray-400 focus:border-indigo-600 outline-none border-b-2 p-2 shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
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

