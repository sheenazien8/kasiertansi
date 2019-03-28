<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateItem()">
        <div class="form-group">
            <label for="name" class="col-form-label">Category</label>
            <v-select :options="categoriesData" label="name" :class="errors.category_id ? 'is-invalid' : ''" value="id" v-model="item.category_id"/>
            <div v-if="errors.name">
              <span class="text-danger">{{ errors.category_id[0] }}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Unit</label>
            <v-select :options="unitsData" label="unit" value="id" selected="name" v-model="item.unit_id"/>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="item.name">
        </div>
        <div v-if="errors.name">
          <span class="text-danger">{{ errors.name[0] }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Stock</label>
            <input id="name" type="number" class="form-control" :class="errors.stock ? 'is-invalid' : ''" v-model="item.stock">
        </div>
        <div v-if="errors.stock">
          <span class="text-danger">{{ errors.stock[0] }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Cost Of Purchase</label>
            <input id="name" type="number" class="form-control" :class="errors.cost_of_purchase ? 'is-invalid' : ''" v-model="item.cost_of_purchase">
        </div>
        <div v-if="errors.cost_of_purchase">
          <span class="text-danger">{{ errors.cost_of_purchase[0] }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Price</label>
            <input id="name" type="number" class="form-control" :class="errors.price ? 'is-invalid' : ''" v-model="item.price">
            <div v-if="errors.price">
              <span class="text-danger">{{ errors.price[0] }}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Date of Purchase</label> <span style="font-size: 11px;">empty to use today's date</span>
            <input id="name" type="date" class="form-control"  v-model="item.date_of_purchase">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button type="submit" class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'item' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        item : {
          name : '',
          stock : '',
          cost_of_purchase : '',
          price : '',
          category_id : '',
          unit_id : ''
        },
        itemsData : [],
        categoriesData : [],
        unitsData : [],
        errors : []
      }
    },

    mounted(){
      this.editItem(this.$route.params.id)
    },

    methods:{
      updateItem(){
        var category_id = null;
        var unit_id = null;
        if (this.item.category_id) {
          category_id = this.item.category_id.id;
        }
        if (this.item.unit_id) {
          unit_id = this.item.unit_id.id;
        }
        axios.put(route('item.update', this.$route.params.id), {
          name : this.item.name,
          stock : this.item.stock,
          cost_of_purchase : this.item.cost_of_purchase,
          price : this.item.price,
          category_id : category_id,
          unit_id : unit_id
        })
         .then((response) => {
           this.$router.replace('/item');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editItem(id){
        axios.get(route('item.edit', id))
        .then((response)=>{
          this.itemsData = response.data.item
          this.item.name = this.itemsData.name
          this.item.stock = this.itemsData.stock
          this.item.cost_of_purchase = this.itemsData.cost_of_purchase
          this.item.price = this.itemsData.price
          this.categoriesData = response.data.categories
          this.unitsData = response.data.units
          if (!this.item.category_id) {
            this.item.category_id = this.itemsData.category.name
          }
          if (!this.item.unit_id) {
            this.item.unit_id = this.itemsData.unit.unit
          }
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
