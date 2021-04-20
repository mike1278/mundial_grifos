import { h } from 'vue';
export default {
    render(){
        return h('td',{
            class: 'text-center text-gray-700 py-2'
        },this.$slots.default());
    }
}
