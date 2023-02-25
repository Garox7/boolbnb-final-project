window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App';
import VueRouter from 'vue-router';
import PageHome from './pages/PageHome';
import PageProperty from './pages/PageProperty';
// Auth
import PageLogin from './pages/Auth/PageLogin';
import PageRegister from './pages/Auth/PageRegister';
import DashboardPage from './pages/Admin/DashboardPage';
import PropertyPageIndex from './pages/Admin/PropertyPageIndex';

import CreatePropertyPage from './pages/CreatePropertyPage';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: PageHome,
    },
    {
        path: '/property/:slug', // TODO: da rivedere il percorso aggiungendo lo slug
        name: 'propertyShow',
        component: PageProperty,
        props: true
    },
    // Auth
    {
        path: '/login',
        name: 'pageLogin',
        component: PageLogin,
    },
    {
        path: '/register',
        name: 'pageRegister',
        component: PageRegister,
    },
    // CRUD protette
    {
        path: '/admin',
        name: 'admin',
        component: DashboardPage,
        meta: { requiresAuth: true },
        children : [
            {
                path: 'property',
                name: 'propertyIndex',
                component: PropertyPageIndex,
                children : [
                    {
                        path: 'create',
                        name: 'createPropertyPage',
                        component: CreatePropertyPage,
                    },
                    // {
                    //     Update
                    // }
                ]
            }
        ]
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
})


export const auth = {
    loggedIn() {
        const token = localStorage.getItem('access_token');
        return !!token; // restituisce true se il token esiste
    }
};

// Controllo autenticazione per l'accesso alle rotte protette
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.

        if (!auth.loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
            } else {
                next()
            }

    } else {
        next() // make sure to always call next()!
    }
})

export default router

new Vue({
    el: '#app',
    render: h => h(App),
    router
})
