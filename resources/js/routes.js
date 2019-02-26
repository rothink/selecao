import Vue from 'vue'
import VueRouter from 'vue-router'

import Pessoa from '@/js/components/Pessoa';

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Pessoa
        }
    ]
})

export default router;
