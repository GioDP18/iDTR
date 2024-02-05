import 'bootstrap/dist/css/bootstrap.css';
import { createApp } from 'vue'; 
import store from './State/index.js' 
import app from './Components/App.vue'; 
import router from './Route/index.js'


createApp(app)
.use(router)
.use(store)
.mount("#app")

import 'bootstrap/dist/js/bootstrap.js';
