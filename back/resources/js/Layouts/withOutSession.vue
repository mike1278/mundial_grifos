<template>
    <div class="fixed top-0 left-0 w-full px-6 py-4 flex z-10 justify-between">
        <h1 class="text-gray-600 text-lg">{{ $page.props.appName }}</h1>
        <inertia-link :href="route('login')" class="text-gray-600">Iniciar Sesión</inertia-link>
    </div>
    <slot></slot>
</template>
