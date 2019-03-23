<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <h3 class="card-header">
          Item List
          <router-link :to="{ name: 'item.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </h3>
      </div>
    </div>
    <div class="card-body" v-for="item in items">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
            <p class="float-left"><b>Item : {{ item.name }}</b></p>
            <button title="Delete Item" class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteItem(item.id)"><i class="icon icon-trash"></i></button>
            <router-link title="Edit Item" :to="{ name: 'item.edit', params: {id : item.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
            <router-link title="Add Stock" :to="{ name: 'item.edit.stock', params: {id : item.id}}" class="btn btn-sm p-1 btn-warning float-right mr-2"><i class="icon icon-plus"></i></router-link>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="float-left">
                <p class="text-muted">Category : {{ item.category ? item.category.name : 'Nothing Category' }}</p>
                <p class="text-muted">Stock : {{ item.stock }}</p>
                <p class="text-muted">Cost of Purchase : {{ item.cost_of_purchase }}</p>
                <p class="text-muted">Price : {{ item.price }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>
</template>
<script>
export default {
    data() {
      return {
        items : []
      }
    },

    mounted(){
      this.getItem()
    },

    methods:{
      getItem(){
        axios.get(route('item.index'),{

        })
        .then((response) =>{
          this.items = response.data
        })
        .catch((response) =>{

        })
      },
      deleteItem(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('item.destroy', id),{

          })
          .then((response) =>{
            this.getItem()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
