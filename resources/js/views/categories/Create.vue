<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createCategory()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name *</label>
            <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="category.name">
            <div v-if="errors.name">
              <span class="text-danger">{{ errors.name[0] }}</span>
            </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'category' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        category : {
          name : ''
        },
        errors : []
      }
    },

    mounted(){

    },

    methods:{
      createCategory(){
        axios.post(route('category.store'), {name : this.category.name})
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Category'
          });
           this.$router.replace('/category');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(this.errors)
           console.log(response);
         });
      }
    }
  }
</script>
