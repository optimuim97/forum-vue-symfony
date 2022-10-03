import Vue from 'vue'
import VueRouter from 'vue-router'

import App from './views/App'
import Login from './components/Login'
import Logout from './components/Logout'
import Register from './components/Register'
import Forum from './components/Forum'
import Create from './components/Create'
import Read from './components/Read'
import EditPost from './components/EditPost'

Vue.use(VueRouter)

const router = new VueRouter({
    hashbang:true,
    mode: 'history',
    routes:
    [
        {
            path: '/',
            // name: './views/App',
            // component: App  ,
            name: 'Login',
            component: Login
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
        },
        {
            path: '/create',
            name: 'Create',
            component: Create
        },
        {
            path: '/api/v1/article/:id',
            name: 'Read',
            component: Read
        },
        {
            path: '/logout',
            component: Logout
        },

    ]
})

export default router