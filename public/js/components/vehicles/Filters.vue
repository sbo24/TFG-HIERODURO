<template>
    <div class="container mt-5">

        <div class="row mb-4">
            <!-- Selector de marcas -->
            <div class="col-md-3">
                <div class="custom-select-wrapper">
                    <select v-model="selectedBrand" @change="onBrandChange" class="custom-select">
                        <option value="">Selecciona una marca</option>
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de modelos -->
            <div class="col-md-3" v-if="selectedBrand">
                <div class="custom-select-wrapper">
                    <select v-model="selectedModel" @change="onModelChange" class="custom-select">
                        <option value="">Selecciona el modelo</option>
                        <option v-for="model in models" :key="model.id" :value="model.id">{{ model.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de motorizaciones -->
            <div class="col-md-3" v-if="selectedModel">
                <div class="custom-select-wrapper">
                    <select v-model="selectedMotorization" @change="onMotorizationChange" class="custom-select">
                        <option value="">Selecciona la motorización</option>
                        <option v-for="motorization in motorizations" :key="motorization.id" :value="motorization.id">{{
                            motorization.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de códigos -->
            <div class="col-md-3" v-if="selectedMotorization">
                <div class="custom-select-wrapper">
                    <select v-model="selectedCode" class="custom-select">
                        <option value="">Selecciona el código</option>
                        <option v-for="code in codes" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="card" v-if="detalle">
            <div class="card-body advanced-design">
                
                <!-- Motor Section -->
                <div class="section motor mb-3">
                    <h6 class="section-header">Motor <i class="fas fa-cogs"></i></h6>
                    <ul class="details-list">
                        <li class="details-item">
                            Torque: <span class="details-value torque">{{ detalle[0].torque }} NM</span>
                        </li>
                        <li class="details-item">
                            CV: <span class="details-value cv">{{ detalle[0].cv }}cv</span>
                        </li>
                        <!-- More motor details -->
                    </ul>
                </div>
                <!-- Estadísticas Section -->
                <div class="section statistics mb-3">
                    <h6 class="section-header">Estadísticas <i class="fas fa-tachometer-alt"></i></h6>
                    <ul class="details-list">
                        <li class="details-item">
                            Velocidad Máxima: <span class="details-value max-speed">{{ detalle[0].vm }} km/h</span>
                        </li>
                        <li class="details-item">
                            0-100: <span class="details-value acceleration">{{ detalle[0].cien }} segundos</span>
                        </li>
                        <!-- More statistics details -->
                    </ul>
                </div>
                <!-- Chasis Section -->
                <div class="section chassis mb-3">
                    <h6 class="section-header">Chasis <i class="fas fa-car"></i></h6>
                    <ul class="details-list">
                        <li class="details-item">
                            Dimensiones Neumáticos: <span class="details-value tires">{{ detalle[0].neumaticos }}</span>
                        </li>
                        <!-- More chasis details -->
                    </ul>
                </div>
                <!-- Mantenimientos Section -->
                <div class="section maintenance">
                    <h6 class="section-header">Mantenimientos <i class="fas fa-tools"></i></h6>
                    <ul class="details-list">
                        <li class="details-item">
                            Próximo Cambio de Aceite: <span class="details-value oil-change">{{
                                detalle[0].proximo_c_aceite }} KM</span>
                        </li>
                        <!-- More maintenance details -->
                    </ul>
                </div>
            </div>


        </div>


    </div>

</template>

<style>
.custom-select-wrapper {
    position: relative;
    display: block;
    width: 100%;
    margin-bottom: 1rem;
    overflow: hidden;
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.custom-select {
    display: block;
    width: 100%;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #000000;
    background-color: #ffffff;
   
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
}

.custom-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Estilos para cuando el selector está deshabilitado */
.custom-select:disabled {
    background-color: #e9ecef;
    opacity: 0.5;
}

/* Animación al pasar el ratón */

.advanced-design {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    padding: 20px;
    color: #333;
}

.section-header {
    background: #333;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.details-list {
    list-style: none;
    padding: 0;
}

.details-item {
    background-color: #fff;
    margin-bottom: 10px;
    padding: 15px;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.details-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.details-value {
    font-weight: 600;
    padding: 5px 15px;
    border-radius: 15px;
    transition: background-color 0.3s ease;
}

.torque {
    background-color: #007bff;
}

.cv {
    background-color: #28a745;
}

.max-speed {
    background-color: #dc3545;
}

.acceleration {
    background-color: #ffc107;
}

.tires {
    background-color: #17a2b8;
}

.oil-change {
    background-color: #fd7e14;
}

.details-value:hover {
    background-color: #333;
    color: #fff;
}
</style>


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
