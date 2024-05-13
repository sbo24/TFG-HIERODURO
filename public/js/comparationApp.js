import { createApp } from 'vue';
import Comparation from './components/comparation/Comparation.vue';

const comparationApp = createApp({});
comparationApp.component('comparation', Comparation);
comparationApp.mount('#vehicles-comparation');
