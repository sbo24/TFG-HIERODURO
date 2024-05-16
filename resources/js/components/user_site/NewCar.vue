<template>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-3">
                <select v-model="selectedBrand" @change="onBrandChange" class="form-select">
                    <option value="">Select a brand</option>
                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
                </select>
            </div>

            <div class="col-md-3" v-if="selectedBrand">
                <select v-model="selectedModel" @change="onModelChange" class="form-select">
                    <option value="">Select a model</option>
                    <option v-for="model in models" :key="model.id" :value="model.id">{{ model.nombre }}</option>
                </select>
            </div>

            <div class="col-md-3" v-if="selectedModel">
                <select v-model="selectedMotorization" @change="onMotorizationChange" class="form-select">
                    <option value="">Select a motorization</option>
                    <option v-for="motorization in motorizations" :key="motorization.id" :value="motorization.id">{{
                    motorization.nombre }}</option>
                </select>
            </div>

            <div class="col-md-3" v-if="selectedMotorization">
                <select v-model="selectedCode" class="form-select">
                    <option value="">Select a code</option>
                    <option v-for="code in codes" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                </select>
            </div>
        </div>

        <div v-if="selectedRowId" class="row mt-4">
            <div class="col-md-12">
                <p>ID de la fila seleccionada: {{ selectedRowId }}</p>
                <button @click="addPrivateVehicle" class="btn btn-primary">Agregar a mis vehículos</button>
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
            detalle: null,
            selectedRowId: null,
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
                if (data && data.length > 0) {
                    this.detalle = data[0];
                    this.selectedRowId = data[0].id;
                } else {
                    console.error('ID not found in the response');
                }
            } catch (error) {
                console.error('Error fetching detalle:', error);
            }
        },
        async addPrivateVehicle() {
            if (!this.selectedRowId) {
                console.error('No selectedRowId available');
                return;
            }

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/api/v1/privatevehicles/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    },
                    body: JSON.stringify({ details_id: this.selectedRowId })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Error al agregar el vehículo');
                }

                const responseData = await response.json();
                console.log('Vehículo agregado:', responseData);
                alert('Vehículo agregado exitosamente');
            } catch (error) {
                console.error('Error al agregar el vehículo:', error);
                alert('Error al agregar el vehículo');
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
