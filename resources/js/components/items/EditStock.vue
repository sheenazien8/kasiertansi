<template>
  <div>
    <breadcrumb title="Item Add Stock"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateStock()">
        <div class="form-group">
            <label for="name" class="col-form-label">Stock</label>
            <input id="name" type="number" class="form-control"  v-model="item.stock">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'item' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        item : {
          stock : ''
        }
      }
    },

    mounted(){

    },

    methods:{
      updateStock(){
        axios.put(RouteService.getUrl(route('item.update.stock', this.$route.params.id)), {
          stock : this.item.stock
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Update Stock'
          });
           this.$router.replace('/item');
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
