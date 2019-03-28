<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Shop List</h3>
          <router-link :to="{ name: 'shop.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body" v-for="shop in shops">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
            <p class="float-left"><b>Shop : {{ shop.name }}</b></p>
            <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteShop(shop.id)"><i class="icon icon-trash"></i></button>
            <router-link :to="{ name: 'shop.edit', params: {id : shop.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
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
        shops : []
      }
    },

    mounted(){
      this.getShop()
    },

    methods:{
      getShop(){
        axios.get(route('shop.index'),{

        })
        .then((response) =>{
          this.shops = response.data.data
        })
        .catch((response) =>{

        })
      },
      deleteShop(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('shop.destroy', id),{

          })
          .then((response) =>{
            this.getShop()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
