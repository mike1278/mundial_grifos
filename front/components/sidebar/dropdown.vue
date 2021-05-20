<template>
    <li class="nav-item dropdown">
        <a class="dropdown-toggle nav-link text-left text-white position-relative" @click.stop="open = !open">
            <font-awesome-icon :icon="iconPrev" class="mx-3"/>
            <span class="text-nowrap">{{ data.text }}</span>
            <font-awesome-icon icon="caret-down" class="mx-3 postIcon position-absolute" :class="open?'open':''"/>
        </a>
        <div v-show="open" class="dropdown-menu border-0 products">
            <nuxt-link
                v-for="(link, i) in data.links"
                :key="i" class="dropdown-item text-white py-2"
                :to="link.url"
            >
                <span>{{ link.name }}</span>
            </nuxt-link>
        </div>
    </li>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true,
        }
    },
    computed: {
        iconPrev() {
            return this.data.icon ? this.data.icon : 'sliders-h';
        }
    },
    data() {
        return {
            open: false,
        }
    },
}
</script>