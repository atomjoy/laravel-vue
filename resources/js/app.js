import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { createI18n } from 'vue-i18n';
import lang from './lang';
import router from './router';
import App from './App.vue';
import './assets/css/main.css';

const app = createApp(App);
const i18n = createI18n(lang);
const stores = createPinia();

app.use(i18n);
app.use(stores);
app.use(router);
app.mount('#app');
