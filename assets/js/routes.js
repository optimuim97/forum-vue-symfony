import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/Login'
import Logout from './components/Logout'
import Register from './components/Register'
import Forum from './components/Forum'
import Create from './components/Create'
import Read from './components/Read'
import NProgress from 'nprogress';

const router = new VueRouter({
    // hashbang:true,
    // mode: 'history',
    routes:
    [
        {
            path: '/',
            // name: './views/App',
            // component: App  ,
            name: 'Login'
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

Vue.use(VueRouter)

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
    }
)

router.afterEach(() => {
        // Complete the animation of the route progress bar.
        NProgress.done()
    }
)
  

export default router