<template>
  <div>
    <vehicle-list @show-details="handleShowDetails" />
    <vehicle-details :vehicle-id="selectedVehicleId" />
  </div>
</template>

<script>
import VehicleList from './VehicleList.vue';
import VehicleDetails from './VehicleDetails.vue';

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
      // Actualizar selectedVehicleId con el ID del vehículo seleccionado
      this.selectedVehicleId = vehicleId;
    }
  }
};
</script>
