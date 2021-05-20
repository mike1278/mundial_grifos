<template>
    <form class="dropzone" ref="drop"></form>
</template>
<script>
import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
export default {
    props: {
        options: {
            type: Object,
            required: true,
        },
    },
    data(){
        return {
            dropzone: null,
        }
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.drop, this.options);
        this.dropzone.on("success", this.newFile);
    },
    methods: {
        newFile(file){
            this.$emit('newFile',JSON.parse(file.xhr.response));
        }
    },
}
</script>
<style>
@import "dropzone/dist/dropzone.css";
</style>
