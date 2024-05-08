import { createApp } from 'vue';
import Filters from './components/vehicles/Filters.vue';

const vehicleFiltersApp = createApp({});
vehicleFiltersApp.component('filters', Filters);
vehicleFiltersApp.mount('#vehicle-filters');
