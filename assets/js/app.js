// import Vue from 'vue';
// import Vuetify from 'vuetify';
// import App from './views/App';
// import 'vuetify/dist/vuetify.min.css'

// // Vue.config.productionTip = false
// Vue.use(Vuetify);

// const app = new Vue({
//     vuetify: new Vuetify(),
//     el: '#app',
//     router: Routes,
//     render: h => h(App)
// });


import { createApp } from 'vue'
import App from './views/App';
import Routes from './routes.js';

// Vue.config.productionTip = false

const app = createApp(App).use(Routes).mount('#app');

export default app;