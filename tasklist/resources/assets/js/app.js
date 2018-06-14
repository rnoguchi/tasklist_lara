
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

window.Vue = Vue
window.Vue.use(VueRouter)
Vue.prototype.$http = axios

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/tasks', component: require('./components/Tasks/Index.vue') },
        { path: '/tasks/create', component: require('./components/Tasks/Create.vue') }
    ]
});

const app = new Vue({
    router,
    el: '#app'
});
