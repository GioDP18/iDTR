import 'bootstrap/dist/css/bootstrap.css';
import './Icon/index.js';
import 'sweetalert2/dist/sweetalert2.min.css';
import { createApp } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import swal from 'vue-sweetalert2';
import store from './State/index.js'
import app from './Components/App.vue';
import router from './Route/index.js'


createApp(app)
.use(router)
.use(store)
.use(swal)
.component('font-awesome-icon', FontAwesomeIcon)
.mount("#app")

import 'bootstrap/dist/js/bootstrap.js';
