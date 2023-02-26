window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App';
import VueRouter from 'vue-router';
import HomePage from './pages/HomePage';
import PropertyPage from './pages/PropertyPage';
import LoginPage from './pages/Auth/LoginPage';
import RegisterPage from './pages/Auth/RegisterPage';
import DashboardPage from './pages/Admin/DashboardPage';
import PropertiesIndex from './pages/Admin/PropertiesIndex';
import PropertyShow from './pages/Admin/PropertyShow';
import PropertyCreate from './pages/Admin/PropertyCreate';
import PropertyUpdate from './pages/Admin/PropertyUpdate';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },
    {
        path: '/property/:slug',
        name: 'propertyPage',
        component: PropertyPage,
        props: true
    },
    // Auth
    {
        path: '/login',
        name: 'loginPage',
        component: LoginPage
    },
    {
        path: '/register',
        name: 'registerPage',
        component: RegisterPage
    },
    // CRUD protette
    {
        path: '/admin',
        name: 'admin',
        component: DashboardPage,
        meta: { requiresAuth: true },
    },
    {
        path: '/admin/properties',
        name: 'propertiesIndex',
        component: PropertiesIndex,
        meta: { requiresAuth: true },

    },
    {
        path: '/admin/properties/:slug',
        name: 'propertyShow',
        component: PropertyShow,
        meta: { requiresAuth: true },
        props: true
    },
    {
        path: '/admin/properties/create',
        name: 'propertyCreate',
        component: PropertyCreate,
        meta: { requiresAuth: true },

    },
    {
        path: '/admin/properties/update/:slug',
        name: 'propertyUpdate',
        component: PropertyUpdate,
        meta: { requiresAuth: true },
        props: true
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})


export const auth = {
    loggedIn() {
        const token = localStorage.getItem('access_token');
        return !!token;
    }
};

// Controllo autenticazione per l'accesso alle rotte protette
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!auth.loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
            } else {
                next()
            }
    } else {
        next()
    }
})
export default router

new Vue({
    el: '#app',
    render: h => h(App),
    router
})
