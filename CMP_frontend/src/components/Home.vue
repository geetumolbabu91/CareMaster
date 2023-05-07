<template>
  <div class="homepage">
    <div class="topnav">
  <a class="active" href="#home">Home</a>
  <div class="topnav-right">
    <a href="#logout" @click="logout">LogOut</a>
  </div>
</div>
  <div>
    <span>Token: {{ token }}</span>

  </div>
  </div>
</template>
<script>
import Vue from 'vue'
import axios from 'axios'

Vue.use(axios)
export default {
  name: 'Home',
  data () {
    return {
      token: ''
    }
  },
  created () {
  },
  mounted () {
    if (localStorage.getItem('APP_DEMO_USER_TOKEN') === null) {
      this.$router.push({ name: 'Login' })
    } else {
      this.token = localStorage.getItem('APP_DEMO_USER_TOKEN')
    }
  },
  methods: {
    logout () {
      axios
        .get('http://127.0.0.1/api/loggingout', {
          headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.token}`
            }
        })
        .then((response) => {
          localStorage.removeItem('APP_DEMO_USER_TOKEN')
          this.$router.push({ name: 'Login' })
        })
        .catch((error) => console.log(error))
    }
  }
}
</script>
<style scoped src="../assets/cmp.css">
