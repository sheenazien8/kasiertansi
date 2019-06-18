<template>
  <div>
    <breadcrumb title="Tambah Cabang"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createSubsidiary()">
        <div class="form-group">
          <label for="name" class="col-form-label">Nama *</label>
          <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''"
          v-model="subsidiary.name">
          <div v-if="errors.name">
            <span class="text-danger">{{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Alamat</label>
          <textarea id="name" class="form-control" :class="errors.address ? 'is-invalid' : ''"
          v-model="subsidiary.address"
           ></textarea>
          <div v-if="errors.address">
            <span class="text-danger">{{ errors.address[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Dibangun Pada</label>
          <input id="name" type="date" class="form-control" :class="errors.built_at ? 'is-invalid' : ''"
          v-model="subsidiary.built_at">
          <div v-if="errors.built_at">
            <span class="text-danger">{{ errors.built_at[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Simpan</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'subsidiary' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Batal</router-link>
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
        subsidiary : {
          name : '',
          address : '',
          built_at : ''
        },
        errors : []
      }
    },

    mounted(){

    },

    methods:{
      createSubsidiary(){
        axios.post(RouteService.getUrl(route('subsidiary.store')), {
          name : this.subsidiary.name,
          built_at : this.subsidiary.built_at,
          address : this.subsidiary.address,
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Subsidiary'
          });
           this.$router.replace('/subsidiary');
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
