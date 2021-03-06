// app.js

import IndexProjectComponent from "./components/IndexProductComponent.vue";

require('./bootstrap');

window.Vue = require('vue');
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import IndexComponent from './components/IndexComponent.vue';
import EditComponent from './components/EditComponent.vue';
import IndexProductComponent from "./components/IndexProductComponent";
import CreateProductComponent from "./components/CreateProductComponent";
import EditProductComponent from "./components/EditProductComponent";

const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
    {
        name: 'create',
        path: '/create',
        component: CreateComponent
    },
    {
        name: 'posts',
        path: '/posts',
        component: IndexComponent
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditComponent
    },
    {
        name: 'product',
        path: '/product',
        component: IndexProductComponent
    },
    {
        name: 'create-product',
        path: '/create-product',
        component: CreateProductComponent
    },
    {
        name: 'edit-product',
        path: '/edit-product/:id',
        component: EditProductComponent
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
