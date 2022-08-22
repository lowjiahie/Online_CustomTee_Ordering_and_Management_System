
require('./bootstrap');
import router from './routes';
import VueRouter from 'vue-router';
import Index from './index.vue';
import Vue from 'vue';
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router,
    //telling vue that we have this index component
    //local registration
    components:{
        "index":Index
    }
});

