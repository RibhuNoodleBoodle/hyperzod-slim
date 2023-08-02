import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginComponent from './components/LoginComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import ProductListComponent from './components/ProductListComponent.vue';
import ProductDetailComponent from './components/ProductDetailComponent.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterComponent
    },
    {
        path: '/',
        name: 'home',
        component: ProductListComponent
    },
    {
        path: '/product/:id',
        name: 'productDetail',
        component: ProductDetailComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
