<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createSupplier()">
        <div class="form-group">
          <label for="name" class="col-form-label">Name *</label>
          <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="supplier.name">
          <div v-if="errors.name">
            <span class="text-danger">{{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Contact *</label>
          <input id="name" type="text" class="form-control" :class="errors.contact ? 'is-invalid' : ''"  v-model="supplier.contact">
          <div v-if="errors.contact">
            <span class="text-danger">{{ errors.contact[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Address</label>
          <textarea id="name" class="form-control" :class="errors.address ? 'is-invalid' : ''"  v-model="supplier.address"
          cols="30" rows="10"></textarea>
          <div v-if="errors.address">
            <span class="text-danger">{{ errors.address[0] }}</span>
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
          address : '',
          contact : ''
        },
        errors : []
      }
    },

    mounted(){

    },

    methods:{
      createSupplier(){
        axios.post(route('supplier.store'), {
          name : this.supplier.name,
          contact : this.supplier.contact,
          address : this.supplier.address,
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Supplier'
          });
           this.$router.replace('/supplier');
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
