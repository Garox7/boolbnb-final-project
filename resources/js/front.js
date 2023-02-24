window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App';
import VueRouter from 'vue-router';
import PageHome from './pages/PageHome';
import PageProperty from './pages/PageProperty';
import CreatePropertyPage from './pages/CreatePropertyPage';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'pageHome',
        component: PageHome,
    },
    {
        path: '/properties',
        name: 'PageProperty',
        component: PageProperty,
    },

    // CRUD
    {
        path: '/properties/property/create',
        name: 'CreatePropertyPage',
        component: CreatePropertyPage,
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
