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
          <h3><b>Periode</b></h3>
          <div class="form-inline">
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Dari" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <span>s/d</span>
            <div class="input-group date col-3" id="datetimepicker4" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Dari" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icon icon-calendar"></i></div>
                </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary">Tampilkan</button>
            </div>
            <div class="form-group ml-auto">
              <download-csv class="btn btn-primary mr-2"
                  :data = "{
                    'oke' : 'oke'
                  }"
                  name = "template-barang.csv">
                    <i class="icon icon-docs"></i> EXCEL
              </download-csv>
              <download-csv class="btn btn-primary"
                  :data = "{
                    'oke' : 'oke'
                  }"
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
                <tr v-for="(spending, index) in spendings">
                  <th scope="row">{{ ++index }}</th>
                  <td>{{ spending.date }}</td>
                  <td>{{ spending.total_price }}</td>
                  <td>
                    <router-link :to="{ name:'spending.show', params: {date: spending.date} }"
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
export default {
    data() {
      return {
        spendings : []
      }
    },

    mounted(){
      this.getPuchase();
    },

    methods:{
      getPuchase(){
        axios.get(RouteService.getUrl(route('spending.index')))
        .then((response) =>{
          this.spendings = response.data
        })
        .catch((response) =>{

        });
      },
    }
}
</script>
