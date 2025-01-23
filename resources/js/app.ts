import './bootstrap';
import '../jquery/jquery.min.js' 
import './Utils/vendor.bundle.base';
import './Utils/dashboard';
import './Utils/chart';
import './Utils/todolist.js';
import './Utils/hoverable-collapse.js';
import './Utils/off-canvas.js';
import './Utils/misc.js';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@mdi/font/css/materialdesignicons.min.css';
import PrimeVue from 'primevue/config';  // Import de PrimeVue
import AutoComplete from 'primevue/autocomplete'; 

import Aura from '@primevue/themes/aura';// Import d'AutoComplete

     




import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist';
import { Theme } from '@primevue/themes';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue,{
                Theme:{
                    preset:Aura
                }
            })
            .component('AutoComplete', AutoComplete)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
