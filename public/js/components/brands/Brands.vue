<template>
    <div class="brand-list">
        <div class="row">
            <div class="col-md-3 col-6" v-for="brand in brands" :key="brand.id">
                <router-link :to="'/marca/' + brand.nombre">
                    <div class="brand-item">
                        <img :src="`/img/Brands/${brand.nombre}.png`" :alt="brand.nombre" class="brand-logo">
                        <span class="brand-name">{{ brand.nombre }}</span>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>
<style scoped>
.brand-list {
  padding: 20px; /* Espaciado interior */
}

.brand-item {
  text-align: center;
  margin-bottom: 20px;
}

.brand-logo {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-bottom: 10px;
}

.brand-name {
  display: block; /* Hacer que el nombre esté en una línea separada */
}
</style>


<script>
export default {
    data() {
        return {
            brands: []
        };
    },
    mounted() {
        this.getAllBrands();
    },
    methods: {
        async getAllBrands() {
            try {
                const response = await fetch('/api/v1/brands');
                const data = await response.json();
                this.brands = data;
            } catch (error) {
                console.error('Error fetching brands:', error);
            }
        }
    }
};
</script>

