<template>
    <div class="container mt-5">
        <!-- Sección de selección del primer vehículo -->
        <div class="row mb-4">
            <!-- Selector de marcas del primer vehículo -->
            <div class="col-md-3">
                <div class="custom-select-wrapper">
                    <select v-model="selectedBrand1" @change="onBrandChange(1)" class="custom-select">
                        <option value="">Selecciona una marca</option>
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de modelos del primer vehículo -->
            <div class="col-md-3" v-if="selectedBrand1">
                <div class="custom-select-wrapper">
                    <select v-model="selectedModel1" @change="onModelChange(1)" class="custom-select">
                        <option value="">Selecciona un modelo</option>
                        <option v-for="model in models1" :key="model.id" :value="model.id">{{ model.nombre }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Selector de motorizaciones del primer vehículo -->
            <div class="col-md-3" v-if="selectedModel1">
                <div class="custom-select-wrapper">
                    <select v-model="selectedMotorization1" @change="onMotorizationChange(1)" class="custom-select">
                        <option value="">Selecciona una motorizacion</option>
                        <option v-for="motorization in motorizations1" :key="motorization.id" :value="motorization.id">
                            {{
                            motorization.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de códigos del primer vehículo -->
            <div class="col-md-3" v-if="selectedMotorization1">
                <div class="custom-select-wrapper">
                    <select v-model="selectedCode1" class="custom-select">
                        <option value="">Selecciona un codigo</option>
                        <option v-for="code in codes1" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Sección de selección del segundo vehículo -->
        <div class="row mb-4">
            <!-- Selector de marcas del segundo vehículo -->
            <div class="col-md-3">
                <div class="custom-select-wrapper">
                    <select v-model="selectedBrand2" @change="onBrandChange(2)" class="custom-select">
                        <option value="">Selecciona una marca</option>
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de modelos del segundo vehículo -->
            <div class="col-md-3" v-if="selectedBrand2">
                <div class="custom-select-wrapper">
                    <select v-model="selectedModel2" @change="onModelChange(2)" class="custom-select">
                        <option value="">Selecciona un modelo</option>
                        <option v-for="model in models2" :key="model.id" :value="model.id">{{ model.nombre }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Selector de motorizaciones del segundo vehículo -->
            <div class="col-md-3" v-if="selectedModel2">
                <div class="custom-select-wrapper">
                    <select v-model="selectedMotorization2" @change="onMotorizationChange(2)" class="custom-select">
                        <option value="">Selecciona una motorizacion</option>
                        <option v-for="motorization in motorizations2" :key="motorization.id" :value="motorization.id">
                            {{
                            motorization.nombre }}</option>
                    </select>
                </div>
            </div>

            <!-- Selector de códigos del segundo vehículo -->
            <div class="col-md-3" v-if="selectedMotorization2">
                <div class="custom-select-wrapper">
                    <select v-model="selectedCode2" class="custom-select">
                        <option value="">Selecciona un codigo</option>
                        <option v-for="code in codes2" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabla de comparación -->
        <div class="card" v-if="detalle1 && detalle2">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Primer vehiculo</th>
                            <th>Segundo vehiculo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Motor section -->
                        <tr v-if="detalle1 && detalle2">
                            <td>Motor</td>
                            <td
                                :class="{ 'text-success': motor1Wins > motor2Wins, 'text-danger': motor1Wins < motor2Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].torque > detalle2[0].torque, 'text-danger': detalle1[0].torque < detalle2[0].torque }">
                                        Torque: {{ detalle1[0].torque }} NM
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].cv > detalle2[0].cv, 'text-danger': detalle1[0].cv < detalle2[0].cv }">
                                        CV: {{ detalle1[0].cv }} cv
                                    </li>
                                    <li class="list-group-item">
                                        Cambio: {{ detalle1[0].cambio }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].combustible > detalle2[0].combustible, 'text-danger': detalle1[0].combustible < detalle2[0].combustible }">
                                        Combustible: {{ detalle1[0].combustible }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].par_medio > detalle2[0].par_medio, 'text-danger': detalle1[0].par_medio < detalle2[0].par_medio }">
                                        Par Medio: {{ detalle1[0].par_medio }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].par_maximo > detalle2[0].par_maximo, 'text-danger': detalle1[0].par_maximo < detalle2[0].par_maximo }">
                                        Par Maximo: {{ detalle1[0].par_maximo }}
                                    </li>
                                </ul>
                            </td>
                            <td
                                :class="{ 'text-success': motor2Wins > motor1Wins, 'text-danger': motor2Wins < motor1Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].torque > detalle1[0].torque, 'text-danger': detalle2[0].torque < detalle1[0].torque }">
                                        Torque: {{ detalle2[0].torque }} NM
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].cv > detalle1[0].cv, 'text-danger': detalle2[0].cv < detalle1[0].cv }">
                                        CV: {{ detalle2[0].cv }} cv
                                    </li>
                                    <li class="list-group-item">
                                        Cambio: {{ detalle2[0].cambio }}
                                    </li>
                                    <li class="list-group-item">
                                        Combustible: {{ detalle2[0].combustible }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].par_medio > detalle1[0].par_medio, 'text-danger': detalle2[0].par_medio < detalle1[0].par_medio }">
                                        Par Medio: {{ detalle2[0].par_medio }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].par_maximo > detalle1[0].par_maximo, 'text-danger': detalle2[0].par_maximo < detalle1[0].par_maximo }">
                                        Par Maximo: {{ detalle2[0].par_maximo }}
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <!-- Estadisticas section -->
                        <tr v-if="detalle1 && detalle2">
                            <td>Estadisticas</td>
                            <td
                                :class="{ 'text-success': estadisticas1Wins > estadisticas2Wins, 'text-danger': estadisticas1Wins < estadisticas2Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].vm > detalle2[0].vm, 'text-danger': detalle1[0].vm < detalle2[0].vm }">
                                        Velocidad Maxima: {{ detalle1[0].vm }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].cien < detalle2[0].cien, 'text-danger': detalle1[0].cien > detalle2[0].cien }">
                                        0-100: {{ detalle1[0].cien }}
                                    </li>
                                </ul>
                            </td>
                            <td
                                :class="{ 'text-success': estadisticas2Wins > estadisticas1Wins, 'text-danger': estadisticas2Wins < estadisticas1Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].vm > detalle1[0].vm, 'text-danger': detalle2[0].vm < detalle1[0].vm }">
                                        Velocidad Maxima: {{ detalle2[0].vm }}
                                    </li>
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].cien < detalle1[0].cien, 'text-danger': detalle2[0].cien > detalle1[0].cien }">
                                        0-100: {{ detalle2[0].cien }}
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <!-- Chasis section -->
                        <tr v-if="detalle1 && detalle2">
                            <td>Chasis</td>
                            <td
                                :class="{ 'text-success': chasis1Wins > chasis2Wins, 'text-danger': chasis1Wins < chasis2Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Dimensiones Neumaticos: {{
                                        detalle1[0].neumaticos }}
                                    </li>
                                    <li class="list-group-item">Frenos Delanteros: {{ detalle1[0].frenos_del }}
                                    </li>
                                    <li class="list-group-item">Frenos Traseros: {{ detalle1[0].frenos_tras }}
                                    </li>
                                </ul>
                            </td>
                            <td
                                :class="{ 'text-success': chasis2Wins > chasis1Wins, 'text-danger': chasis2Wins < chasis1Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Dimensiones Neumaticos: {{
                                        detalle2[0].neumaticos }}
                                    </li>
                                    <li class="list-group-item">Frenos Delanteros: {{ detalle2[0].frenos_del }}
                                    </li>
                                    <li class="list-group-item">Frenos Traseros: {{ detalle2[0].frenos_tras }}
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <!-- Mantenimientos section -->
                        <tr v-if="detalle1 && detalle2">
                            <td>Mantenimientos</td>
                            <td
                                :class="{ 'text-success': mantenimientos1Wins > mantenimientos2Wins, 'text-danger': mantenimientos1Wins < mantenimientos2Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle1[0].proximo_c_aceite > detalle2[0].proximo_c_aceite, 'text-danger': detalle1[0].proximo_c_aceite < detalle2[0].proximo_c_aceite }">
                                        Cambio de Aceite: {{ detalle1[0].proximo_c_aceite }} KM
                                    </li>
                                </ul>
                            </td>
                            <td
                                :class="{ 'text-success': mantenimientos2Wins > mantenimientos1Wins, 'text-danger': mantenimientos2Wins < mantenimientos1Wins }">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        :class="{ 'text-success': detalle2[0].proximo_c_aceite > detalle1[0].proximo_c_aceite, 'text-danger': detalle2[0].proximo_c_aceite < detalle1[0].proximo_c_aceite }">
                                        Cambio de Aceite: {{ detalle2[0].proximo_c_aceite }} KM
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>

                </table>


            </div>
        </div>
        <div>

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

