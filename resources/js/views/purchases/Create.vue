<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createPurchase()">
        <div class="form-group">
          <label for="name" class="col-form-label">Purchasing Date</label>
          <input type="date" class="form-control" :class="errors.purchase_date ? 'is-invalid' : ''"  v-model="purchase.purchase_date">
          <div v-if="errors.purchase_date">
            <span class="text-danger">{{ errors.purchase_date[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Invoice Number</label>
          <input type="text" class="form-control" :class="errors.invoice_number ? 'is-invalid' : ''"  v-model="purchase.invoice_number">
          <div v-if="errors.invoice_number">
            <span class="text-danger">{{ errors.invoice_number[0] }}</span>
          </div>
        </div>
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
          payment_method : '',
          invoice_number : '',
          purchase_date : ''
        },
        suppliersData : [],
        paymentsData : [
          {id: 1, name: 'Cash On Delivery (full)'},
          {id: 3, name: 'Transfer Bank (DP)'},
          {id: 2, name: 'Transfer Bank (Full)'},
        ],
        errors : []
      }
    },

    mounted(){
      this.getCreateDataPurchases();
    },

    methods:{
      getCreateDataPurchases(){
        axios.get(route('purchase.create'), {
        })
        .then((response) =>{
          this.suppliersData = response.data
        })
        .catch((response) =>{

        })
      },
      createPurchase(){
        axios.post(route('purchase.store'), {
          supplier_id : this.purchase.supplier_id.id,
          payment_method : this.purchase.payment_method.name,
          note : this.purchase.note,
          invoice_number : this.purchase.invoice_number,
          purchase_date : this.purchase.purchase_date,
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Purchase'
          });
           this.$router.replace('/purchase');
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
