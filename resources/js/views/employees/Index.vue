<template>
<div>
  <breadcrumb title="Karyawan"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Daftar Karyawan</h3>
          <router-link :to="{ name: 'employee.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
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
              <th>Tanggal Gabung</th>
              <th></th>
            </tr>
            <tr v-for="(employee, index) in employees.data">
              <td>{{ ++index }}</td>
              <td>{{ employee.name }}</td>
              <td>{{ employee.join_date }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteEmployee(employee.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'employee.edit', params: {id : employee.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
              </td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
        <div class="d-flex justify-content-center" v-if="employees.last_page > 1">
          <v-paginate
            :page-count="employees.last_page"
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
        employees : []
      }
    },

    mounted(){
      this.getEmployee()
    },

    methods:{
     pagination(page){
        axios.get(RouteService.getUrl(route('employee.index', {'page' : page})))
          .then((response) =>{
            this.employees = response.data
          })
          .catch((response) =>{

          })
      },
      getEmployee(){
        axios.get(RouteService.getUrl(route('employee.index')))
        .then((response) =>{
          this.employees = response.data
        })
        .catch((response) =>{

        })
      },
      deleteEmployee(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('employee.destroy', id)))
          .then((response) =>{
            this.getEmployee()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
