<template>
  <div class="container mt-5">
    <div class="d-flex flex-wrap">
      <div v-for="vehicle in vehicles" :key="vehicle.id" class="col-4 mb-4">
        <div class="card mx-4">
          <img :src="vehicle.image_url" class="card-img-top img-fluid h-100" :alt="vehicle.marca + ' ' + vehicle.modelo + ' ' + vehicle.version + ' ' + vehicle.codigo">
          <div class="card-body">
            <h5 class="card-title">{{ vehicle.marca }} {{ vehicle.modelo }}{{ vehicle.version }} {{ vehicle.codigo }}</h5>
            <p class="card-text">Año: {{ vehicle.año_desde }} - {{ vehicle.año_hasta }}</p>
            <p class="card-text">Combustible: {{ vehicle.combustible }}</p>
            <p class="card-text">Cambio: {{ vehicle.cambio }}</p>
            <button @click="showDetails(vehicle.id)" class="btn btn-primary btn-details">Más Detalles</button>
          </div>
        </div>
      </div>
    </div>
    <button v-if="currentPage < totalPages" @click="loadMoreVehicles" class="btn btn-primary mx-auto mt-3 w-100">Cargar más</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      vehicles: [],
      pageSize: 3,
      currentPage: 1,
      totalPages: 1
    };
  },
  methods: {
    fetchVehicles(page = 1) {
      fetch(`/api/v1/privatevehicles?page=${page}&limit=${this.pageSize}`)
        .then(response => response.json())
        .then(data => {
          // Agregar los nuevos vehículos a la matriz existente
          this.vehicles = [...this.vehicles, ...data.data];
          this.totalPages = data.pagination.last_page;
        })
        .catch(error => console.error('Error fetching vehicles:', error));
    },
    loadMoreVehicles() {
      this.currentPage++;
      this.fetchVehicles(this.currentPage);
    },
    showDetails(vehicleId) {
      // Emitir el evento "show-details" con el ID del vehículo
      this.$emit('show-details', vehicleId);
      console.log(vehicleId)
    }
  },
  mounted() {
    this.fetchVehicles();
  }
};
</script>
