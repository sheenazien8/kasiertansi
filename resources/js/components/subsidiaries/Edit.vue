<template>
  <div>
    <breadcrumb title="Cabang Edit"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateCabang()">
        <div class="form-group">
          <label for="name" class="col-form-label">Nama *</label>
          <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="subsidiary.name">
          <div v-if="errors.name">
            <span class="text-danger">{{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Alamat</label>
          <textarea id="name" class="form-control" :class="errors.name ? 'is-invalid' : ''"  v-model="subsidiary.address"
           ></textarea>
          <div v-if="errors.name">
            <span class="text-danger">{{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Dibangun Pada</label>
          <input id="name" type="date" class="form-control" :class="errors.built_at ? 'is-invalid' : ''"  v-model="subsidiary.built_at">
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
              <router-link :to="{ name: 'subsidiary' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >
                Batal
              </router-link>
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
          built_at : '',
          address : '',
        },
        errors : [],
        suppliersData : []
      }
    },

    mounted(){
      this.editCabang(this.$route.params.id)
    },

    methods:{
      updateCabang(){
        axios.put(RouteService.getUrl(route('subsidiary.update', this.$route.params.id)), {
          name : this.subsidiary.name,
          built_at : this.subsidiary.built_at,
          address : this.subsidiary.address,
        })
         .then((response) => {
           this.$router.replace('/subsidiary');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editCabang(id){
        axios.get(RouteService.getUrl(route('subsidiary.edit', id)))
        .then((response)=>{
          this.suppliersData = response.data
          this.subsidiary.name = this.suppliersData.name
          this.subsidiary.built_at = this.suppliersData.built_at
          this.subsidiary.address = this.suppliersData.address
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
