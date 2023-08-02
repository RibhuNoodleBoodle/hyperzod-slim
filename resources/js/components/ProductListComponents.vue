<template>
    <div class="product-list">
        <div class="product" v-for="product in products" :key="product.id">
            <h2>{{ product.name }}</h2>
            <p>{{ product.description }}</p>
            <p>{{ product.price }}</p>
            <button v-on:click="addToCart(product)">Add to Cart</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
        };
    },
    methods: {
        getProducts() {
            axios.get('/api/products')  // Modify this URL to match your API endpoint
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        addToCart(product) {
            // Add product to cart
        }
    },
    mounted() {
        this.getProducts();
    },
};
</script>

<style scoped>
/* Add your CSS styling here */
</style>
