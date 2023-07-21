<template>
  <div class="flex flex-col items-center mt-20">
    <h1 class="text-3xl font-bold mb-4">Login</h1>
    <form @submit.prevent="login" class="flex flex-col space-y-2">
      <input type="email" v-model="email" placeholder="Email" required class="p-2 rounded-md border border-gray-300">
      <input type="password" v-model="password" placeholder="Password" required class="p-2 rounded-md border border-gray-300">
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Login</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {

  methods: {
    login() {
      axios
        .post("/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          // Handle successful login
          console.log("Logged in successfully!");
          // You can redirect the user to a dashboard or other authenticated pages here
        })
        .catch((error) => {
          // Handle login error
          console.error("Login error:", error.response.data.message);
        });
    },
  },
};
</script>
