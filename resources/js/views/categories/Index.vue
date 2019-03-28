<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Category List</h3>
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
              <th scope="col">Name</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories">
              <th scope="row">1</th>
              <td>{{ category.name }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteCategory(category.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'category.edit', params: {id : category.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
              </td>
            </tr>
          </tbody>
        </table>
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
        categories : []
      }
    },

    mounted(){
      this.getCategory()
    },

    methods:{
      getCategory(){
        axios.get(route('category.index'),{

        })
        .then((response) =>{
          this.categories = response.data.data
        })
        .catch((response) =>{

        })
      },
      deleteCategory(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('category.destroy', id),{

          })
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
