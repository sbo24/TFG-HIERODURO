<template>
    <div class="container mt-5">

        <div class="row mb-4">
            <div class="col-md-3">
                <select v-model="selectedBrand" @change="onBrandChange" class="form-select">
                    <option value="">Selecciona una marca</option>
                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
                </select>
            </div>

            <!-- Selector de modelos -->
            <div class="col-md-3" v-if="selectedBrand">
                <select v-model="selectedModel" @change="onModelChange" class="form-select">
                    <option value="">Selecciona el modelo</option>
                    <option v-for="model in models" :key="model.id" :value="model.id">{{ model.nombre }}</option>
                </select>
            </div>

            <!-- Selector de motorizaciones -->
            <div class="col-md-3" v-if="selectedModel">
                <select v-model="selectedMotorization" @change="onMotorizationChange" class="form-select">
                    <option value="">Selecciona la motroizacion</option>
                    <option v-for="motorization in motorizations" :key="motorization.id" :value="motorization.id">{{
                    motorization.nombre }}</option>
                </select>
            </div>

            <!-- Selector de códigos -->
            <div class="col-md-3" v-if="selectedMotorization">
                <select v-model="selectedCode" class="form-select">
                    <option value="">Selecciona el codigo</option>
                    <option v-for="code in codes" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                </select>
            </div>
        </div>

        <div class="card" v-if="detalle">
            <div class="card-header bg-dark text-white ">
                <h5 class="card-title p-4">{{ detalle[0].descripcion }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <!-- Motor Section -->
                    <div class="section mb-4">
                        <li class="list-group-item bg-secondary text-white d-flex align-items-center">
                            <strong>Motor</strong>
                            <i class="fas fa-cogs ms-2"></i>
                        </li>
                        <li class="list-group-item">Torque: {{ detalle[0].torque }} NM</li>
                        <li class="list-group-item">CV: {{ detalle[0].cv }}cv</li>
                        <li class="list-group-item">Cambio: {{ detalle[0].cambio }}</li>
                        <li class="list-group-item">Combustible: {{ detalle[0].combustible }}</li>
                        <li class="list-group-item">Par Medio: {{ detalle[0].par_medio }}</li>
                        <li class="list-group-item">Par Máximo: {{ detalle[0].par_maximo }}</li>
                    </div>
                    <!-- Estadísticas Section -->
                    <div class="section mb-4">
                        <li class="list-group-item bg-secondary text-white d-flex align-items-center">
                            <strong>Estadísticas</strong>
                            <i class="fas fa-tachometer-alt ms-2"></i>
                        </li>
                        <li class="list-group-item">Velocidad Máxima: {{ detalle[0].vm }} km/h</li>
                        <li class="list-group-item">0-100: {{ detalle[0].cien }} segundos</li>
                    </div>
                    <!-- Chasis Section -->
                    <div class="section mb-4">
                        <li class="list-group-item bg-secondary text-white d-flex align-items-center">
                            <strong>Chasis</strong>
                            <i class="fas fa-car ms-2"></i>
                        </li>
                        <li class="list-group-item">Dimensiones Neumáticos: {{ detalle[0].neumaticos }}</li>
                        <li class="list-group-item">Frenos Delanteros: {{ detalle[0].frenos_del }}</li>
                        <li class="list-group-item">Frenos Traseros: {{ detalle[0].frenos_tras }}</li>
                    </div>
                    <!-- Mantenimientos Section -->
                    <div class="section">
                        <li class="list-group-item bg-secondary text-white d-flex align-items-center">
                            <strong>Mantenimientos</strong>
                            <i class="fas fa-tools ms-2"></i>
                        </li>
                        <li class="list-group-item">Próximo Cambio de Aceite: {{ detalle[0].proximo_c_aceite }} KM</li>
                    </div>
                </ul>
            </div>
        </div>
    </div>

</template>



<script>
export default {
    data() {
        return {
            brands: [],
            models: [],
            motorizations: [],
            codes: [],
            selectedBrand: '',
            selectedModel: '',
            selectedMotorization: '',
            selectedCode: '',
            detalle: null
        };
    },
    mounted() {
        this.getBrands();
    },
    methods: {
        async getBrands() {
            try {
                const response = await fetch('/api/v1/brands');
                const data = await response.json();
                this.brands = data;
            } catch (error) {
                console.error('Error fetching brands:', error);
            }
        },
        async getModels() {
            if (!this.selectedBrand) return;
            try {
                const response = await fetch(`/api/v1/models/${this.selectedBrand}`);
                const data = await response.json();
                this.models = data;
            } catch (error) {
                console.error('Error fetching models:', error);
            }
        },
        async getMotorizations() {
            if (!this.selectedModel) return;
            try {
                const response = await fetch(`/api/v1/motorization/${this.selectedModel}`);
                const data = await response.json();
                this.motorizations = data;
            } catch (error) {
                console.error('Error fetching motorizations:', error);
            }
        },
        async getCodes() {
            if (!this.selectedMotorization) return;
            try {
                const response = await fetch(`/api/v1/cp/${this.selectedMotorization}`);
                const data = await response.json();
                this.codes = data;
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        },
        async getDetalle() {
            try {
                const response = await fetch(`/api/v1/detalles/${this.selectedBrand}/${this.selectedModel}/${this.selectedMotorization}/${this.selectedCode}`);
                const data = await response.json();
                this.detalle = data;
            } catch (error) {
                console.error('Error fetching detalle:', error);
            }
        },
        async onBrandChange() {
            this.selectedModel = '';
            this.selectedMotorization = '';
            this.selectedCode = '';
            this.models = [];
            this.motorizations = [];
            this.codes = [];
            await this.getModels();
        },

        async onModelChange() {
            this.selectedMotorization = '';
            this.selectedCode = '';
            await this.getMotorizations();
        },
        async onMotorizationChange() {
            this.selectedCode = '';
            await this.getCodes();
        },


    },
    watch: {
        selectedCode: {
            handler() {
                if (this.selectedBrand && this.selectedModel && this.selectedMotorization && this.selectedCode) {
                    this.getDetalle();
                }
            },
            immediate: false
        }
    }

};
</script>
