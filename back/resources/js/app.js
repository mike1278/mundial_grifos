require('./bootstrap');
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from '@/Layouts/default'
import buttonLink from '@/Components/Button'

const el = document.getElementById('app');

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => import(`./Pages/${name}`)
            .then(({ default: page }) => {
                if (page.layout === undefined) {
                    page.layout = Layout
                }
                return page
            }),
            resolveErrors: page => (page.props.errors || {}),
        })
});
app.component('button-link',buttonLink)
app.mixin({
    methods: {
        route,
        imageUrl(size='square-medium'){
            return '/image/'+size+'/'
        },
        hasRole(role) {
            let has = this.$page.props.roles.data.filter((el)=>{
                return el === role
            })[0]
            return !!has
        },
        hasPermission(permission) {
            let has = this.$page.props.permissions.data.filter((el)=>{
                return el === permission
            })[0]
            return !!has
        },
    },
})
.use(InertiaPlugin)
.mount(el);

InertiaProgress.init({ color: '#4B5563' });
