import { h } from 'vue'
export default {
    render(){
        return h(
            'p',
            {
                class: 'text-red-600',
            },
            this.$slots.default()
        );
    }
}
