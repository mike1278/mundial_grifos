import { h } from 'vue'
export default {
    props: ['append','prepend'],
    render(){
        let basicClass = 'border-gray-400 border-b-2 pb-1 px-1 text-gray-500'
        let append = null
        let prepend = null
        if(this.append){
            append = h(
                'span',
                {
                    class: basicClass,
                },
                this.append
            );
        }
        if(this.prepend){
            prepend = h(
                'span',
                {
                    class: basicClass,
                },
                this.prepend
            );
        }
        return h(
            'div',
            {
                class: 'flex',
            },
            [
                append,
                this.$slots.default(),
                prepend,
            ]
        );
    }
}
