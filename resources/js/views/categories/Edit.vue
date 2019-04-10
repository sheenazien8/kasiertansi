<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateCategory()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name *</label>
            <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="category.name">
            <div v-if="errors.name">
              <span class="text-danger">{{ errors.name[0] }}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Description</label>
            <textarea id="" class="form-control" :class="errors.description
            ? 'is-invalid' : ''"  v-model="category.description"></textarea>
            <div v-if="errors.description">
              <span class="text-danger">{{ errors.description[0] }}</span>
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
        categoriesData : [],
        errors : []
      }
    },

    mounted(){
      this.editCategory(this.$route.params.id)
    },

    methods:{
      updateCategory(){
        axios.put(RouteService.getUrl(route('category.update', this.$route.params.id)), {
          name : this.category.name
        })
         .then((response) => {
           this.$router.replace('/category');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editCategory(id){
        axios.get(RouteService.getUrl(route('category.edit', id)))
        .then((response)=>{
          this.categoriesData = response.data
          this.category.name = this.categoriesData.name
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
