<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateShop()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" type="text" class="form-control"  v-model="shop.name">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'shop' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        },
        shopsData : []
      }
    },

    mounted(){
      this.editShop(this.$route.params.id)
    },

    methods:{
      updateShop(){
        axios.put(RouteService.getUrl(route('shop.update', this.$route.params.id)), {
          name : this.shop.name
        })
         .then((response) => {
           this.$router.replace('/shop');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editShop(id){
        axios.get(route('shop.edit', id))
        .then((response)=>{
          this.shopsData = response.data
          this.shop.name = this.shopsData.name
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
