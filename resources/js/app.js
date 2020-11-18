require('./bootstrap');

import Vue from 'vue';
import store from './store'

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import wysiwyg from "vue-wysiwyg";
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import VueHtmlToPaper from 'vue-html-to-paper';


Vue.use(VueHtmlToPaper, {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css',
    ]
});

Vue.use(VueLodash, { lodash: lodash })

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.use(wysiwyg, {
    hideModules: { "image": true }
});


const app = document.getElementById('app');

new Vue({
    store,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
