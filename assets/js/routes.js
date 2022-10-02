import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './components/Home'
import Login from './components/Login'
import Register from './components/Register'
import Forum from './components/Forum'

Vue.use(VueRouter)

const router = new VueRouter({
  //  mode: 'history',
    routes:
    [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/forum',
            name: 'Forum',
            component: Forum
        }
    ]
})

export default router