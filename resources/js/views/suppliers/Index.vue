<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Supplier List</h3>
          <router-link :to="{ name: 'supplier.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(supplier, index) in suppliers">
                <th scope="row">{{ ++index }}</th>
                <td>{{ supplier.name }}</td>
                <td>{{ supplier.address }}</td>
                <td>{{ supplier.contact }}</td>
                <td>
                  <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteSupplier(supplier.id)"><i class="icon icon-trash"></i></button>
                  <router-link :to="{ name: 'supplier.edit', params: {id : supplier.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
                </td>
              </tr>
            </tbody>
          </table>
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
        suppliers : []
      }
    },

    mounted(){
      this.getSupplier()
    },

    methods:{
      getSupplier(){
        axios.get(route('supplier.index'),{

        })
        .then((response) =>{
          this.suppliers = response.data.data
        })
        .catch((response) =>{

        })
      },
      deleteSupplier(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('supplier.destroy', id),{

          })
          .then((response) =>{
            this.getSupplier()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
