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
                                        <img :src="image.user" alt="user" class="img-circle img-center img-thumbnail" width=""
                                          style="">
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>{{ userable.name }}</strong></p>
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
                                        <b-button v-b-modal.setting-modal class="btn btn-block btn-outline-light text-dark">
                                          <i class="icon icon-settings"></i> Pengaturan
                                        </b-button>
                                      </p>
                                      <p>
                                        <b-button v-b-modal.profile-modal class="btn btn-block btn-outline-light text-dark">
                                          <i class="icon icon-user"></i> Profil
                                        </b-button>
                                      </p>
                                      <p>
                                        <button @click="logout()" class="btn btn-block btn-default btn-info">
                                          <i class="icon icon-logout"></i> Logout
                                        </button>
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
        <b-modal id="setting-modal" title="Setting" @ok="settingUpdate()">
          <form>
            <div class="form-group">
              <label for="name">Nama Toko</label>
              <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name"
              v-model="shop.name">
            </div>
            <div class="form-group">
              <label for="address">Alamat Toko</label>
              <textarea v-model="shop.address" id="address" class="form-control" placeholder="Enter Address">
              </textarea>
            </div>
            <div class="form-group">
              <label>Bahasa</label>
              <select class="form-control">
                <option value="id">Indonesia</option>
                <option value="en">English</option>
              </select>
            </div>
          </form>
        </b-modal>
        <b-modal id="profile-modal" ok-title="Update" title="Profil" @ok="profileUpdate()">
          <form v-on:submit.prevent enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name"  placeholder="Enter Name" v-model="profile.name">
            </div>
            <div class="form-group">
              <label for="name">Email</label>
              <input type="text" class="form-control" id="name"  placeholder="Enter Email" v-model="profile.email">
            </div>
            <div class="form-group">
              <label for="name">Foto</label>
              <button @click="trigger()" class="file btn btn-outline-info float-right form-control">
                Upload Foto Profil <i class="icon icon-folder"></i>
              </button>
              <input ref="inputFile" type="file" style="opacity: 0" v-on:change="fileUpload">
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea v-model="profile.address" id="address" class="form-control" placeholder="Enter Address">
              </textarea>
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
        userable : [],
        image:{
            user: require('./../../images/icons8-male-user-80.png')
        },
        profile : {},
        shop : {},
        file : ''
      }
    },
    mounted(){
      this.getUser()
    },

    methods:{
      fileUpload(e){
        let formData = new FormData()
        formData.append('file', e.target.files[0]);
        axios.post(RouteService.getUrl(route('uploadfile.photo')), formData, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          this.file = response.data;
        })
        .catch((response) =>{

        })
      },
      trigger(){
        this.$refs.inputFile.click();
      },
      profileUpdate(){
        axios.post(RouteService.getUrl(route('profile.update')),{
          name : this.profile.name,
          email : this.profile.email,
          photo : this.profile.photo,
          address : this.profile.address,
          photo : this.file,
        })
        .then((response) =>{

        })
        .catch((response) =>{

        })
      },
      getUser(){
        axios.get(RouteService.getUrl(route('details')))
        .then((response) =>{
          this.user = response.data.user;
          this.userable = this.user.userable;
          this.profile = this.user.userable;
          this.profile.email = this.user.email;
        })
        .catch((response) =>{

        })
      },
      logout(){
        axios.post('logout',{
        })
        .then((response) =>{
          window.location.href = ""
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
        })
        .catch((response) => {

        })
      }
    }
  }
</script>
