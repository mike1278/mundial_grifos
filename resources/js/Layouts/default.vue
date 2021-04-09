<template>
    <div class="position-relative">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block z-10">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700">
                    Log in
                </inertia-link>

                <inertia-link :href="route('register')" class="ml-4 text-sm text-gray-700">
                    Register
                </inertia-link>
            </template>
        </div>
        <slot></slot>
    </div>
</template>
<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
export default {
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
}
</script>
