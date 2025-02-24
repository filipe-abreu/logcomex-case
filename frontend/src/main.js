import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import './assets/style.css' // Importa o CSS global

createApp(App)
  .use(router)
  .mount('#app')
