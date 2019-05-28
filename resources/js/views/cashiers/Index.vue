<template>
<div>
  <breadcrumb title="Cashier"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Transaksi No.
            <input type="text" readonly class="col-md-3 input-none" v-model="transaction.invoice_number">
          </h3>
        </div>
      </div>
    </div>
    </div>
    <div class="col-md-12 p-0">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="col-md-12 row pr-0">
                <div class="col-md-5 pl-0">
                  <v-select :options="itemsData" label="name" value="id" placeholder="search item type 2 character!"
                  :onSearch="getItemsData" v-model="transaction.item" @change="getDetailItems(transaction.item)">
                  </v-select>
                </div>
                <input type="text" class="col-md-3 mr-1 form-control"
                readonly placeholder="Selling Price" v-model="item.price">
                <input type="number" class="col-md-3 mr-1 form-control"
                :placeholder="item.current_stock <= 0  ? 'Stock Anda kurang' : 'Masukkan Qty'"
                :class="transaction.qty > item.current_stock ? 'bg-danger' : ''"
                @keyup="calculateQty(transaction.qty)" v-model="transaction.qty">
                <button class="btn btn-primary d-inline float-right mr-0"
                :class="transaction.qty > item.current_stock ? 'disabled cursor-disabled' : ''"
                @click="transaction.qty <= item.current_stock ? insertTransaction() : ''">
                  <i class="icon icon-plus"></i>
                </button>
              </div>
              <div class="col-md-12 p-0 mt-2">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>kode</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="transaction_details.length == 0">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>0</td>
                      <td>0</td>
                      <td></td>
                    </tr>
                    <tr v-for="(transaction_detail, index) in transaction_details">
                      <td>{{ ++index }}</td>
                      <td>{{ transaction_detail.item.name }}</td>
                      <td>{{ transaction_detail.item.code }}</td>
                      <td>{{ formatPrice(transaction_detail.price) }}</td>
                      <td>{{ transaction_detail.qty }}</td>
                      <td class="text-right">
                        <button @click="cancelItem(transaction_detail.id)"
                        class="btn btn-sm btn-danger">
                          <i class="icon icon-close"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label><b>Yang Harus Dibayar!</b></label>
                <input type="text" class="form-control input-none text-right"
                style="font-size: 20px" readonly :value="formatPrice(total_price)">
              </div>
              <div class="form-group">
                <label><b>Pembayaran</b></label>
                <input type="text" class="form-control text-right"
                style="font-size: 20px" v-model="transaction.paying" @keyup="calculatePrice()">
              </div>
              <div class="form-group">
                <label><b>Kembalian</b></label>
                <input type="text" class="form-control input-none text-right"
                style="font-size: 20px" readonly v-model="transaction.change">
              </div>
              <button class="btn btn-primary btn-block" @click="insertInvoice()">
                <i class="icon icon-check"></i> Simpan
              </button>
              <button class="btn btn-primary btn-block" @onclick="insertAndPrintInvoice()">
                <i class="icon icon-printer"></i> Simpan & Cetak
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</template>
<script>
import NumberMixins from './../../services/NumberMixins.js';

export default {
  mixins : [NumberMixins],
  data(){
    return {
      itemsData : [],
      transaction : {
        item : '',
        itemsData : [],
        qty : '',
        change : '',
        invoice_number : '',
        paying : ''
      },
      item : {
        id : '',
        current_stock : '',
        code : '',
        name : '',
        price : ''
      },
      transaction_details : [],
      total_price : '',
      total_qty : '',
      errors : ''
    }
  },
  mounted(){
    this.getTransactionDetails();
  },
  methods: {
    getItemsData(search){
      if (search.length >= 2) {
        axios.get(RouteService.getUrl(route('item.search', search)),{

        })
        .then((response) => {
          this.itemsData = response.data
        })
        .catch((response) => {

        })
      }
    },
    getDetailItems(item){
      if (item) {
        axios.get(RouteService.getUrl(route('item.show', item.id)),{

        })
        .then((response) =>{
          this.item.id = response.data.id
          this.item.code = response.data.code
          this.item.name = response.data.name
          this.item.current_stock = response.data.current_stock
          this.item.price = response.data.price.selling_price
        })
        .catch((response) =>{

        })
      }
    },
    insertTransaction(){
      axios.post(RouteService.getUrl(route('transaction_detail.store')),{
        price : this.item.price * this.transaction.qty,
        qty : this.transaction.qty,
        item_id : this.item.id,
      })
      .then((response) => {
        this.getTransactionDetails();
        this.$notify({
          type: 'success',
          text: 'Success Insert Item!'
        });
        this.item.price = ''
        this.transaction.qty = ''
        this.transaction.item = ''
      })
      .catch((response) => {
        this.errors = response.response.data.errors;
      })
    },
    calculateQty(qty){
      if (qty > this.item.current_stock) {
        this.$notify({
          type: 'error',
          text: 'Stock anda kurang!'
        });
      }
    },
    getTransactionDetails(){
      axios.get(RouteService.getUrl(route('transaction_detail.index')),{

      })
      .then((response) => {
        this.transaction_details = response.data.transaction_details
        this.total_price = response.data.total_price
        this.total_qty = response.data.total_qty
        this.transaction.invoice_number = response.data.invoice_number
      })
      .catch((response) => {

      })
    },
    calculatePrice(){
      if (this.transaction.paying >= this.total_price ) {
        this.transaction.change = this.transaction.paying - this.total_price
      }else {
        this.transaction.change = null
      }
    },
    insertInvoice(){
      axios.post(RouteService.getUrl(route('transaction.store')),{
        invoice_number : this.transaction.invoice_number,
        paying : this.transaction.paying,
        change : this.transaction.change,
        total_price : this.total_price,
        total_qty : this.total_qty,
        transactionDetails : this.transaction_details
      })
      .then((response) => {
        this.insertIncome(response.data.id);
        this.getTransactionDetails();
        this.$notify({
          type: 'success',
          text: 'Transaction Success!'
        });
        this.transaction.paying = '';
        this.transaction.change = '';
      })
      .catch((response) => {

      })
    },
    insertAndPrintInvoice(){
      this.insertInvoice();
      axios.get(RouteService.getUrl(route('print.invoice')),{

      })
      .then((response) => {

      })
      .catch((response) => {

      })
    },
    insertIncome(id){
      axios.post(RouteService.getUrl(route('income.store')),{
        transaction_id : id
      })
      .then((response) =>{

      })
      .catch((response) =>{

      })
    },
    cancelItem(id){
      var bool = confirm('You Wanna Delete this?');
      if (bool) {
        axios.delete(RouteService.getUrl(route('transaction_detail.destroy',id)),{

        })
        .then((response) => {
          this.getTransactionDetails();
          this.$notify({
            type: 'success',
            text: 'Item Deleted!'
          });
        })
        .catch((response) => {

        })
      }
    }
  },
}
</script>
