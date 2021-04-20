<template>
    <select @change="change" class="border-0 border-gray-500 w-full hover:border-indigo-600 text-gray-700 focus:border-indigo-600 outline-none border-b-2 p-2 shadow-sm">
        <option :disabled="firstOptionDisable" :value="null" selected="selected" class="text-gray-400">{{ placeholder }}</option>
        <option v-for="category in items" :key="category.id" :value="category.id" class="text-gray-700">{{ category.name }}</option>
    </select>
</template>
<script>
export default {
    props: {
        items: Array,
        modelValue: {
            default: null,
        },
        placeholder: String,
        firstOptionDisable: {
            type: Boolean,
            default: true,
        },
    },
    methods: {
        change(event){
            this.$emit('update:modelValue',event.target.value);
        },
    }
}
</script>
