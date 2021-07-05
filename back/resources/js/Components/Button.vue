<template>
    <inertia-link
        v-if="is === 'link'"
        :href="href"
        class="inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition"
        :class="classes"
    >
        <slot></slot>
    </inertia-link>
    <button
        v-else
        class="inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition"
        :class="classes"
    >
        <slot></slot>
    </button>
</template>
<script>
const variants = {
    default: 'hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 bg-gray-600 text-white',
    primary: 'hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 bg-blue-600 text-white',
    warning: 'hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 bg-yellow-600 text-white',
    danger: 'hover:bg-red-700 focus:bg-red-700 active:bg-red-900 bg-red-600 text-white',
    normal: 'hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 bg-gray-600 text-white',
    success: 'hover:bg-green-700 focus:bg-green-700 active:bg-green-900 bg-green-600 text-white',
}
export default {
    props: {
        variant: {
            type: String,
            default: 'default',
        },
        is: {
            type: String,
            default: 'button',
        },
        href: {
            type: String,
            default: '',
        },
    },
    computed: {
        classes(){
            return variants[this.variant]
        },
    },
}
</script>
