<template>
  <div>
    <breadcrumb title="Dashboard" breadcrumb="Dashboard"></breadcrumb>
    <div class="row">
      <div class="col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body bg-primary text-white">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 p-0 mr-3">
                      <i class="icon icon-tag size-icon"></i>
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text">
                        <span class="count" style="font-size: 1.2em;">{{ formatPrice(data.incomes) }}</span>
                      </div>
                      <div class="stat-heading">Pendapatan Hari Ini</div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body bg-info text-white">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 p-0 mr-3">
                      <i class="icon icon-grid size-icon"></i>
                      <!-- <p style="size: 30px">$</p> -->
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text">
                        <span class="count" style="font-size: 1.2em;">{{ formatPrice(data.admission_today) }}</span>
                      </div>
                      <div class="stat-heading">Uang Masuk Hari Ini</div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>


      <div class="col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body bg-success text-white">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 p-0 mr-3">
                      <i class="icon icon-basket size-icon"></i>
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text">
                        <span class="count" style="font-size: 1.2em;">{{ data.items }}</span>
                      </div>
                      <div class="stat-heading">Barang Terjual</div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body bg-danger text-white">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 p-0 mr-3">
                      <i class="icon icon-people size-icon"></i>
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text">
                        <span class="count" style="font-size: 1.2em;">{{ data.employees }}</span>
                      </div>
                      <div class="stat-heading">Karyawan</div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
    <div class="row">
       <div class="col-lg-8">
           <div class="card oh">
               <div class="card-body">
                   <div class="d-flex m-b-30 align-items-center no-block">
                       <h5 class="card-title ">Penjualan Tahunan</h5>
                       <div class="ml-auto">
                         <button class="btn btn-sm btn-primary" id="oneweek" @click="getIncome('7')">
                           1 Minggu
                         </button>
                         <button class="btn btn-sm btn-primary" id="oneweek" @click="getIncome('30')">
                           Bulan
                         </button>
                       </div>
                   </div>
                  <canvas id="planet-chart"></canvas>
               </div>
               <div class="card-body bg-light">
                   <div class="row text-center m-b-20">
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">6000</h2>
                           <span class="text-muted">Total sale</span>
                       </div>
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">4000</h2>
                           <span class="text-muted">Iphone</span>
                       </div>
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">2000</h2>
                           <span class="text-muted">Ipad</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-lg-4">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Faktur</h4>
                  <h6 class="card-subtitle">Anda dapat melihat faktur terbaru</h6>
              </div>
              <ul class="feeds p-b-20">
                <li v-for="invoice in data.invoice_number">
                    <div class="bg-info">
                      <i class="fa fa-bell-o"></i>
                    </div> {{ invoice.invoice_number }} <span class="text-muted">{{ invoice.created_at }}</span>
                </li>
              </ul>
          </div>

       </div>
    </div>
    <div class="row">
      <div class="col-md-6">

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
        data : {},
        label : [],
      }
    },
    mounted(){
      this.getDataDashboard();
   },
    methods : {
      getDataDashboard(){
        axios.get(RouteService.getUrl(route('get.data.dashboard')))
        .then((response) =>{
          this.data = response.data
        })
        .catch((response) =>{

        })
      },
      getIncome(day){
        axios.post(RouteService.getUrl(route('get.data.income')),{
          day : day
        })
        .then((response) => {
          this.label = Object.keys(response.data)
          this.createChart('id', Object.values(response.data));
        })
        .catch((response) =>{
        });
      },
      createChart(chartId, chartData) {
        const ctx = document.getElementById('planet-chart');
        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: this.label,
        datasets: [{
            label: '# Seling Prosentase',
            data: [20, 40, 69, 83, 55, 76, 88],
            backgroundColor: 'rgba(116, 96, 238, 0.2)',
            borderColor: '#7460EE',
        }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
                max: 100,
                stepSize: 20
              }
            }]
          },
          hover: {
		  		  mode: 'nearest',
	  		  	intersect: true
  		  		},
          },
          tooltips: {
					  mode: 'index',
					  intersect: false,
				  },
        });
      }
    }
  }
</script>
