import { h } from 'vue';
export default {
    render(){
        return h('td',{
            class: 'text-center text-gray-800 px-6 py-3'
        },this.$slots.default());
    }
}
