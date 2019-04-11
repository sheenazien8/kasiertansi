<template>
<div>
  <breadcrumb title="Management Permission"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Role List</h3>
          <router-link :to="{ name: 'management_permission.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th></th>
            </tr>
            <tr v-for="(role, index) in roles">
              <td>{{ ++index }}</td>
              <td>{{ role.display_name }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteRole(role.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'management_permission.edit', params: {id : role.id}}" class="btn btn-sm p-1 btn-warning float-right mr-2"><i class="icon icon-pencil"></i></router-link>
                <b-button v-b-modal.modal-1 size="sm" variant="info" class="modal-1 float-right mr-2" @click="getRoleId(role.id)">
                  <i class="icon icon-magnifier"></i>
                </b-button>
              </td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <b-modal id="modal-1" size="lg" title="List User" hide-footer="true" class="p-0">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users">
            <td>{{ user.email }}</td>
            <td>{{ user.userable.name }}</td>
          </tr>
        </tbody>
      </table>
    </b-modal>
    <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
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
          console.log(this.users);
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
