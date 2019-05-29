<template>
<div>
  <breadcrumb title="Supplier"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Daftar Supplier</h3>
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
              <tr v-for="(supplier, index) in suppliers.data">
                <th scope="row">{{ ++index }}</th>
                <td>{{ supplier.name }}</td>
                <td>{{ supplier.address }}</td>
                <td>{{ supplier.contact }}</td>
                <td>
                  <button class="btn btn-sm p-1 btn-danger float-right" @click="deleteSupplier(supplier.id)"><i class="icon icon-trash"></i></button>
                  <router-link :to="{ name: 'supplier.edit', params: {id : supplier.id}}" class="btn btn-sm p-1 btn-info float-right"><i class="icon icon-pencil"></i></router-link>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <hr>
    </div>
        <div class="d-flex justify-content-center" v-if="suppliers.last_page > 1">
          <v-paginate
            :page-count="suppliers.last_page"
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
        suppliers : []
      }
    },

    mounted(){
      this.getSupplier()
    },

    methods:{
      pagination(page){
        axios.get(RouteService.getUrl(route('supplier.index', {'page' : page})))
          .then((response) =>{
            this.suppliers = response.data
          })
          .catch((response) =>{

          })
      },
      getSupplier(){
        axios.get(RouteService.getUrl(route('supplier.index')))
        .then((response) =>{
          this.suppliers = response.data
        })
        .catch((response) =>{

        })
      },
      deleteSupplier(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('supplier.destroy', id)),{

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
