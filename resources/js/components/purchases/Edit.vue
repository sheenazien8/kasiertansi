<template>
  <div>
    <breadcrumb title="Edit Pembelian"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="name" class="col-form-label">Tanggal Pembelian</label>
            <input type="date" class="form-control" :class="errors.purchase_date ? 'is-invalid' : ''"  v-model="purchase.purchase_date">
            <div v-if="errors.purchase_date">
              <span class="text-danger">{{ errors.purchase_date[0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Nomor Faktur</label>
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
          <label for="name" class="col-form-label">Methode Pembayaran</label>
          <v-select :options="paymentsData" label="name" :class="errors.payment_method ? 'is-invalid' : ''"  value="name" v-model="purchase.payment_method"/>
          <div v-if="errors.payment_method">
            <span class="text-danger">{{ errors.payment_method[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">No Rekening</label>
          <input type="text" class="form-control" :class="errors.rekening_number ? 'is-invalid' : ''"  v-model="purchase.rekening_number">
          <div v-if="errors.rekening_number">
            <span class="text-danger">{{ errors.rekening_number[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-form-label">Catatan</label>
          <textarea id="name" class="form-control" :class="errors.note ? 'is-invalid' : ''"  v-model="purchase.note"
           ></textarea>
          <div v-if="errors.note">
            <span class="text-danger">{{ errors.note[0] }}</span>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button v-on:click.prevent="updatePurchase()" class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Simpan</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'purchase' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Batal</router-link>
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
          rekening_number : '',
          invoice_number : '',
          purchase_date : ''
        },
        suppliersData : [],
        purchasesData : []  ,
        paymentsData : [
          {name: 'Cash On Delivery (full)'},
          {name: 'Transfer Bank (DP)'},
          {name: 'Transfer Bank (Full)'},
        ],
        errors : []
      }
    },

    mounted(){
      this.editPurchase(this.$route.params.id)
    },

    methods:{
      updatePurchase(){
        var payment_method = this.purchase.payment_method;
        if (typeof this.purchase.payment_method == 'object') {
          payment_method = this.purchase.payment_method.name
        }
        console.log(payment_method)
        axios.put(RouteService.getUrl(route('purchase.update', this.$route.params.id)), {
          supplier_id : this.purchase.supplier_id.id,
          payment_method : payment_method,
          note : this.purchase.note,
          invoice_number : this.purchase.invoice_number,
          rekening_number : this.purchase.rekening_number,
          purchase_date : this.purchase.purchase_date,
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
        axios.get(RouteService.getUrl(route('purchase.edit', id)))
        .then((response)=>{
          this.purchasesData = response.data.purchase
          this.suppliersData = response.data.suppliers
          this.purchase.supplier_id = this.purchasesData.supplier
          this.purchase.payment_method = this.purchasesData.payment_method
          this.purchase.note = this.purchasesData.note
          this.purchase.invoice_number = this.purchasesData.invoice_number
          this.purchase.rekening_number = this.purchasesData.rekening_number
          this.purchase.purchase_date = this.purchasesData.purchase_date
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
