import 'bootstrap/dist/css/bootstrap.css';
import './Icon/index.js';
import { createApp } from 'vue'; 
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome' 
import store from './State/index.js' 
import app from './Components/App.vue'; 
import router from './Route/index.js'


createApp(app)
.use(router)
.use(store)
.component('font-awesome-icon', FontAwesomeIcon)
.mount("#app")

import 'bootstrap/dist/js/bootstrap.js';
