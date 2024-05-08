import { createApp } from 'vue';
import VehicleList from './components/user_site/VehicleList.vue';
import VehicleDetails from './components/user_site/VehicleDetails.vue';
import Father from './components/user_site/Father.vue';

const userApp = createApp({});
userApp.component('vehicle-list', VehicleList);
userApp.component('vehicle-details', VehicleDetails);
userApp.component('father', Father);
userApp.mount('#user-components');
