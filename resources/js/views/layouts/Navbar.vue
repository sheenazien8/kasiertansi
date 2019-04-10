<template>
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
              <router-link class="navbar-brand" :to="{name : 'dashboard'}">
                <b>
                  <h1 class="title-logo text-primary btn btn-lg btn-rounded">KasierTansi</h1>
                </b>
              </router-link>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item hidden-sm-up">
                        <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)">
                            <i class="icon icon-menu"></i>
                        </a>
                    </li>
                    <li class="nav-item search-box">
                        <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                            <i class="fa fa-search"></i>
                        </a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search &amp; enter">
                            <a class="srh-btn">
                                <i class="fa fa-times"></i>
                            </a>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a type="button" class="nav nav-link dropdown-toggle" data-toggle="dropdown">
                            <img :src="image.user" alt="user" class="img-circle" width="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                        <img :src="image.user" alt="user" class="img-circle img-center img-thumbnail" width="" style="">
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>{{ user.userable.name }}</strong></p>
                                        <p class="text-left small">{{ user.email }}</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                      <p>
                                        <b-button v-b-modal.modal-1 class="btn btn-block btn-outline-light text-dark">
                                          <i class="icon icon-settings"></i> Setting
                                        </b-button>
                                      </p>
                                      <p>
                                        <b-button class="btn btn-block btn-outline-light text-dark">
                                          <i class="icon icon-user"></i> Profile
                                        </b-button>
                                      </p>
                                      <p>
                                        <button @click="logout()" class="btn btn-block btn-default btn-info"><i class="icon icon-logout"></i> Logout</button>
                                      </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <b-modal id="modal-1" title="Setting" @ok="settingUpdate()">
          <form>
            <div class="form-group">
              <label for="name">Shop's Name</label>
              <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" v-model="shop.name">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea v-model="shop.address" id="address" class="form-control" placeholder="Enter Address">
              </textarea">
            </div>
            <div class="form-group">
              <label>Language</label>
              <select class="form-control">
                <option value="id">Indonesia</option>
                <option value="en">English</option>
              </select>
            </div>
          </form>
        </b-modal>
    </header>
  </template>
<script>
  export default {
    data(){
      return {
        user : [],
        image:{
            user: require('./../../images/icons8-male-user-80.png')
        },
        shop : {}
      }
    },
    mounted(){
      this.getUser()
    },

    methods:{
      getUser(){
        axios.get(RouteService.getUrl(route('details')))
        .then((response) =>{
          this.user = response.data
        })
        .catch((response) =>{

        })
      },
      logout(){
        axios.post(route('logout'),{
        })
        .then((response) =>{
          window.location.href = "/login"
        })
        .catch((response) =>{
          console.log(response)

        })
      },
      settingUpdate(){
        axios.post(RouteService.getUrl(route('shop.store')), {
          name : this.shop.name,
          address : this.shop.address
        })
        .then((response) => {
          this.getUser();
          // console.log(response)
        })
        .catch((response) => {

        })
      }
    }
  }
</script>
