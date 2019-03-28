<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Employee List</h3>
          <router-link :to="{ name: 'employee.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body" v-for="employee in employees">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
            <p class="float-left"><b>Employee : {{ employee.name }}</b></p>
            <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteEmployee(employee.id)"><i class="icon icon-trash"></i></button>
            <router-link :to="{ name: 'employee.edit', params: {id : employee.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="float-left">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
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
        employees : []
      }
    },

    mounted(){
      this.getEmployee()
    },

    methods:{
      getEmployee(){
        axios.get(route('employee.index'),{

        })
        .then((response) =>{
          this.employees = response.data.data
        })
        .catch((response) =>{

        })
      },
      deleteEmployee(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('employee.destroy', id),{

          })
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
