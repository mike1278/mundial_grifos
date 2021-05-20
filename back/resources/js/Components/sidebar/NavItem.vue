<template>
    <li class="p-2 border-l-4 border-solid" :class="classes">
        <inertia-link class="text-gray-700" :href="route(to)">
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
    computed: {
        classes() {
            return this.active ? 'border-blue-400' : ''
        },
    }
}
</script>
