<template>
<div>
  <breadcrumb title="Laporan"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Laporan Penjualan</h3>
        </div>
      </div>
    </div>
    <div class="card-body" >
      <div class="row">
        <div class="col-md-12">
          <h3 class="mb-2"><b>Periode</b> {{ getIncome.start_date? getIncome.start_date : '0000-00-00' }}
          s/d {{ getIncome.end_date ? getIncome.end_date : '0000-00-00' }}</h3>
          <div class="form-inline">
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4"
                v-model="getIncome.start_date" placeholder="Dari" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <span>s/d</span>
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4"
                v-model="getIncome.end_date" placeholder="Sampai" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" @click="showIncome()">Tampilkan</button>
            </div>
            <div class="form-group ml-auto">
              <download-csv class="btn btn-primary mr-2"
                  :data = "[{
                    'oke' : 'oke'
                  }]"
                  name = "template-barang.csv">
                    <i class="icon icon-docs"></i> EXCEL
              </download-csv>
              <button class="btn btn-primary" @click="printPdf()">
                  <i class="icon icon-cloud-download"></i> PDF
              </button>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Transaksi</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Total Item</th>
                <th scope="col">Total Uang Masuk</th>
                <th scope="col">Total Pendapatan</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(income, index) in incomes">
                <th scope="row">{{ ++index }}</th>
                <td>{{ income.transaction.invoice_number }}</td>
                <td>{{ income.date }}</td>
                <td>{{ income.transaction.total_qty }}</td>
                <td>{{ formatPrice(income.transaction.total_price) }}</td>
                <td>{{ formatPrice(income.transaction.total_profit) }}</td>
                <td>
                  <b-button v-b-modal.show-item @click="showItem(income.transaction.id)" class="btn btn-sm btn-info float-right mr-2">
                    <i class="icon icon-magnifier"></i>
                  </b-button >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
    </div>
  </div>
  <b-modal size="lg" id="show-item" title="List Item">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Item</th>
          <th>Kategori</th>
          <th>Kode Item</th>
          <th>Harga Awal</th>
          <th>Harga Jual</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="transactionDetail in transactionDetails">
          <td>{{ transactionDetail.item.name }}</td>
          <td>{{ transactionDetail.item.category.name }}</td>
          <td>{{ transactionDetail.item.code }}</td>
          <td>{{ transactionDetail.item.price.initial_price }}</td>
          <td>{{ transactionDetail.item.price.selling_price }}</td>
        </tr>
      </tbody>
    </table>
  </b-modal>
</div>
</template>
<script>
import NumberMixins from './../../services/NumberMixins.js';

export default {
  mixins : [NumberMixins],
    data() {
      return {
        getIncome : {
          start_date : '',
          end_date : '',
        },
        incomes : [],
        transactionDetails : []
      }
    },

    mounted(){

    },

    methods:{
      showIncome(){
        axios.post('/api/income/get-income',{
          start_date : this.getIncome.start_date,
          end_date : this.getIncome.end_date
        })
        .then((response) => {
          this.incomes = response.data
        })
        .catch((response) => {

        })
      },
      showItem(transaction_id){
        axios.get(RouteService.getUrl(route('get.item.by_transaction', transaction_id)))
        .then((response) => {
          this.transactionDetails = response.data
        })
        .catch((response) => {

        })
      },
      printPdf(){
        axios.get(RouteService.getUrl(route('pdf.income')), {
          start_date : this.getIncome.start_date,
          end_date : this.getIncome.end_date
        })
        .then((response) => {
          window.location = '/'
        })
        .catch((response) => {

        })
      }
    }
}
</script>
