<template>
<div>
  <breadcrumb title="Laporan"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Laporan Pembelian</h3>
        </div>
      </div>
    </div>
    <div class="card-body" >
      <div class="row">
        <div class="col-md-12">
          <h3 class="mb-2"><b>Periode</b> {{ getSpending.start_date? getSpending.start_date : '0000-00-00' }}
          s/d {{ getSpending.end_date ? getSpending.end_date : '0000-00-00' }}</h3>
          <div class="form-inline">
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4"
                v-model="getSpending.start_date" placeholder="Dari" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <span>s/d</span>
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4"
                v-model="getSpending.end_date" placeholder="Sampai" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" @click="getReportSpending()">Tampilkan</button>
            </div>
            <div class="form-group ml-auto">
              <download-csv class="btn btn-primary mr-2"
                  :data = "[{
                    'oke' : 'oke'
                  }]"
                  name = "template-barang.csv">
                    <i class="icon icon-docs"></i> EXCEL
              </download-csv>
              <download-csv class="btn btn-primary"
                  :data = "[{
                    'oke' : 'oke'
                  }]"
                  name = "template-barang.csv">
                    <i class="icon icon-cloud-download"></i> PDF
              </download-csv>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>No Transaksi</th>
                  <th>Tipe Pembayaran</th>
                  <th>Catatan Transaksi</th>
                  <th>Tanggal</th>
                  <th>Total Pengeluaran</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(transaction, index) in transactions">
                  <th scope="row">{{ ++index }}</th>
                  <td>{{ transaction.invoice_number }}</td>
                  <td>{{ transaction.payment_method }}</td>
                  <td>{{ transaction.note }}</td>
                  <td>{{ transaction.purchase_date }}</td>
                  <td>{{ formatPrice(transaction.spending.total_price) }}</td>
                  <td>
                    <router-link :to="{ name:'spending.show', params: {date: transaction.purchase_date} }"
                    class="btn btn-sm p-1 btn-info float-right mr-2" title="show details?"><i class="icon icon-magnifier"></i></router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div class="d-flex justify-content-center">

    </div>
  </div>
</div>
</template>
<script>
import NumberMixins from './../../services/NumberMixins.js';

export default {
  mixins : [NumberMixins],
    data() {
      return {
        transactions : [],
        getSpending : {
          start_date : '',
          end_date : ''
        }
      }
    },

    mounted(){
      var date = new Date();
      this.getSpending.start_date = date.getFullYear() + '-' +
      ("0" + (date.getMonth() + 1)).slice(-2) + '-' +
      ("0" + date.getDate()).slice(-2);
      this.getSpending.end_date = date.getFullYear() + '-' +
      ("0" + (date.getMonth() + 1)).slice(-2) + '-' +
      ("0" + date.getDate()).slice(-2);
    },

    methods:{
      getReportSpending(){
        axios.post(RouteService.getUrl(route('spending.get-spending')),{
          start_date : this.getSpending.start_date,
          end_date : this.getSpending.end_date
        })
        .then((response) =>{
          this.transactions = response.data
          console.log(this.transactions)
        })
        .catch((response) =>{

        })
      }
    }
}
</script>
