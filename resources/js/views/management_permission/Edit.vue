<template>
  <div>
    <breadcrumb title="Rubah Permisi"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateRole">
        <div class="form-group">
          <label for="name" class="col-form-label">Nama *</label>
          <input id="name" type="text" class="form-control"  v-model="role.name">
        </div>
        <div class="form-group">
          <label for="" class="col-form-label">Permisi</label>
          <v-select :options="permissions" label="display_name" multiple max-height="100px" placeholder=""
          v-model="permission.data">
          </v-select>
        </div>
        <div class="form-group">
          <label for="" class="col-form-label">Karyawan</label>
          <v-select :options="employees" label="name" multiple max-height="100px" placeholder=""
          v-model="employee.data">
          </v-select>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Simpan</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'management_permission' }"
              class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Batal
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
        role : {
          name : ''
        },
        employees : [],
        employee : {
          data : ''
        },
        permissions : [],
        permission : {
          data : []
        }
      }
    },

    mounted(){
      this.getRole(this.$route.params.id)
      this.getEmployee();
      this.getPermission();
    },

    methods:{
      updateRole(){
        axios.patch(RouteService.getUrl(route('role.update', this.$route.params.id)), {
          permissions : this.permission.data,
          employees : this.employee.data,
          name : this.role.name
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Update Permission'
          });
           this.$router.replace('/management_permission');
         })
         .catch((response) =>{

         });
      },
      getRole(id){
        axios.get(RouteService.getUrl(route('role.name', id)),{

        })
        .then((response) => {
          this.role.name = response.data.name
          this.permission.data = response.data.permissions
          this.employee.data = response.data.employees
        })
        .catch((response) => {

        })
      },

      getPermission(){
        axios.get(RouteService.getUrl(route('get.permission')),{

        })
        .then((response) =>{
          this.permissions = response.data
        })
        .catch((response) => {

        })
      },
      getEmployee(){
        axios.get(RouteService.getUrl(route('get.employee')),{

        })
        .then((response) =>{
          this.employees = response.data
        })
        .catch((response) => {

        })
      }
    }
  }
</script>
