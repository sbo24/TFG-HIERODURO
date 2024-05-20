<template>
  <div class="container mt-5">
    <!-- Filtros -->
    <div class="row mb-4">
      <div class="col-md-3">
        <label for="yearFilter" class="form-label">Año:</label>
        <select class="form-select filter-select" id="yearFilter" @change="applyFilters">
          <option value="">Todos</option>
          <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="brandFilter" class="form-label">Marca:</label>
        <select class="form-select filter-select" id="brandFilter" @change="applyFilters">
          <option value="">Todas</option>
          <option v-for="brand in availableBrands" :key="brand" :value="brand">{{ brand }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="fuelTypeFilter" class="form-label">Combustible:</label>
        <select class="form-select filter-select" id="fuelTypeFilter" @change="applyFilters">
          <option value="">Todos</option>
          <option v-for="fuelType in availableFuelTypes" :key="fuelType" :value="fuelType">{{ fuelType }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="gearboxFilter" class="form-label">Cambio:</label>
        <select class="form-select filter-select" id="gearboxFilter" @change="applyFilters">
          <option value="">Todos</option>
          <option v-for="gearbox in availableGearboxes" :key="gearbox" :value="gearbox">{{ gearbox }}</option>
        </select>
      </div>
    </div>

    <!-- Campo de búsqueda -->
    <div class="input-group mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Buscar vehículo..." @input="applyFilters">
      <button class="btn btn-outline-secondary" type="button" id="searchBtn" @click="applyFilters"><i
          class="fas fa-search"></i></button>
    </div>

    <!-- Vehículos -->
    <!-- Contenedor principal -->
    <div class="container py-4">
      <!-- Fila de tarjetas -->
      <div class="row g-4">
        <!-- Bucle para generar tarjetas de vehículos -->
        <div v-for="vehicle in filteredVehicles" :key="vehicle.id" class="col-md-6 col-lg-4">
          <!-- Tarjeta individual -->
          <div class="card car-card overflow-hidden shadow">
            <!-- Imagen del vehículo -->
            <div class="position-relative">
              <img :src="vehicle.image_url" class="card-img-top" :alt="vehicle.marca + ' ' + vehicle.modelo">
              <!-- Etiqueta de año -->
              <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3">{{ vehicle.año_desde }} - {{
          vehicle.año_hasta }}</span>
            </div>
            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
              <h5 class="card-title">{{ vehicle.marca }} {{ vehicle.modelo }}</h5>
              <p class="card-text">
                <strong>Combustible:</strong> {{ vehicle.combustible }}<br>
                <strong>Cambio:</strong> {{ vehicle.cambio }}
              </p>
            </div>
            <!-- Botón de detalles -->
            <div class="card-footer bg-transparent border-0">
              <button @click="showDetails(vehicle.id)" class="btn btn-outline-primary w-100">
                Más Detalles
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>






    <button v-if="currentPage < totalPages" @click="loadMoreVehicles" class="btn btn-primary mx-auto mt-3 w-100">Cargar
      más</button>


  </div>
</template>

<style>
/* Estilos CSS para las tarjetas de coches */
.car-card {
  transition: transform 0.5s ease, box-shadow 0.5s ease;
}

.car-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
}

.car-card img {
  height: 200px;
  /* Ajusta la altura según tus necesidades */
  object-fit: cover;
}

.badge {
  font-size: 0.9em;
}

/* Ajustes para pantallas más pequeñas */
@media (max-width: 767px) {
  .car-card img {
    height: auto;
  }
}
</style>

