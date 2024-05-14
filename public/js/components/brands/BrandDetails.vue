<template>
    <div class="brand-details">
        <h1>Modelos de la marca {{ brandName }}</h1>
        <ul>
            <li v-for="modelo in modelos" :key="modelo.id">
                {{ modelo.nombre }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            models: [],
            marca: ''
        };
    },
    mounted() {
        this.marca = this.$route.params.marca;
        this.getModelsByBrand();
    },
    methods: {
        async getModelsByBrand() {
            try {
                const response = await fetch(`/api/v1/models/${this.marca}`);
                const data = await response.json();
                this.models = data;
            } catch (error) {
                console.error('Error fetching models:', error);
            }
        }
    }
};
</script>

<style scoped>
.brand-details {
    padding: 20px;
}
</style>
