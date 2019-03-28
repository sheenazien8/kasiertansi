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
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Category</th>
              <th scope="col">COST</th>
              <th scope="col">Price</th>
              <th scope="col">Date of Purchase</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items">
              <th scope="row">1</th>
              <td>{{ item.name }}</td>
              <td>{{ item.category.name }}</td>
              <td>{{ item.cost_of_purchase }}</td>
              <td>{{ item.price }}</td>
              <td>{{ item.date_of_purchase }}</td>
              <td>
                <button title="Delete Item" class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteItem(item.id)"><i class="icon icon-trash"></i></button>
                <router-link title="Edit Item" :to="{ name: 'item.edit', params: {id : item.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
                <router-link title="Add Stock" :to="{ name: 'item.edit.stock', params: {id : item.id}}" class="btn btn-sm p-1 btn-warning float-right mr-2"><i class="icon icon-plus"></i></router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