<script>
export default {
  data() {
    return {
      vehicles: [],
      filteredVehicles: [],
      availableYears: [],
      availableBrands: [],
      availableFuelTypes: [],
      availableGearboxes: [],
      pageSize: 3,
      currentPage: 1,
      totalPages: 1,
      showLoadMoreButton: true
    };
  },
  methods: {
    fetchVehicles(page = 1) {
      fetch(`/api/v1/privatevehicles?page=${page}&limit=${this.pageSize}`)
        .then(response => response.json())
        .then(data => {
          // Actualizar o reemplazar la lista de vehículos según la página
          if (page === 1) {
            this.vehicles = data.data;
          } else {
            this.vehicles.push(...data.data);
          }
          // Aplicar los filtros para actualizar los vehículos mostrados
          this.applyFilters();
          // Actualizar el número total de páginas
          this.totalPages = data.pagination.last_page;
          // Mostrar el botón "Cargar más" si hay más páginas disponibles
          this.showLoadMoreButton = this.currentPage < this.totalPages;
        })
        .catch(error => console.error('Error fetching vehicles:', error));
    },
    loadMoreVehicles() {
      // Incrementar la página actual y cargar más vehículos
      this.currentPage++;
      this.fetchVehicles(this.currentPage);
    },
    showDetails(vehicleId) {
      // Emitir el evento "show-details" con el ID del vehículo
      this.$emit('show-details', vehicleId);
      console.log(vehicleId)
    },
    applyFilters() {
      // Obtener valores de los filtros seleccionados
      const yearFilter = $('#yearFilter').val();
      const brandFilter = $('#brandFilter').val();
      const fuelTypeFilter = $('#fuelTypeFilter').val();
      const gearboxFilter = $('#gearboxFilter').val();
      const searchInput = $('#searchInput').val().trim().toLowerCase();

      // Filtrar los vehículos según los filtros seleccionados y la búsqueda
      this.filteredVehicles = this.vehicles.filter(vehicle => {
        const matchesYear = yearFilter === '' || vehicle.año_desde == yearFilter || vehicle.año_hasta == yearFilter;
        const matchesBrand = brandFilter === '' || vehicle.marca.toLowerCase().includes(brandFilter.toLowerCase());
        const matchesFuelType = fuelTypeFilter === '' || vehicle.combustible.toLowerCase().includes(fuelTypeFilter.toLowerCase());
        const matchesGearbox = gearboxFilter === '' || vehicle.cambio.toLowerCase().includes(gearboxFilter.toLowerCase());
        const matchesSearch = searchInput === '' || vehicle.marca.toLowerCase().includes(searchInput) || vehicle.modelo.toLowerCase().includes(searchInput) || vehicle.version.toLowerCase().includes(searchInput) || vehicle.codigo.toLowerCase().includes(searchInput);
        return matchesYear && matchesBrand && matchesFuelType && matchesGearbox && matchesSearch;
      });

      // Mostrar el botón "Cargar más" si hay más páginas disponibles
      this.showLoadMoreButton = this.currentPage < this.totalPages;
    },
    loadOptions() {
      fetch('/api/v1/privatevehicles')
        .then(response => response.json())
        .then(data => {
          // Obtener valores únicos para cada filtro
          const uniqueYears = [...new Set(data.data.map(vehicle => vehicle.año_desde))];
          const uniqueBrands = [...new Set(data.data.map(vehicle => vehicle.marca))];
          const uniqueFuelTypes = [...new Set(data.data.map(vehicle => vehicle.combustible))];
          const uniqueGearboxes = [...new Set(data.data.map(vehicle => vehicle.cambio))];

          // Actualizar las propiedades de datos con las opciones disponibles
          this.availableYears = uniqueYears;
          this.availableBrands = uniqueBrands;
          this.availableFuelTypes = uniqueFuelTypes;
          this.availableGearboxes = uniqueGearboxes;
        })
        .catch(error => console.error('Error fetching options:', error));
    }
  },
  mounted() {
    this.fetchVehicles();
    this.loadOptions();
  },
  computed: {
    // Función para obtener opciones únicas de un atributo de vehículo
    uniqueOptions() {
      return attribute => {
        const uniqueValues = new Set();
        this.vehicles.forEach(vehicle => uniqueValues.add(vehicle[attribute]));
        return Array.from(uniqueValues);
      };
    }
  },
  watch: {
    // Observadores para volver a aplicar los filtros cuando cambian las opciones disponibles
    availableYears: 'applyFilters',
    availableBrands: 'applyFilters',
    availableFuelTypes: 'applyFilters',
    availableGearboxes: 'applyFilters'
  }
};
</script>
