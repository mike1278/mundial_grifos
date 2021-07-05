<template>
    <div class="fixed top-0 left-0 w-full px-6 py-4 flex z-10 justify-between">
        <h1 class="text-gray-600 bg-white bg-opacity-70 px-3 py-2 rounded text-lg">{{ $page.props.appName }}</h1>
    </div>
    <slot></slot>
</template>
