<template>
  <div>
    <div class="flex-center position-ref full-height">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-4">
          <div v-if="error.account">
            <div class="alert alert-danger" role="alert">
              {{ error.account }}
            </div>
          </div>
          <div v-if="activated">
            <div class="alert alert-success" role="alert">
              {{ activated }}
            </div>
          </div>
          <div id="logo-container" class="text-white text-center mb-3">WELLCOME</div>
          <div class="col-md-12 col-md-offset-1 p-0">
            <form @submit.prevent="authenticate()">
              <div class="form-group">
                <input autofocus class="form-control" type="text" name='email' placeholder="email" v-model="form.email"/>
                <div v-if="error.email">
                  <span class="text-danger" role="alert">
                    <strong>{{ error.email }}</strong>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <input autofocus class="form-control" type="password" name='password' placeholder="password" v-model="form.password"/>
                <div v-if="error.password">
                  <span class="text-danger" role="alert">
                    <strong>{{ error.password }}</strong>
                  </span>
                </div>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-outline-info btn-block">Login</button>
                <router-link :to="{name : 'register'}" class="btn btn-outline-success btn-block register">Register</router-link>
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
        },
        error : {
          email : '',
          password : '',
          message : '',
          account : ''
        },
        activated : ''
      }
    },
    mounted(){
      if (this.$route.query.verification_code && this.$route.query.user_id) {
        this.activating(this.$route.query.user_id, this.$route.query.verification_code);
      }
    },
    methods:{
      authenticate(){
        this.$store.dispatch('login');
        login(this.$data.form)
            .then((response) =>{
              let loader = this.$loading.show({
                canCancel: true,
              });
              setTimeout(() =>{
                this.$store.commit('loginSuccess', response);
                this.$router.push({path: '/dashboard'})
                loader.hide();
              },2000);
            })
            .catch((response) =>{
              if (!this.$data.form.email) {
                this.error.email = 'Email is required';
              }else {
                this.error.email = ''
              }
              if (!this.$data.form.password) {
                this.error.password = 'Password is required';
              }else {
                this.error.password = ''
              }

              if (response.response.data.error) {
                this.$store.commit('loginFailed', response);
                this.error.email = response.response.data.error;
                this.error.account = ""
              }
              if (response.response.data.message) {
                this.$store.commit('loginFailed', response);
                this.error.account = response.response.data.message;
                this.error.message = ""
              }
            });
      },
      activating(user_id, verification_code){
        axios.get(RouteService.getUrl(route('activating.account', {
          'user_id' : user_id, 'verification_code' : verification_code
          })),{
        })
        .then((response) =>{
          this.activated = response.data.message
        })
        .catch((response) =>{

        })
      }
    },
    computed:{
      authError(){
        return this.$store.getters.authError;
      }
    }
  }
</script>
