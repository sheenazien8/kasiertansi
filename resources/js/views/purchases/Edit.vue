<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updatePurchase()">
        <div class="form-group">
          <label for="name" class="col-form-label">Supplier</label>
          <v-select :options="suppliersData" label="name" :class="errors.supplier_id ? 'is-invalid' : ''" value="id" v-model="purchase.supplier_id"/>
          <div v-if="errors.supplier_id">
            <span class="text-danger">{{ errors.supplier_id[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Payment Method</label>
          <v-select :options="paymentsData" label="name" :class="errors.payment_method ? 'is-invalid' : ''" value="name" v-model="purchase.payment_method"/>
          <div v-if="errors.payment_method">
            <span class="text-danger">{{ errors.payment_method[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Note</label>
          <textarea id="name" class="form-control" :class="errors.note ? 'is-invalid' : ''"  v-model="purchase.note"
          cols="30" rows="10"></textarea>
          <div v-if="errors.note">
            <span class="text-danger">{{ errors.note[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
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
