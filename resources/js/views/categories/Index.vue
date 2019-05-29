<template>
<div>
  <breadcrumb title="Kategori"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Daftar Kategori</h3>
          <router-link :to="{ name: 'category.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category, index) in categories.data">
              <th scope="row">{{ ++index }}</th>
              <td>{{ category.name }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right" @click="deleteCategory(category.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'category.edit', params: {id : category.id}}"
                  class="btn btn-sm p-1 btn-info float-right"><i class="icon icon-pencil"></i>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-center" v-if="categories.last_page > 1">
        <v-paginate
          :page-count="categories.last_page"
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
</div>
</template>
<script>
export default {
    data() {
      return {
        categories : []
      }
    },

    mounted(){
      this.getCategory()
    },

    methods:{
      pagination(page){
        axios.get(RouteService.getUrl(route('category.index', {'page' : page})))
          .then((response) =>{
            this.categories = response.data
          })
          .catch((response) =>{

          })
        console.log(page)
      },
      getCategory(){
        axios.get(RouteService.getUrl(route('category.index')))
        .then((response) =>{
          this.categories = response.data
        })
        .catch((response) =>{

        })
      },
      deleteCategory(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('category.destroy', id)))
          .then((response) =>{
            this.getCategory()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
