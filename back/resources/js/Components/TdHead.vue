<template>
    <td class="text-gray-800 px-4 py-3" :class="textAlign">
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
