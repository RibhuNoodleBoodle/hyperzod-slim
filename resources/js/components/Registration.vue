<template>
  <!-- ... Your existing template ... -->
</template>

<script>
import axios from "axios";

export default {
  // ... Your existing code ...

  methods: {
    register() {
      axios
        .post("/api/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
        .then((response) => {
          // Handle successful registration
          console.log("Registered successfully!");
          // You can redirect the user to the login page or any other page here
        })
        .catch((error) => {
          // Handle registration error
          console.error("Registration error:", error.response.data.errors);
        });
    },
  },
};
</script>
