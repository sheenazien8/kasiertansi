<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createRole()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name *</label>
            <input id="name" type="text" class="form-control"  v-model="role.name">
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Description</label>
            <textarea class="form-control" v-model="role.description"></textarea>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'role' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        role : {
          name : '',
          description : ''
        }
      }
    },

    mounted(){

    },

    methods:{
      createRole(){
        axios.post(RouteService.getUrl(route('role.store')), {
          name : this.role.name,
          description : this.role.description
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Role'
          });
           this.$router.replace('/management_permission');
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
