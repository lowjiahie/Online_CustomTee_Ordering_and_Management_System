
require('./bootstrap');
import router from './routes';
import VueRouter from 'vue-router';
import Index from './index.vue';
import Vue from 'vue';
import { createPinia, PiniaVuePlugin } from 'pinia'
Vue.use(VueRouter)
Vue.use(PiniaVuePlugin)
const pinia = createPinia()

const app = new Vue({
    el: '#app',
    router,
    pinia,
    //telling vue that we have this index component
    //local registration
    components:{
        "index":Index
    },
});

