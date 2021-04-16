<template>
    <li class="p-2 border-l-4 border-solid" v-if="show" :class="classes">
        <a class=" text-left text-white position-relative" @click.stop="open = !open">
            <i class="fas fa-sliders-h mx-3"/>
            <span class="text-nowrap">{{ text }}</span>
            <i class="fas fa-caret-down mx-3 position-absolute transform" :class="open ? 'rotate-180' : ''"/>
        </a>
        <div v-show="open" class="dropdown-menu border-0 products">
            <inertia-link
                v-for="(link, i) in links"
                :key="i" class="dropdown-item text-white py-2"
                :href="link.url"
            >
                <span>{{ link.name }}</span>
            </inertia-link>
        </div>
    </li>
</template>
<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    props: {
        text: {
            type: String,
            required: true,
        },
        links: {
            type: Array,
            required: true,
        },
        if: {
            type: Function,
            default: () => true,
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
            open: false,
        }
    },
    computed: {
        show() {
            return this.if();
        },
        classes() {
            return this.active ? 'border-blue-400' : ''
        },
    }
}
</script>
