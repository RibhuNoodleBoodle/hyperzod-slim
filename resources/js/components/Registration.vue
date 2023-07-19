<template>
    <div>
      <h1>Registration</h1>
      <form @submit.prevent="register">
        <input type="text" v-model="name" placeholder="Name" required>
        <input type="email" v-model="email" placeholder="Email" required>
        <input type="password" v-model="password" placeholder="Password" required>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: "",
        email: "",
        password: "",
      };
    },
    methods: {
      register() {
        // Implement registration logic using Axios to make an API request to the backend
        // You will need to define the API endpoint on the backend to handle the registration request
      },
    },
  };
  </script>
  