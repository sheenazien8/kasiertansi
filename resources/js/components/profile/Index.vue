<template>
<div>
  <breadcrumb title="Profile"></breadcrumb>
  <!-- Row -->
  <div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30">
            <picture-input
                  ref="pictureInput"
                  width="300"
                  height="300"
                  margin="16"
                  accept="image/jpeg,image/png,image/jpg"
                  size="10"
                  button-class="btn btn-primary"
                  :custom-strings="{
                    upload: '<h1>Bummer!</h1>',
                    drag: 'Drag a 😺 GIF or GTFO'
                  }"
                  @change="takeAnImage">
            </picture-input>
          <h4 class="card-title m-t-10">{{ $store.getters.currentUser.userable.name }}</h4>
            <div class="row text-center justify-content-md-center">

            </div>
          </center>
        </div>
      </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <!-- Tab panes -->
        <div class="card-body">
          <form v-on:submit.prevent class="form-horizontal form-material">
            <div class="form-group">
              <label class="col-md-12">Nama Pengguna</label>
              <div class="col-md-12">
                <input type="text" placeholder="Nama Pengguna" class="form-control form-control-line" v-model="user.name">
              </div>
            </div>
            <div class="form-group">
              <label for="example-email" class="col-md-12">Email</label>
              <div class="col-md-12">
                <input type="email" placeholder="Email" class="form-control form-control-line"
                name="example-email" id="example-email" v-model="user.email">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Alamat</label>
              <div class="col-md-12">
                <textarea rows="5" class="form-control form-control-line" v-model="user.address">

                </textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button @click="profileUpdate" class="btn btn-success">Update Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Column -->
  </div>
</div>
</template>
<script>
export default {
  data() {
    return {
      user : {
        name : '',
        email : '',
        photo : '',
        address : ''
      }
    }
  },
  mounted(){
    this.getProfile();
  },
  methods:{
    takeAnImage(image){
      this.user.photo = image;
    },
    profileUpdate(){
      axios.put(RouteService.getUrl(route('profile.update', this.$store.getters.currentUser.id)),{
        name : this.user.name,
        email : this.user.email,
        photo : this.user.photo,
        address : this.user.address,
      })
      .then((response) =>{

      })
      .catch((response) =>{

      })
    },
    getProfile(){
      this.user = this.$store.getters.currentUser.userable_type
      this.user.email = this.$store.getters.currentUser.email
    }
  }
}
</script>
<style lang="css" scoped>
</style>
