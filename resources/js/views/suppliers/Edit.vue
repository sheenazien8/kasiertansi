<template>
  <div>
    <breadcrumb title="Supplier Edit"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateSupplier()">
        <div class="form-group">
          <label for="name" class="col-form-label">Name *</label>
          <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="supplier.name">
          <div v-if="errors.name">
            <span class="text-danger">{{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Contact</label>
          <input id="name" type="text" class="form-control" :class="errors.contact ? 'is-invalid' : ''"  v-model="supplier.contact">
          <div v-if="errors.contact">
            <span class="text-danger">{{ errors.contact[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Address</label>
          <textarea id="name" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="supplier.address"
           ></textarea>
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
              <router-link :to="{ name: 'supplier' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        supplier : {
          name : '',
          contact : '',
          address : '',
        },
        errors : [],
        suppliersData : []
      }
    },

    mounted(){
      this.editSupplier(this.$route.params.id)
    },

    methods:{
      updateSupplier(){
        axios.put(RouteService.getUrl(route('supplier.update', this.$route.params.id)), {
          name : this.supplier.name,
          contact : this.supplier.contact,
          address : this.supplier.address,
        })
         .then((response) => {
           this.$router.replace('/supplier');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editSupplier(id){
        axios.get(RouteService.getUrl(route('supplier.edit', id)))
        .then((response)=>{
          this.suppliersData = response.data
          this.supplier.name = this.suppliersData.name
          this.supplier.contact = this.suppliersData.contact
          this.supplier.address = this.suppliersData.address
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
