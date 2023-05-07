<template>

    <div class="card" align="left">
            <div class="card-header">Register Form</div>
            <div class="card-body"> 
            
                <form  @submit.prevent="saveData">
                
                <label>First Name</label>
                <input type="text" v-model="student.name" name="name" id="name" class ="form-control"/> 
    
          
                <label>Email</label>
                <input type="email" v-model="student.email" name="email" id="email" class ="form-control"/>
    
                <label>Password</label>
                <input type="password" v-model="student.password" name="password" id="password" class ="form-control"/> 
    
    
                <input type="submit" value="Save" class="btn btn-success"> 
    
    
                </form>
            </div>
        </div>
    </template>
       
       <script>
           import Vue from 'vue';
           import axios from 'axios';
           Vue.use(axios)

         export default {
           name: 'Register',
           data () {
             return {
               result: {},
               student:{
                          name: '',
                          email: '',
                          password: ''
               }
             }
           },
           created() { 
           },
           mounted() {
                 console.log("mounted() called.......");
             },
           methods: {
                  saveData()
                  {
                   axios.post("http://127.0.0.1:8000/api/register", this.student)
                   .then(
                     ({data})=>{
                      console.log(data);
                       try 
                         {
                            alert("saveddddd");
                            
                          } 
                      catch(err) 
                          {
                            alert("failed");
                          }    
                     }
                   )
                  }
             }
         }
         </script>