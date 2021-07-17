<template>
    <td class="text-gray-700 px-4 py-2" :class="textAlign">
        <slot />
    </td>
</template>
<script>
export default{
    props: {
        textAlign: {
            type: String,
            default: 'text-center',
        },
    }
}
</script>
