<template>
    <div
        class="absolute md:sticky top-0 w-72 max-h-screen h-screen bg-gray-800 z-10"
        :class="show ? '': '-ml-72'"
    >
        <ul class="overflow-y-auto z-20 border-r border-gray-300 border-solid min-h-screen relative">
            <li class="p-2 flex justify-end">
                <span class="text-white cursor-pointer text-2xl" @click="toggle()">
                    <i class="fas fa-times mx-3"/>
                </span>
            </li>
            <slot></slot>
        </ul>
    </div>
</template>
<script>
import dropdown from "@/Components/sidebar/dropdown"
import navItem from "@/Components/sidebar/NavItem";
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        "nav-item": navItem,
        dropdown: dropdown,
    },
    data() {
        return {
            show: true,
        }
    },
    mounted() {
        window.addEventListener("resize", this.resize)
        this.resize()
        Inertia.on('start', () => {
            this.toggleOutsideClick();
        })
    },
    unmounted() {
        window.removeEventListener("resize", this.resize)
    },
    methods: {
        toggle(xl = true) {
            if (!xl && window.outerWidth > 992) {
                return
            }
            this.show = !this.show
        },
        toggleOutsideClick(){
            if(this.show && !(window.outerWidth > 992)){
                this.show = false;
            }
        },
        resize() {
            if (window.outerWidth < 992 && this.show) {
                this.show = false
            } else if (window.outerWidth > 992 && !this.show) {
                this.show = true
            }
        },
    },
}
</script>
