import './bootstrap';
import { createApp } from 'vue';
import ApiAccessRequestForm from './components/ApiAccessRequestForm.vue';

// Créez l'application Vue
const app = createApp(ApiAccessRequestForm);

// Montez l'application sur l'élément avec l'ID #app
app.mount('#app');
