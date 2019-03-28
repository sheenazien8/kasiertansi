<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createItems()">
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
          cost_of_purchase : '',
          stock : '',
          price : '',
          date_of_purchase : '',
          category_id : '',
          unit_id : ''
        },
        categoriesData : [],
        unitsData : [],
        errors : []
      }
    },

    mounted(){
      this.getCreateDataItems();
    },

    methods:{
      getCreateDataItems(){
        axios.get(route('item.create'),{

        })
        .then((response) =>{
          this.categoriesData = response.data.categories
          this.unitsData = response.data.units
        })
        .catch((response) =>{

        })
      },
      createItems(){
        axios.post(route('item.store'), {
          name : this.item.name,
          stock : this.item.stock,
          cost_of_purchase : this.item.cost_of_purchase,
          price : this.item.price,
          category_id : this.item.category_id.id,
          unit_id : this.item.unit_id.id
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Items'
          });
           this.$router.replace('/item');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      }
    }
  }
</script>
