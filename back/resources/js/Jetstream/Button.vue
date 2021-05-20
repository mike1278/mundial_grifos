<template>
    <button :type="type" class="inline-flex items-center px-2 py-2 border disabled:opacity-50 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 bg-gray-800 active:bg-gray-900 focus:border-gray-900 focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'submit',
        },
    },
}
</script>
