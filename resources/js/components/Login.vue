<template>
  <!-- ... Your existing template ... -->
</template>

<script>
import axios from "axios";

export default {
  // ... Your existing code ...

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
