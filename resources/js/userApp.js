import { createApp } from 'vue';
import 'toastr/build/toastr.min.css';
import VehicleList from './components/user_site/VehicleList.vue';
import VehicleDetails from './components/user_site/VehicleDetails.vue';
import Newcar from './components/user_site/NewCar.vue';
import Father from './components/user_site/Father.vue';

const userApp = createApp({});
userApp.component('vehicle-list', VehicleList);
userApp.component('vehicle-details', VehicleDetails);
userApp.component('father', Father);
userApp.mount('#user-components');


const newcarApp = createApp({});
newcarApp.component('newcar', Newcar);
newcarApp.mount('#newcar');
