<template>
    <div class="container mt-5">
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#modalId">
           ¿Quieres añadir un nuevo vehiculo?
        </button>

        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="brandSelect" class="form-label">Marca:</label>
                            <select id="brandSelect" v-model="selectedBrand" @change="onBrandChange"
                                class="form-select">
                                <option value="">Selecciona una marca</option>
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3" v-if="selectedBrand">
                            <label for="modelSelect" class="form-label">Modelo:</label>
                            <select id="modelSelect" v-model="selectedModel" @change="onModelChange"
                                class="form-select">
                                <option value="">Selecciona un modelo</option>
                                <option v-for="model in models" :key="model.id" :value="model.id">{{ model.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3" v-if="selectedModel">
                            <label for="motorizationSelect" class="form-label">Motorización:</label>
                            <select id="motorizationSelect" v-model="selectedMotorization"
                                @change="onMotorizationChange" class="form-select">
                                <option value="">Selecciona una motorización</option>
                                <option v-for="motorization in motorizations" :key="motorization.id"
                                    :value="motorization.id">{{ motorization.nombre }}</option>
                            </select>
                        </div>
                        <div class="mb-3" v-if="selectedMotorization">
                            <label for="codeSelect" class="form-label">Código:</label>
                            <select id="codeSelect" v-model="selectedCode" class="form-select">
                                <option value="">Selecciona un código</option>
                                <option v-for="code in codes" :key="code.id" :value="code.id">{{ code.codigo }}</option>
                            </select>
                        </div>
                        <div v-if="selectedRowId" class="row mt-4">
                            <div class="col-md-12">
                                <button @click="addPrivateVehicle" class="btn btn-primary btn-block">Agregar a mis
                                    vehículos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

.btn-custom {
    background: black;
    border: none;
    color: white;
    padding: 15px 30px;
    font-size: 18px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.btn-custom:hover {
  color: white;
    background: rgba(0, 0, 0, 0.778);
}

.modal-content {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    animation: modalFadeIn 0.4s;
}

.modal-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    border-bottom: none;
    padding: 1rem 1.5rem;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.modal-header .btn-close {
    background: white;
    border-radius: 50%;
    padding: 5px;
}

.modal-body {
    padding: 2rem 2.5rem;
    background: #f4f4f9;
}

.modal-body .form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 0.5rem;
}

.modal-body .form-select {
    font-size: 16px;
    padding: 0.75rem;
    border-radius: 8px;
    border: 1px solid #ddd;
    transition: border-color 0.3s;
}

.modal-body .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.modal-footer {
    background: #f1f1f1;
    border-top: none;
    padding: 1rem 1.5rem;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    transition: background 0.3s, transform 0.3s;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004090 100%);
    transform: scale(1.1);
}

.btn-primary:active {
    transform: scale(0.9);
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

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
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
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
                toastr.success('Vehículo agregado exitosamente');
                setTimeout(() => {
                    location.reload();
                }, 2000); 
            } catch (error) {
                console.error('Error al agregar el vehículo:', error);
                toastr.error('Error al agregar el vehículo');
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
        initializeModal() {
            new bootstrap.Modal(document.getElementById("modalId"), {});
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