.fw-bold {
    font-weight: bold;
}

.text-success {
    color: green;
}

.text-danger {
    color: red;
}

/* Estilos para la tabla */
.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 0.25rem;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.table td,
.table th {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
    text-align: left;
}

.table thead th {
    border-bottom: 2px solid #dee2e6;
}

/* Estilos para la lista de grupo */
.list-group {
    margin-bottom: 0;
    border-radius: 0.25rem;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.list-group-item {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.list-group-item:last-child {
    border-bottom: none;
}

.list-group-item span {
    font-weight: bold;
}
</style>

<!-- Aquí va tu tabla HTML -->



<script>



export default {
    data() {
        return {
            brands: [],
            models1: [],
            models2: [],
            motorizations1: [],
            motorizations2: [],
            codes1: [],
            codes2: [],
            selectedBrand1: '',
            selectedBrand2: '',
            selectedModel1: '',
            selectedModel2: '',
            selectedMotorization1: '',
            selectedMotorization2: '',
            selectedCode1: '',
            selectedCode2: '',
            detalle1: null,
            detalle2: null
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
        async getModels(brand, index) {
            try {
                const response = await fetch(`/api/v1/models/${brand}`);
                const data = await response.json();
                if (index === 1) {
                    this.models1 = data;
                } else if (index === 2) {
                    this.models2 = data;
                }
            } catch (error) {
                console.error('Error fetching models:', error);
            }
        },
        async getMotorizations(model, index) {
            try {
                const response = await fetch(`/api/v1/motorization/${model}`);
                const data = await response.json();
                if (index === 1) {
                    this.motorizations1 = data;
                } else if (index === 2) {
                    this.motorizations2 = data;
                }
            } catch (error) {
                console.error('Error fetching motorizations:', error);
            }
        },
        async getCodes(motorization, index) {
            try {
                const response = await fetch(`/api/v1/cp/${motorization}`);
                const data = await response.json();
                if (index === 1) {
                    this.codes1 = data;
                } else if (index === 2) {
                    this.codes2 = data;
                }
            } catch (error) {
                console.error('Error fetching codes:', error);
            }
        },
        async getDetalle(brand, model, motorization, code, index) {
            try {
                const response = await fetch(`/api/v1/detalles/${brand}/${model}/${motorization}/${code}`);
                const data = await response.json();
                if (index === 1) {
                    this.detalle1 = data;
                } else if (index === 2) {
                    this.detalle2 = data;
                }
            } catch (error) {
                console.error('Error fetching detalle:', error);
            }
        },
        async onBrandChange(index) {
            if (index === 1) {
                this.selectedModel1 = '';
                this.selectedMotorization1 = '';
                this.selectedCode1 = '';
                this.models1 = [];
                this.motorizations1 = [];
                this.codes1 = [];
            } else if (index === 2) {
                this.selectedModel2 = '';
                this.selectedMotorization2 = '';
                this.selectedCode2 = '';
                this.models2 = [];
                this.motorizations2 = [];
                this.codes2 = [];
            }
            await this.getModels(this['selectedBrand' + index], index);
        },
        async onModelChange(index) {
            if (index === 1) {
                this.selectedMotorization1 = '';
                this.selectedCode1 = '';
            } else if (index === 2) {
                this.selectedMotorization2 = '';
                this.selectedCode2 = '';
            }
            await this.getMotorizations(this['selectedModel' + index], index);
        },
        async onMotorizationChange(index) {
            if (index === 1) {
                this.selectedCode1 = '';
            } else if (index === 2) {
                this.selectedCode2 = '';
            }
            await this.getCodes(this['selectedMotorization' + index], index);
        },
        async onCodeChange(index) {
            if (this['selectedBrand' + index] && this['selectedModel' + index] && this['selectedMotorization' + index] && this['selectedCode' + index]) {
                await this.getDetalle(this['selectedBrand' + index], this['selectedModel' + index], this['selectedMotorization' + index], this['selectedCode' + index], index);
            }
        }
    },
    watch: {
        selectedCode1: {
            handler() {
                if (this.selectedBrand1 && this.selectedModel1 && this.selectedMotorization1 && this.selectedCode1) {
                    this.getDetalle(this.selectedBrand1, this.selectedModel1, this.selectedMotorization1, this.selectedCode1, 1);
                }
            },
            immediate: false
        },
        selectedCode2: {
            handler() {
                if (this.selectedBrand2 && this.selectedModel2 && this.selectedMotorization2 && this.selectedCode2) {
                    this.getDetalle(this.selectedBrand2, this.selectedModel2, this.selectedMotorization2, this.selectedCode2, 2);
                }
            },
            immediate: false
        }
    }
};
</script>
