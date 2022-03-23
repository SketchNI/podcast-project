require('./bootstrap');

import { createApp, h } from 'vue';
import AppLayout from "./Layouts/AppLayout";
import AdminLayout from "@/Layouts/AdminLayout";
import { createInertiaApp, Link as XLink, Head as XHead } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Portal from 'vue3-portal';
import mitt from 'mitt';

window.mitt = mitt();
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = require(`./Pages/${name}`).default
        if(name.startsWith('Error')) {
            return page;
        }
        if(name.startsWith('Admin')) {
            page.layout = page.layout || AdminLayout;
        }
        page.layout = page.layout || AppLayout;
        return page;
    },

    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Portal)
            .component('x-link', XLink)
            .component('x-head', XHead)
            .mixin({ methods: { route: window.route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#3399ff' });
