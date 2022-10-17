import Vue from 'vue';
import App from './views/App';
import Routes from './routes';
import Vuetify from 'vuetify'
import axios from 'axios';
import User from "./utils/User.js"
import AppStorage from "./utils/AppStorage.js"
import { Editor } from '@toast-ui/vue-editor';
import mdiVue from 'mdi-vue/v2'
import * as mdijs from '@mdi/js'
import '@mdi/font/css/materialdesignicons.css'
import '../../node_modules/nprogress/nprogress.css'
import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
import VueLoading from 'vuejs-loading-plugin'

// Vue.use(VueLoading)

// overwrite defaults
Vue.use(VueLoading, {
    // dark: true, // default false
    text: 'Chargement en cours', 
    // default 'Loading'
    // loading: true, 
    // default false
    // customLoader: myVueComponent, 
    // replaces the spinner and text with your own
    background: 'rgb(255,255,255)', 
    // set custom background
    // classes: ['myclass'] 
    // array, object or string
  })

Vue.use(VueToastr,{
    defaultPosition: 'toast-bottom-left',
    defaultType: 'info',
    defaultTimeout: 2000
})

Vue.use(require('vue-moment'));

Vue.use(mdiVue, {
    icons: mdijs
}) 


Vue.config.productionTip = false
Vue.use(Vuetify)
Vue.use(axios)
Vue.use(Editor)

window.User = User;
window.Storage = AppStorage
window.EventBus = new Vue();

window.axios = require('axios');
const JWTToken = `Bearer ${localStorage.getItem('token')}`

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = JWTToken;
// axios.defaults.headers.common['content-type'] = 'application/json';

localStorage.getItem('user')

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router: Routes,
    render: h => h(App)
});

export default app;