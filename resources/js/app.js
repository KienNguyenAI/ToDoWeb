import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from '../views/router/index.js';
import 'ant-design-vue/dist/reset.css';
import Antd from 'ant-design-vue';
import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import '@fortawesome/fontawesome-free/css/all.min.css';

const app = createApp(App);
app.use(Antd);
app.use(router);
app.mount('#app');
