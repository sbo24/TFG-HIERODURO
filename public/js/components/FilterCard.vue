<template>
    <div class="container mt-5">
        <h2 class="mb-5 text-center">Mis Vehículos</h2>

        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="yearFilter" class="form-label">Año:</label>
                <select class="form-select filter-select" v-model="filters.year">
                    <option value="">Todos</option>
                    <option v-for="(year, index) in filterOptions.years" :key="index" :value="year">{{ year }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="brandFilter" class="form-label">Marca:</label>
                <select class="form-select filter-select" v-model="filters.brand">
                    <option value="">Todas</option>
                    <option v-for="(brand, index) in filterOptions.brands" :key="index" :value="brand">{{ brand }}
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="fuelTypeFilter" class="form-label">Combustible:</label>
                <select class="form-select filter-select" v-model="filters.fuelType">
                    <option value="">Todos</option>
                    <option v-for="(fuelType, index) in filterOptions.fuelTypes" :key="index" :value="fuelType">{{
                    fuelType }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="gearboxFilter" class="form-label">Cambio:</label>
                <select class="form-select filter-select" v-model="filters.gearbox">
                    <option value="">Todos</option>
                    <option v-for="(gearbox, index) in filterOptions.gearboxes" :key="index" :value="gearbox">{{ gearbox
                        }}</option>
                </select>
            </div>
        </div>

        <!-- Campo de búsqueda -->
        <div class="input-group mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar vehículo...">
            <button class="btn btn-outline-secondary" type="button" id="searchBtn"><i
                    class="fas fa-search"></i></button>
        </div>

        <!-- Lista de vehículos -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div v-for="vehicle in filteredVehicles" :key="vehicle.id" class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ vehicle.marca }} {{ vehicle.modelo }}</h5>
                        <p class="card-text">Año: {{ vehicle.año }}</p>
                        <p class="card-text">Combustible: {{ vehicle.tipo_combustible }}</p>
                        <p class="card-text">Cambio: {{ vehicle.tipo_cambio }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para cargar más vehículos -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" id="loadMoreBtn">Cargar más</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            vehicles: [],
            filters: {
                year: '',
                brand: '',
                fuelType: '',
                gearbox: ''
            }
        };
    },
    computed: {
        filterOptions() {
            return {
                years: [...new Set(this.vehicles.map(vehicle => vehicle.año))],
                brands: [...new Set(this.vehicles.map(vehicle => vehicle.marca))],
                fuelTypes: [...new Set(this.vehicles.map(vehicle => vehicle.tipo_combustible))],
                gearboxes: [...new Set(this.vehicles.map(vehicle => vehicle.tipo_cambio))]
            };
        },
        filteredVehicles() {
            return this.vehicles.filter(vehicle => {
                const { year, brand, fuelType, gearbox } = this.filters;
                return (!year || vehicle.año == year) &&
                    (!brand || vehicle.marca == brand) &&
                    (!fuelType || vehicle.tipo_combustible == fuelType) &&
                    (!gearbox || vehicle.tipo_cambio == gearbox);
            });
        }
    },
    methods: {
        fetchVehicles() {
            fetch('/api/v1/privatevehicles')
                .then(response => response.json())
                .then(data => {
                    this.vehicles = data.vehicles;
                })
                .catch(error => console.error('Error:', error));
        }
    },
    created() {
        this.fetchVehicles();
    }
};
</script>

<style scoped>
/* Agrega estilos personalizados según sea necesario */
</style>
