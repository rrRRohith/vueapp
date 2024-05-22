require('./bootstrap');

import "bootstrap/dist/css/bootstrap.min.css"

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { createApp } from 'vue';
import App from './components/App.vue'
import router from './router';
import store from './store';
import helper from './helper';
import axios from 'axios'

axios.defaults.withCredentials = true;

store.dispatch('getUser').then(() => {
    const app = createApp(App).use(router).use(store).use(VueSweetalert2)
    app.config.globalProperties.$axios = axios
    
    /**
     * Load custom helper into global properties here.
     */
    app.config.globalProperties.$helper = helper
    app.mount("#app");
})
