<template>
    <li class="p-2 border-l-4 border-solid" :class="active ? 'border-green-blue' : 'border-transparent'">
        <inertia-link :class="active ? 'text-green-blue' : 'text-white'" :href="route(to)">
            <i :class="prefixIcon+icon" class="mx-3"/>
            <span>{{ text }}</span>
        </inertia-link>
    </li>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
export default {
    props: {
        icon: {
            type: String,
            required: true,
        },
        prefixIcon: {
            type: String,
            default: 'fas fa-',
        },
        text: {
            type: String,
            required: true,
        },
        to: {
            type: String,
            required: true,
        },
    },
    mounted() {
        Inertia.on('finish', () => {
            this.active = this.route().current(this.to);
        })
        this.active = this.route().current(this.to);
    },
    data() {
        return {
            active: false,
        }
    },
}
</script>
