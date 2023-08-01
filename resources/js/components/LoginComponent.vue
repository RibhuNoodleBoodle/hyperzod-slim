<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="loginUser">
      <div>
        <label>Email</label>
        <input type="email" v-model="form.email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" v-model="form.password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    loginUser() {
      axios.post('/login', this.form)
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
