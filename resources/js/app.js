require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Swal from 'sweetalert2';
import TextareaAutosize from 'vue-textarea-autosize';
import * as FilePond from 'filepond';
import moment from 'moment';



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin, Swal, bootstrap, moment}) {
        return createApp({ render: () => h(app, props) })
            .use(plugin, Swal, bootstrap, TextareaAutosize, moment, {
                useGlobalProperties: true
            })
            .mixin({ methods: { route } })
            .mount(el);
    },
});
    
InertiaProgress.init({ color: '#4B5563' });
