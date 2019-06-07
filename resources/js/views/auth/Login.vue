<template>
  <div>
    <div class="flex-center position-ref full-height">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-4">
          <div id="logo-container" class="text-white text-center mb-3">WELLCOME</div>
          <div class="col-md-12 col-md-offset-1 p-0">
            <form @submit.prevent="authenticate()">
              <div class="form-group">
                <input class="form-control" type="text" name='email' placeholder="email" v-model="form.email"/>
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name='password' placeholder="password" v-model="form.password"/>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> I agree to the <a href="#" class="btn-link">Terms and Conditions</a>
                </label>
              </div>
              <div class="form-group">
                <div v-if="authError">
                  <p>{{ authError }}</p>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-outline-info btn-block">Login</button>
                <a class="btn btn-outline-success btn-block register">Register</a>
              </div>
              <div class="form-group text-center">
                <a href="#" class="btn-link">Forgot Password</a>&nbsp;|&nbsp;<a href="#">Support</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</template>
<script>
  import {login} from "../../helpers/auth";
  export default {
    data(){
      return {
        form : {
          email: '',
          password : ''
        }
      }
    },
    methods:{
      authenticate(){
        this.$store.dispatch('login');
        login(this.$data.form)
            .then((response) =>{
              this.$store.commit('loginSuccess', response);
              this.$router.push({path: '/dashboard'})
            })
            .catch((response) =>{
              this.$store.commit('loginFailed', response);
            });
      }
    },
    computed:{
      authError(){
        return this.$store.getters.authError;
      }
    }
  }
</script>
