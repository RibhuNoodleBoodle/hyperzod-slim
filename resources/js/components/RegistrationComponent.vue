<template>
  <div>
    <h2>Register</h2>
    <form @submit.prevent="registerUser">
      <div>
        <label>Name</label>
        <input type="text" v-model="form.name" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" v-model="form.email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" v-model="form.password" required>
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" v-model="form.password_confirmation" required>
      </div>
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    };
  },
  methods: {
    registerUser() {
      axios.post('/register', this.form)
        .then(response => {
          console.log(response);
          // redirect to home page or dashboard
          this.$router.push('/home');
        })
        .catch(error => {
          console.log(error);
          // handle error
        });
    },
  },
};
</script>
