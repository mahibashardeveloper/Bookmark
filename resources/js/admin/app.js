import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min';
window.bootstrap = bootstrap
import Toaster from '@meforma/vue-toaster';
import axios from "axios";
import App from "./App.vue";
import {createApp} from "vue";
import router from "./router/router";
createApp(App).use(router,  axios).use(Toaster).mount('#app')
