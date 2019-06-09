<template>
  <div>
    <div class="flex-center position-ref full-height">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-4">
            <div v-if="registered">
              <div class="alert alert-success" role="alert">
                {{ registered }}
              </div>
            </div>
            <div id="logo-container" class="text-white text-center mb-3">SIGN UP</div>
            <div class="col-md-12 col-md-offset-1 p-0">
              <form @submit.prevent="register()">
                <div class="form-group">
                  <input class="form-control" type="text" name='name' placeholder="name" v-model="form.name"
                  autofocus/>
                  <div v-if="errors.name">
                    <span class="text-danger" role="alert">
                      <strong>{{ errors.name[0] }}</strong>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name='email' placeholder="email" v-model="form.email"
                  autofocus/>
                  <div v-if="errors.email">
                    <span class="text-danger" role="alert">
                      <strong>{{ errors.email[0] }}</strong>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name='password' placeholder="password" v-model="form.password"
                  autofocus/>
                  <div v-if="errors.password">
                    <span class="text-danger" role="alert">
                      <strong>{{ errors.password[0] }}</strong>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name='password_confirmation' placeholder="Password Confirmation"
                  v-model="form.password_confirmation" autofocus/>
                  <div v-if="errors.password_confirmation">
                    <span class="text-danger" role="alert">
                      <strong>{{ errors.password_confirmation[0] }}</strong>
                    </span>
                  </div>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="agree" value="1" v-model="agree">
                    I agree to the <a href="#" class="btn-link">Terms and Conditions</a>
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" :class="agree ? '' : 'd-none'" class="btn btn-outline-info btn-block">
                    Sign Up
                  </button>
                  <router-link :to="{name : 'login'}" class="btn btn-outline-success btn-block login">
                    Login
                  </router-link>
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
  import {register}  from "../../helpers/auth";
  export default {
    data(){
      return {
        form : {
          name : '',
          email : '',
          password : '',
          password_confirmation : ''
        },
        registered : '',
        agree : '',
        errors : []
      }
    },
    mounted(){
    },

    methods:{
      register(){
        this.$store.dispatch('register')
        register(this.$data.form)
                .then((response)=>{
                  let loader = this.$loading.show({
                    canCancel: true,
                  });
                  setTimeout(() => {
                    this.form.name = '';
                    this.form.email = '';
                    this.form.password = '';
                    this.form.password_confirmation = '';
                    this.registered = 'Akun anda berhasil dibuat untuk mengaktifkan silahkan cek akun email anda!!';
                    loader.hide();
                  },2000)
                })
                .catch((response)=>{
                  this.errors = response.response.data.error
                });
      }
    }
  }
</script>
