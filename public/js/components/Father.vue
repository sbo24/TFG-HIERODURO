<template>
  <div>
    <vehicle-list @show-details="handleShowDetails" />
    <vehicle-details :vehicle-id="selectedVehicleId" />
  </div>
</template>

<script>
import VehicleList from './components/VehicleList.vue';
import VehicleDetails from './components/VehicleDetails.vue';

export default {
  components: {
    VehicleList,
    VehicleDetails
  },
  data() {
    return {
      selectedVehicleId: null
    };
  },
  methods: {
    handleShowDetails(vehicleId) {
      this.selectedVehicleId = vehicleId;
    }
  }
};
</script>
