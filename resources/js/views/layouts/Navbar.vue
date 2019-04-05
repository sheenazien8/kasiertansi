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
                  <li>
                    <button @click="logout()" class="btn"><i class="icon icon-logout"></i></button>
                  </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img :src="image.user" alt="user" class="img-circle" width="30">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
  </template>
<script>
  export default {
    data(){
      return {
        user : [],
        image:{
            user: require('./../../images/icons8-male-user-80.png')
        }
      }
    },
    mounted(){
      this.getUser()
    },

    methods:{
      getUser(){
        axios.get(route('details'),{

        })
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
      }
    }
  }
</script>
