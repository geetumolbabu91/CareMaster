<!-- <template>
    <div class="row">
        <div class="col-sm-4" >
            <h2 align="center"> Login</h2>
            <form @submit.prevent="LoginData">
            <div class="form-group" align="left">
                <label>Email</label>
                <input type="email" v-model="admin.email" class="form-control"  placeholder="Email" required>
            </div>
            <div class="form-group" align="left">
                <label>Password</label>
                <input type="password" v-model="admin.password" class="form-control"  placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    
</template> -->

<template>
    <form name="login-form" @submit.prevent="LoginData" >
      <div class="mb-3">
        <label for="username">Username: </label>
        <input type="email" v-model="admin.email" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <label for="password">Password: </label>
        <input type="password" v-model="admin.password" placeholder="Password" required>
      </div>
      <button class="btn btn-outline-dark" type="submit">
        Login
      </button>
    </form>
</template>
  
<script>
/* eslint-disable */
/*eslint no-trailing-spaces: ["error", { "skipBlankLines": true }]*/

import Vue from 'vue'
import axios from 'axios'

Vue.use(axios)
export default {
name: 'Login',
data () {
    return {
    result: {},
    admin: {
                email: '',
                password: ''
    }
    }
},
created () { 

},
methods: {

        LoginData()
        {
        axios.get('http://127.0.0.1/sanctum/csrf-cookie').then(response => {
            axios.post('http://127.0.0.1/api/login', this.admin)
            .then(
                ({data}) => {
                console.log(data)
                try {
                if (data.status === true) {
                    localStorage.setItem('APP_DEMO_USER_TOKEN', data.token)
                    this.$router.push({ name: 'Home' })
                    } else {
                    alert(data.message)
                    }
                    } catch (err) {
                    alert('Error, please try again')
                    }    
                }
            )
            })
        }
    }
}
</script>
