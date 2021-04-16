<template>
    <div class="flex">
        <c-sidebar ref="sidebar">
            <nav-item
                text="Inicio"
                to="dashboard"
                icon="home"
            ></nav-item>
            <nav-item
                text="Productos"
                to="products.index"
                icon="boxes"
            ></nav-item>
        </c-sidebar>
        <div class="min-h-screen bg-gray-100 flex-grow">
            <nav class="bg-white border-b border-gray-100">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <hamburger @click="toggleSidebar()" />
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"></div>
                        </div>

                        <div class="flex items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <jet-dropdown-link :href="route('profile.show')">
                                            Perfil
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>
                                        <div class="border-t border-gray-100"></div>
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Cerrar Sesión
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main>
                <div class="py-4">
                    <div class="mx-2 sm:px-2">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import sidebar from '@/Components/sidebar/index'
import navItem from '@/Components/sidebar/nav-item'
import hamburger from '@/Components/Hamburger'

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        hamburger,
        'nav-item': navItem,
        JetResponsiveNavLink,
        'c-sidebar':sidebar,
    },
    data() {
        return {
            changeRoute: false,
            showingNavigationDropdown: false,
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
        toggleSidebar(){
            this.$refs.sidebar.toggle();
        }
    }
}
</script>
