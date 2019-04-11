<template>
<div>
  <breadcrumb title="Item"></breadcrumb>
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
              <th scope="col">Code</th>
              <th scope="col">Current Stock</th>
              <th scope="col">Initial Prices</th>
              <th scope="col">Selling Prices</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items">
              <th scope="row">{{ ++index }}</th>
              <td>{{ item.name }}</td>
              <td>{{ item.category.name }}</td>
              <td>{{ item.code }}</td>
              <td :class="item.current_stock <= 0 ? 'bg-danger': ''">
              {{ item.current_stock != 0 && item.current_stock ? item.current_stock : 'OUT OF STOCK!'}}
            </td>
              <td>
                  {{ item.price ? item.price.initial_price : '' }}
              </td>
              <td>
                  {{ item.price ? item.price.selling_price : '' }}
              </td>
              <td>
                <button title="Delete Item" class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteItem(item.id)"><i class="icon icon-trash"></i></button>
                <router-link title="Edit Item" :to="{ name: 'item.edit', params: {id : item.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
                <b-button v-b-modal.modal-1 variant="warning" size="sm" class="float-right mr-2" @click="getId(item.id)">
                  $
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div>
    <b-modal id="modal-1" title="BootstrapVue" @ok="setPrice()">
      <form>
        <div class="form-group">
            <label>Initial Price</label>
            <input type="number" class="form-control" v-model="price.initial_price">
        </div>
        <div class="form-group">
            <label>Selling Price</label>
            <input type="number" class="form-control" v-model="price.selling_price">
        </div>
      </form>
    </b-modal>
  </div>
</div>
</template>
<script>
export default {
    data() {
      return {
        items : [],
        price : {
          initial_price : '',
          selling_price : ''
        },
        item_id : ''
      }
    },

    mounted(){
      this.getItem()
    },

    methods:{
      getId(id){
        this.item_id = id
      },
      setPrice(){
        axios.post(RouteService.getUrl(route('price.store', this.item_id)),{
          initial_price : this.price.initial_price,
          selling_price : this.price.selling_price
        })
        .then((response) =>{
          this.$notify({
            type: 'success',
            text: 'Success Set Price'
          });
          this.price.initial_price = ''
          this.price.selling_price = ''
          this.getItem();
        })
        .catch((response) =>{

        })
      },
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
