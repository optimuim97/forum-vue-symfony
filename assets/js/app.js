import Vue from 'vue';
import App from './views/App';
import Routes from './routes';
import Vuetify from 'vuetify'
import axios from 'axios';

Vue.config.productionTip = false
Vue.use(Vuetify)
Vue.use(axios)

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router: Routes,
    render: h => h(App)
});

export default app;