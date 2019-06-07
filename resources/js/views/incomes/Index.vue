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
                  :data = "json_data"
                  name = "template-barang.csv">
                    <i class="icon icon-docs"></i> EXCEL
              </download-csv>
              <download-csv class="btn btn-primary"
                  :data = "json_data"
                  name = "template-barang.csv">
                    <i class="icon icon-cloud-download"></i> PDF
              </download-csv>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Total Item</th>
              <th scope="col">Total Pendapatan Perhari</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(income, index) in incomes">
              <th scope="row">{{ ++index }}</th>
              <td>{{ income.date }}</td>
              <td>{{ income.date }}</td>
              <td>{{ income.total_price }}</td>
              <td>
                <router-link :to="{ name:'income.show', params: {date: income.date} }"
                class="btn btn-sm p-1 btn-info float-right mr-2" title="show details?">
                <i class="icon icon-magnifier"></i>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <hr>
    </div>
    <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
</template>
<script>
export default {
    data() {
      return {
        incomes : []
      }
    },

    mounted(){
      this.getPuchase()
    },

    methods:{
      getPuchase(){
        axios.get(RouteService.getUrl(route('income.index')))
        .then((response) =>{
          this.incomes = response.data
        })
        .catch((response) =>{

        })
      },
    }
}
</script>
