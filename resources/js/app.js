import '../css/app.css';
import 'vue3-toastify/dist/index.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { createPinia } from 'pinia'
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import Vue3Toastify from 'vue3-toastify';
import { mask } from 'vue-the-mask';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.directive('mask', mask);

        return app.use(plugin)
           .use(Vue3Toastify, { autoClose: 3000 })
           .use(ZiggyVue)
           .use(pinia)
           .mount(el);
    },
    progress: {
        color: '#F34444',
    },
});
