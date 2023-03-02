window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App';
import VueRouter from 'vue-router';
import PageHome from './pages/PageHome';
import PageProperty from './pages/PageProperty';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: PageHome,
    },
    {
        path: '/properties/:slug',
        name: 'pageProperty',
        component: PageProperty,
        props: true,
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})

new Vue({
    el: '#app',
    render: h => h(App),
    router
})
