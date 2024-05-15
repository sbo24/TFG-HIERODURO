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



    <!-- Filtros -->
    <div class="row mb-4">
      <div class="col-md-3">
        <label for="brandFilter" class="form-label">Marca:</label>
        <select v-model="selectedBrand" class="form-select filter-select" id="brandFilter" @change="loadModels">
          <option value="">Selecciona una Marca</option>
          <option v-for="brand in availableBrands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="modelFilter" class="form-label">Modelo:</label>
        <select v-model="selectedModel" class="form-select filter-select" id="modelFilter" @change="loadMotorizations">
          <option value="">Selecciona un Modelo</option>
          <option v-for="model in availableModels" :key="model.id" :value="model.id">{{ model.nombre }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="motorizationFilter" class="form-label">Motorización:</label>
        <select v-model="selectedMotorization" class="form-select filter-select" id="motorizationFilter"
          @change="loadVersions">
          <option value="">Selecciona una Motorización</option>
          <option v-for="motorization in availableMotorizations" :key="motorization.id" :value="motorization.id">{{
          motorization.nombre }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="versionFilter" class="form-label">Versión:</label>
        <select v-model="selectedVersion" class="form-select filter-select" id="versionFilter" @change="applyFilters">
          <option value="">Selecciona una Versión</option>
          <option v-for="version in availableVersions" :key="version.id" :value="version.id">{{ version.codigo }}
          </option>
        </select>
      </div>
    </div>

      <!-- Botón para obtener ID de la fila -->
    <button class="btn btn-primary" @click="getDetailsId">Obtener ID de la fila</button>
    
    <!-- Mostrar el ID de la fila si está disponible -->
    <div v-if="detailsId !== null">
      <p>El ID de la fila correspondiente es: {{ detailsId }}</p>
    </div>







    <!-- Vehículos -->
    <div class="d-flex flex-wrap">
      <div v-for="vehicle in filteredVehicles" :key="vehicle.id" class="col-6 col-md-4 mb-4">
        <div class="card mx-4">
          <img :src="vehicle.image_url" class="card-img-top img-fluid h-100"
            :alt="vehicle.marca + ' ' + vehicle.modelo + ' ' + vehicle.version + ' ' + vehicle.codigo">
          <div class="card-body">
            <h5 class="card-title">{{ vehicle.marca }} {{ vehicle.modelo }}{{ vehicle.version }} {{ vehicle.codigo }}
            </h5>
            <p class="card-text">Año: {{ vehicle.año_desde }} - {{ vehicle.año_hasta }}</p>
            <p class="card-text">Combustible: {{ vehicle.combustible }}</p>
            <p class="card-text">Cambio: {{ vehicle.cambio }}</p>
            <button @click="showDetails(vehicle.id)" class="btn btn-primary btn-details">Más Detalles</button>
          </div>
        </div>
      </div>
    </div>
    <button v-if="currentPage < totalPages" @click="loadMoreVehicles" class="btn btn-primary mx-auto mt-3 w-100">Cargar
      más</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      vehicles: [],
      filteredVehicles: [],
      availableYears: [],
      availableFuelTypes: [],
      availableGearboxes: [],
      pageSize: 3,
      currentPage: 1,
      totalPages: 1,
      availableBrands: [],
      availableModels: [],
      availableMotorizations: [],
      availableVersions: [],
      selectedBrand: '',
      selectedModel: '',
      selectedMotorization: '',
      selectedVersion: '',
      detailsId: null
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
          this.applyFilters(); // Aplicar los filtros inicialmente
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

      // Recalcular el número total de páginas basado en los vehículos filtrados
      this.totalPages = Math.ceil(this.filteredVehicles.length / this.pageSize);
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
    },
    loadBrands() {
      fetch('/api/v1/brands')
        .then(response => response.json())
        .then(data => {
          this.availableBrands = data;
        })
        .catch(error => console.error('Error fetching brands:', error));
    },
    loadModels() {
      if (this.selectedBrand !== '') {
        fetch(`/api/v1/models/${this.selectedBrand}`)
          .then(response => response.json())
          .then(data => {
            this.availableModels = data;
          })
          .catch(error => console.error('Error fetching models:', error));
      }
    },
    loadMotorizations() {
      if (this.selectedModel !== '') {
        fetch(`/api/v1/motorization/${this.selectedModel}`)
          .then(response => response.json())
          .then(data => {
            this.availableMotorizations = data;
          })
          .catch(error => console.error('Error fetching motorizations:', error));
      }
    },
    loadVersions() {
      if (this.selectedMotorization !== '') {
        fetch(`/api/v1/cp/${this.selectedMotorization}`)
          .then(response => response.json())
          .then(data => {
            this.availableVersions = data;
          })
          .catch(error => console.error('Error fetching postal codes:', error));
      }
    },
 getDetailsId() {
  // Obtener los valores seleccionados de los filtros
  const selectedBrand = this.selectedBrand;
  const selectedModel = this.selectedModel;
  const selectedMotorization = this.selectedMotorization;
  const selectedVersion = this.selectedVersion;

  // Verificar que todos los filtros estén seleccionados antes de hacer la solicitud a la API
  if (selectedBrand && selectedModel && selectedMotorization && selectedVersion) {
    // Construir la URL de la solicitud para obtener el ID de la fila correspondiente
    const url = `/api/v1/detalles/${selectedBrand}/${selectedModel}/${selectedMotorization}/${selectedVersion}`;

    // Realizar la solicitud fetch para obtener el ID de la fila
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Error obteniendo el ID de la fila');
        }
        return response.json();
      })
      .then(data => {
        // Obtener el ID de la fila correspondiente de la respuesta
        const detailsId = data[0].id; // Asumiendo que el ID de la fila está en la propiedad 'id'
        console.log("ID de la fila correspondiente:", detailsId);

        // Llamar al método para crear el vehículo utilizando el ID obtenido
        this.createPrivateVehicle(detailsId);
      })
      .catch(error => {
        console.error('Error obteniendo el ID de la fila:', error.message);
      });
  } else {
    console.error('Por favor, seleccione todas las opciones de los filtros.');
  }
},

createPrivateVehicle(detailsId) {
  // Construir la URL de la solicitud para crear un vehículo privado
  const url = `/api/v1/privatevehicles/store`;

  // Obtener el token CSRF
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Construir los datos que se enviarán en la solicitud, incluyendo el token CSRF
  const requestData = {
    _token: csrfToken,
    details_id: detailsId, // Enviar el ID obtenidoç
    
    // Puedes agregar más datos si es necesario, según lo que requiera el endpoint
  };

  // Realizar la solicitud fetch para crear el vehículo privado
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken // Añadir el token CSRF como un encabezado personalizado
    },
    body: JSON.stringify(requestData) // Convertir los datos a formato JSON
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Error creando el vehículo');
    }
    return response.json(); // Convertir la respuesta a JSON
  })
  .then(data => {
    // Imprimir los datos recibidos de la API
    console.log("Vehículo creado:", data);
    // Aquí puedes manejar la respuesta según sea necesario
  })
  .catch(error => {
    console.error('Error creando el vehículo:', error.message);
  });
},





    
  },

  mounted() {
    this.fetchVehicles();
    this.loadOptions();
    this.loadBrands();
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
