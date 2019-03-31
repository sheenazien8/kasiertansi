<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form>
        <div class="form-group">
          <label for="name" class="col-form-label">Select Item</label>
          <div class="row">
          <div class="col-md-11 col-sm-11  pl-0">
            <v-select multiple :options="itemsData" label="name" value="id" v-model="items.item"></v-select>
          </div>
          <div class="col-md-1 col-sm-1 p-0 float-right">
            <router-link :to="{ name: 'item.create' }" class="btn btn-primary btn-group-lg h-100 w-100" type="button">
              <i class="icon icon-plus"></i> <span>Item</span>
            </router-link>
          </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea class="form-control" v-model="items.description"></textarea>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button v-on:click.prevent="updatePurchase()" class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'purchase' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        purchase : {
          supplier_id : '',
          note : '',
          payment_method : ''
        },
        suppliersData : [],
        purchasesData : [],
        paymentsData : [
          {id: 1, name: 'Cash On Delivery (full)'},
          {id: 3, name: 'Transfer Bank (DP)'},
          {id: 2, name: 'Transfer Bank (Full)'},
        ],
        errors : []
      }
    },

    mounted(){
      this.editPurchase(this.$route.params.id)
    },

    methods:{
      updatePurchase(){
        axios.put(route('purchase.update', this.$route.params.id), {
          supplier_id : this.purchase.supplier_id.id,
          payment_method : this.purchase.payment_method.name,
          note : this.purchase.note,
        })
         .then((response) => {
           this.$router.replace('/purchase');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
         });
      },
      editPurchase(id){
        axios.get(route('purchase.edit', id))
        .then((response)=>{
          this.purchasesData = response.data.purchase
          this.suppliersData = response.data.suppliers
          this.purchase.supplier_id = this.purchasesData.supplier.name
          this.purchase.payment_method = this.purchasesData.payment_method
          this.purchase.note = this.purchasesData.note
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
