<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createShop()">
        <div class="form-group">
            <label for="name" class="col-form-label">Nama</label>
            <input id="name" type="text" class="form-control"  v-model="shop.name">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Simpan</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'shop' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Batal</router-link>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        shop : {
          name : ''
        }
      }
    },

    mounted(){

    },

    methods:{
      createShop(){
        axios.post(RouteService.getUrl(route('shop.store')), {
          name : this.shop.name
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Shop'
          });
           this.$router.replace('/shop');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      }
    }
  }
</script>
