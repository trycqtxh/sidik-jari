import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Absensi from './view/absensi/index.vue';
import VueSocketio from 'vue-socket.io';
require('./bootstrap');

Vue.use(VueRouter);
Vue.use(VueSocketio, 'http://localhost:5656');

const router = new VueRouter({
    routes: [
        {path: '/', component: Absensi, name: 'absensi'},
    ]
})
const app = new Vue({
    el: '#home',
    components : { App },
    template : '<app></app>',
    router
})