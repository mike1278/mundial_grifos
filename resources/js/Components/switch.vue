<template>
    <div>
        <div :class="modelValue ? 'bg-blue-700' : 'bg-gray-300'"
             class="w-14 h-7 flex items-center rounded-full mx-3 px-1 transition-all" @click="handleToggleActive">
            <div class="bg-white w-5 h-5 rounded-full shadow-md transform transition-all" :class="{ 'translate-x-7': modelValue}"></div>
        </div>
    </div>
</template>
<script>
export default{
    props:['modelValue'],
    methods:{
        handleToggleActive(){
            this.$emit('update:modelValue',!this.modelValue)
        },
    },
}
</script>
