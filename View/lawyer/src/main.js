import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VueSimpleAlert from "vue-simple-alert";


createApp(App).use(router).mount('#app')
createApp(App).use(VueSimpleAlert).mount('#app');

