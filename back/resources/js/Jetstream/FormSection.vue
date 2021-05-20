<template>
    <div>
        <h2 class="text-xl text-gray-700">
            <slot name="title">{{ title }}</slot>
        </h2>
        <form @submit.prevent="$emit('submitted')" class="border-top border-gray-400 border-solid">
            <div class="px-2 py-3 bg-white">
                <slot name="form"></slot>
            </div>
            <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6" v-if="hasActions">
                <slot name="actions"></slot>
            </div>
        </form>
    </div>
</template>

<script>
    import JetSectionTitle from './SectionTitle'

    export default {
        emits: ['submitted'],

        components: {
            JetSectionTitle,
        },
        props: {
            title: String,
        },
        computed: {
            hasActions() {
                return !! this.$slots.actions
            }
        }
    }
</script>
