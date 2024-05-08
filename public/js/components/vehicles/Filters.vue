<template>
  <div>
    <select v-model="selectedBrand" @change="getModels">
      <option value="">Select a brand</option>
      <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.nombre }}</option>
    </select>
    
    <select v-model="selectedModel" v-if="selectedBrand" @change="getMotorizations">
      <option value="">Select a model</option>
      <option v-for="model in models" :key="model.id" :value="model.id">{{ model.nombre }}</option>
    </select>
    
    <select v-model="selectedMotorization" v-if="selectedModel" @change="getCodes">
      <option value="">Select a motorization</option>
      <option v-for="motorization in motorizations" :key="motorization.id" :value="motorization.id">{{ motorization.nombre }}</option>
    </select>
    
    <select v-model="selectedCode" v-if="selectedMotorization">
      <option value="">Select a code</option>
      <option v-for="code in codes" :key="code.id" :value="code.id">{{ code.codigo }}</option>
    </select>
    
   
 <div class="card" v-if="detalle">
      <div class="card-header">
        <h5 class="card-title">{{ detalle.descripcion }}</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Torque: {{ detalle.torque }}</li>
          <li class="list-group-item">CV: {{ detalle.cv }}</li>
          <li class="list-group-item">Cambio: {{ detalle.cambio }}</li>
          <li class="list-group-item">Combustible: {{ detalle.combustible }}</li>
          <li class="list-group-item">Próximo cambio de aceite: {{ detalle.proximo_c_aceite }}</li>
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
    }
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
