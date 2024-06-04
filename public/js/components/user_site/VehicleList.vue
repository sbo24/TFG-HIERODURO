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
          <div class="card car-card overflow-hidden shadow-sm">
            <!-- Imagen del vehículo -->
            <div class="position-relative car-image-container">
              <img :src="vehicle.image_url" class="card-img-top" :alt="vehicle.marca + ' ' + vehicle.modelo">
              <!-- Etiqueta de año -->
              <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3">{{ vehicle.año_desde }} - {{
                vehicle.año_hasta }}</span>
            </div>
            <!-- Cuerpo de la tarjeta -->
            <div class="card-body text-center">
              <h5 class="card-title mb-3">{{ vehicle.marca }} {{ vehicle.modelo }}</h5>
              <p class="card-text mb-2">
                <i class="fas fa-tachometer-alt text-primary"></i> <strong>CV:</strong> {{ vehicle.cv }}
              </p>
              <p class="card-text mb-2">
                <i class="fas fa-cogs text-secondary"></i> <strong>NM:</strong> {{ vehicle.torque }}
              </p>
            </div>
            <!-- Botones de acciones -->
            <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
              <button @click="showDetails(vehicle.id)" class="btn btn-outline-primary flex-grow-1 me-2">
                <i class="fas fa-info-circle me-2"></i> Más Detalles
              </button>
              <button @click="deleteVehicle(vehicle.id)" class="btn btn-outline-danger ms-2">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button v-if="currentPage < totalPages" @click="loadMoreVehicles" class="btn btn-primary mx-auto mt-3 w-100">Cargar
      más</button>
  </div>
  <div id="floating-message" class="alert alert-success floating-message" role="alert" style="display: none;">
    <!-- Aquí se mostrará el mensaje -->
  </div>

  <!-- Modal de confirmación -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirmación de eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas eliminar este vehículo?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="deleteButton">Eliminar</button>
        </div>
      </div>
    </div>
  </div>



</template>

<style>
.car-card {
  border-radius: 20px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: none;
}

.car-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.car-image-container {
  overflow: hidden;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}

.car-image-container img {
  height: 200px;
  width: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.badge {
  font-size: 0.85em;
  padding: 0.5em 0.75em;
  border-radius: 8px;
}

.card-body {
  background: #f8f9fa;
  padding: 20px;
}

.card-title {
  font-size: 1.25em;
  font-weight: 600;
  color: #343a40;
}

.card-text {
  font-size: 1em;
  color: #6c757d;
}

.card-footer {
  background: #f8f9fa;
  padding: 15px;
  border-top: 1px solid #e9ecef;
}

.btn-outline-primary,
.btn-outline-danger {
  font-size: 0.9em;
  padding: 0.5em 1em;
  transition: background 0.3s ease, color 0.3s ease;
  border-radius: 25px;
}

.btn-outline-primary:hover,
.btn-outline-danger:hover {
  color: white;
}

.btn-outline-primary:hover {
  background: #007bff;
}

.btn-outline-danger:hover {
  background: #dc3545;
}

 .floating-message {
   position: fixed;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   z-index: 1000;
   /* Asegura que el mensaje flotante esté sobre otros elementos */
   display: none;
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
    deleteVehicle(vehicleId) {
      // Mostrar modal de confirmación
      const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
      confirmationModal.show();

      // Manejar clic en el botón de eliminar dentro del modal
      const deleteButton = document.getElementById('deleteButton');
      deleteButton.addEventListener('click', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/api/v1/privatevehicles/delete', {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ id: vehicleId })
        })
          .then(response => {
            if (response.ok) {
              // Eliminar el vehículo de la lista local
              this.vehicles = this.vehicles.filter(vehicle => vehicle.id !== vehicleId);
              this.applyFilters();
              // Mostrar mensaje de éxito como un mensaje flotante
              const floatingMessage = document.getElementById('floating-message');
              floatingMessage.textContent = 'Vehículo eliminado correctamente';
              // Mostrar el mensaje flotante
              floatingMessage.style.display = 'block';
              // Ocultar el mensaje flotante después de 3 segundos
              setTimeout(() => {
                floatingMessage.style.display = 'none';
              }, 3000);
            } else {
              // Mostrar mensaje de error como un mensaje flotante
              const floatingMessage = document.getElementById('floating-message');
              floatingMessage.textContent = 'Error al eliminar el vehículo';
              // Mostrar el mensaje flotante
              floatingMessage.style.display = 'block';
              // Ocultar el mensaje flotante después de 3 segundos
              setTimeout(() => {
                floatingMessage.style.display = 'none';
              }, 3000);
            }
          })
          .catch(error => console.error('Error eliminando el vehículo:', error));

        // Cerrar el modal después de hacer clic en eliminar
        confirmationModal.hide();
      });
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
