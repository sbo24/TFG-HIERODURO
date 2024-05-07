<!-- VehicleDetails.vue -->
<template>
  <div class="container mt-5" v-if="vehicleDetails">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card mb-3 vehicle-card">
          <div class="row no-gutters">
            <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center">
              <img :src="vehicleDetails.image_url" class="card-img img-fluid" :alt="vehicleDetails.marca + ' ' + vehicleDetails.modelo">
              <div class="mt-3 text-center">
                <p class="text-muted">{{ vehicleDetails.descripcion }}</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ vehicleDetails.marca }} {{ vehicleDetails.modelo }}{{ vehicleDetails.version }} {{ vehicleDetails.codigo }}</h5>
                <p class="card-text">Año: {{ vehicleDetails.año_desde }} - {{ vehicleDetails.año_hasta }}</p>
                <h6 class="mt-4">Revisiones:</h6>
                <div class="revision-list mb-4">
                  <ul class="list-group">
                    <li class="list-group-item revision-list-item p-2">
                      <strong>Cambio de aceite:</strong><br>
                      Kilometraje: <span id="mileageValue">{{ vehicleDetails.c_aceite }}</span><br>
                      Próxima revisión: {{ vehicleDetails.proximo_c_aceite }} km
                    </li>
                  </ul>
                </div>
                <p><i class="fas fa-horse-head"></i> {{ vehicleDetails.cv }} CV</p>
                <p><i class="fas fa-cogs"></i> {{ vehicleDetails.torque }} Nm</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    vehicleId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      vehicleDetails: null
    };
  },
  mounted() {
    this.fetchVehicleDetails();
  },
  methods: {
    fetchVehicleDetails() {
      fetch(`/api/v1/privatevehicles/${this.vehicleId}`)
        .then(response => response.json())
        .then(vehicle => {
          this.vehicleDetails = vehicle;
        })
        .catch(error => console.error('Error fetching vehicle details:', error));
    }
  }
};
</script>

<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
