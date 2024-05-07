<template>
  <div>
    <div class="row mb-4">
      <div class="col-md-3">
        <label for="yearFilter" class="form-label">Año:</label>
        <select v-model="selectedYear" class="form-select filter-select" id="yearFilter">
          <option value="">Todos</option>
          <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="brandFilter" class="form-label">Marca:</label>
        <select v-model="selectedBrand" class="form-select filter-select" id="brandFilter">
          <option value="">Todas</option>
          <option v-for="brand in brands" :key="brand" :value="brand">{{ brand }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="fuelTypeFilter" class="form-label">Combustible:</label>
        <select v-model="selectedFuelType" class="form-select filter-select" id="fuelTypeFilter">
          <option value="">Todos</option>
          <option v-for="fuelType in fuelTypes" :key="fuelType" :value="fuelType">{{ fuelType }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="gearboxFilter" class="form-label">Cambio:</label>
        <select v-model="selectedGearbox" class="form-select filter-select" id="gearboxFilter">
          <option value="">Todos</option>
          <option v-for="gearbox in gearboxes" :key="gearbox" :value="gearbox">{{ gearbox }}</option>
        </select>
      </div>
    </div>

    <!-- Campo de búsqueda -->
    <div class="input-group mb-3">
      <input v-model="searchQuery" type="text" class="form-control" placeholder="Buscar vehículo...">
      <button class="btn btn-outline-secondary" type="button" @click="search"><i class="fas fa-search"></i></button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedYear: '',
      selectedBrand: '',
      selectedFuelType: '',
      selectedGearbox: '',
      searchQuery: '',
      vehicles: []
    };
  },
  computed: {
    years() {
      const years = new Set();
      this.vehicles.forEach(vehicle => years.add(vehicle.año_desde));
      return Array.from(years).sort((a, b) => b - a);
    },
    brands() {
      const brands = new Set();
      this.vehicles.forEach(vehicle => brands.add(vehicle.marca));
      return Array.from(brands).sort();
    },
    fuelTypes() {
      const fuelTypes = new Set();
      this.vehicles.forEach(vehicle => fuelTypes.add(vehicle.combustible));
      return Array.from(fuelTypes).sort();
    },
    gearboxes() {
      const gearboxes = new Set();
      this.vehicles.forEach(vehicle => gearboxes.add(vehicle.cambio));
      return Array.from(gearboxes).sort();
    }
  },
  methods: {
    async fetchVehicles() {
      try {
        const response = await fetch('/api/v1/privatevehicles');
        const data = await response.json();
        this.vehicles = data;
      } catch (error) {
        console.error('Error fetching vehicles:', error);
      }
    },
    search() {
      // Implementar la lógica de búsqueda aquí
      console.log('Año:', this.selectedYear);
      console.log('Marca:', this.selectedBrand);
      console.log('Combustible:', this.selectedFuelType);
      console.log('Cambio:', this.selectedGearbox);
      console.log('Búsqueda:', this.searchQuery);
    }
  },
  async mounted() {
    await this.fetchVehicles();
  }
};
</script>

<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
