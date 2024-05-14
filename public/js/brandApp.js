import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'; // Importa los módulos necesarios
import Brands from './components/brands/Brands.vue';
import BrandDetails from './components/brands/BrandDetails.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Brands
        },
        {
            path: '/marca/:marca',
            component: BrandDetails
        }
    ]
});

const BrandsApp = createApp({});
BrandsApp.use(router); // Usa el enrutador
BrandsApp.component('brand', Brands);
BrandsApp.mount('#brands');
