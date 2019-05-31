<template>
<div>
  <breadcrumb title="Managemen Permisi"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <router-link :to="{ name: 'management_permission.create' }" class="btn btn-sm btn-success float-right">
            <i class="icon icon-plus my-float"></i>
          </router-link>
          <h3>Daftar Jabatan</h3>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th></th>
            </tr>
            <tr v-for="(role, index) in roles.data">
              <td>{{ ++index }}</td>
              <td>{{ role.display_name }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right"
                  @click="deleteRole(role.id)">
                  <i class="icon icon-trash"></i>
                </button>
                <router-link :to="{ name: 'management_permission.edit', params: {id : role.id}}"
                  class="btn btn-sm p-1 btn-warning float-right">
                  <i class="icon icon-pencil"></i>
                </router-link>
                <b-button v-b-modal.modal-1 size="sm" variant="info" class="modal-1 float-right"
                  @click="getRoleId(role.id)">
                  <i class="icon icon-magnifier"></i>
                </b-button>
              </td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <b-modal id="modal-1" size="lg" title="List User" class="p-0">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Join Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users">
            <td>{{ user.name }}</td>
            <td>{{ user.user.email }}</td>
            <td>{{ user.join_date }}</td>
          </tr>
        </tbody>
      </table>
    </b-modal>
      <div class="d-flex justify-content-center" v-if="roles.last_page > 1">
        <v-paginate
          :page-count="roles.last_page"
          :click-handler="pagination"
          :prev-text="'&laquo;'"
          :next-text="'&raquo;'"
          :prev-link-class="'page-link'"
          :next-link-class="'page-link'"
          :container-class="'pagination'"
          :page-class="'page-item'"
          :page-link-class="'page-link'">
        </v-paginate>
      </div>
  </div>
</div>
</template>
<script>
export default {
    data() {
      return {
        roles : [],
        role : {

        },
        users : []
      }
    },

    mounted(){
      this.getRole()
    },

    methods:{
      pagination(page){
        axios.get(RouteService.getUrl(route('role.index', {'page' : page})))
          .then((response) =>{
            this.roles = response.data
          })
          .catch((response) =>{

          })
      },
      getRole(){
        axios.get(RouteService.getUrl(route('role.index')))
        .then((response) =>{
          this.roles = response.data
        })
        .catch((response) =>{

        })
      },
      getRoleId(id){
        axios.get(RouteService.getUrl(route('get.role', id)))
        .then((response) => {
          this.users = response.data
        })
        .catch((response) => {

        })
      },
      deleteRole(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('role.destroy', id)))
          .then((response) =>{
            this.getRole()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
