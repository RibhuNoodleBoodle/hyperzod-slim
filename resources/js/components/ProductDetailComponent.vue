<template>
    <div class="product-detail">
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>{{ product.price }}</p>
        <button v-on:click="addToCart(product)">Add to Cart</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            product: {},
        };
    },
    methods: {
        getProduct() {
            const id = this.$route.params.id;
            axios.get(`/api/products/${id}`)
                .then(response => {
                    this.product = response.data;
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
        this.getProduct();
    },
};
</script>

<style scoped>
/* Add your CSS styling here */
</style>
