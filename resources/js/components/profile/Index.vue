<template>
<div>
  <breadcrumb title="Profile"></breadcrumb>
  <!-- Row -->
  <div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          <center class="m-t-30"> <img :src="'./../../../../storage/photo-profile/PP20190610105929.jpg'"
            class="img-circle" width="150" />
          <h4 class="card-title m-t-10">Hanna Gover</h4>
          <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
            <div class="row text-center justify-content-md-center">
              <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                <font class="font-medium">254</font></a>
              </div>
              <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                <font class="font-medium">54</font></a>
              </div>
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
          <form class="form-horizontal form-material">
            <div class="form-group">
              <label class="col-md-12">Nama Pengguna</label>
              <div class="col-md-12">
                <input type="text" placeholder="Nama Pengguna" class="form-control form-control-line" v-model="user.username">
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
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                <input type="password" value="password" class="form-control form-control-line">
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
                <button class="btn btn-success">Update Profile</button>
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
        username : '',
        email : '',
        photo : '',
        address : ''
      }
    };
  },
  mounted(){
    this.getProfile();
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
        this.$store.state.currentUser.userable.photo = this.file
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
    getProfile(){
      this.user.username = this.$store.getters.currentUser.userable.name
      this.user.email = this.$store.getters.currentUser.email
      axios.get(RouteService.getUrl(route('profile.image', this.$store.getters.currentUser.id)))
      .then((response) =>{

      })
      .catch((response) =>{

      })
    }
  }
};
</script>
<style lang="css" scoped>
</style>
