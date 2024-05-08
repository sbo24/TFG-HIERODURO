// Importa las dependencias y el bootstrap de la aplicación
import './bootstrap';
import { createApp } from 'vue';

// Importa el componente necesario
import VehicleList from './components/user_site/VehicleList.vue';
import VehicleDetails from './components/user_site/VehicleDetails.vue';
import Father from './components/user_site/Father.vue';
import Filters from './components/vehicles/Filters.vue';


// Crea la aplicación Vue
const app = createApp({});

// Registra el componente globalmente
app.component('vehicle-list', VehicleList);
app.component('vehicle-details', VehicleDetails);
app.component('father', Father);

const filtersApp = createApp(Filters);
// Registra el componente globalmente
filtersApp.component('filters', Filters);
// Monta la aplicación en el elemento con el ID 'filters'
filtersApp.mount('#filters');

// Monta la aplicación en el elemento con el ID 'app'
app.mount('#app');
