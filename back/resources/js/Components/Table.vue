<template>
    <table class="w-full divide-y divide-gray-200 table-auto mb-4 overflow-x-auto">
        <thead class="bg-gray-100">
            <slot name="header"></slot>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <slot></slot>
        </tbody>
    </table>
</template>
