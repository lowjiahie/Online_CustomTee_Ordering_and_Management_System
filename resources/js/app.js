
require('./bootstrap');
import router from './routes';
import VueRouter from 'vue-router';
import Index from './index.vue';
import Vue from 'vue';
import markRaw from 'vue';
import { createPinia, PiniaVuePlugin } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

Vue.use(VueRouter)
Vue.use(PiniaVuePlugin)
const pinia = createPinia()

// pinia.use(({ store }) => {
//     store.$router = new markRaw(router)
// });
pinia.use(piniaPluginPersistedstate)


const app = new Vue({
    el: '#app',
    router,
    pinia,
    //telling vue that we have this index component
    //local registration
    components: {
        "index": Index
    },
});


