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
                      <div class="stat-text"><span class="count" style="font-size: 1.5em;">{{ data.incomes }}</span></div>
                      <div class="stat-heading">Income Today</div>
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
                      <i class="icon icon-basket size-icon"></i>
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text"><span class="count" style="font-size: 1.5em;">{{ data.items }}</span></div>
                      <div class="stat-heading">Items Sold</div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body bg-warning text-white">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 p-0 mr-3">
                      <i class="icon icon-grid size-icon"></i>
                    </div>
                    <div class="col-md-6">
                      <div class="stat-text"><span class="count" style="font-size: 1.5em;">2986</span></div>
                      <div class="stat-heading">Distributary</div>
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
                      <div class="stat-text"><span class="count" style="font-size: 1.5em;">{{ data.employees }}</span></div>
                      <div class="stat-heading">Employees</div>
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
                       <h5 class="card-title ">Yearly Sales</h5>
                       <div class="ml-auto">
                       </div>
                   </div>
                  <canvas id="planet-chart"></canvas>
               </div>
               <div class="card-body bg-light">
                   <div class="row text-center m-b-20">
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">6000</h2><span class="text-muted">Total sale</span>
                       </div>
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">4000</h2><span class="text-muted">Iphone</span>
                       </div>
                       <div class="col-lg-4 col-md-4 m-t-20">
                           <h2 class="m-b-0 font-light">2000</h2><span class="text-muted">Ipad</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-lg-4">
           <div class="card">
               <div class="card-body">
                   <h5 class="card-title">Today's Schedule</h5>
                   <h6 class="card-subtitle">check out your daily schedule</h6>
                   <div class="steamline m-t-40">
                       <div class="sl-item">
                           <div class="sl-left bg-success"> <i class="fa fa-user"></i></div>
                           <div class="sl-right">
                               <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                               <div class="desc">you can write anything </div>
                           </div>
                       </div>
                       <div class="sl-item">
                           <div class="sl-left bg-info"><i class="fa fa-image"></i></div>
                           <div class="sl-right">
                               <div class="font-medium">Send documents to Clark</div>
                               <div class="desc">Lorem Ipsum is simply </div>
                           </div>
                       </div>
                       <div class="sl-item">
                           <div class="sl-left"> <img class="img-circle" alt="user" src=""> </div>
                           <div class="sl-right">
                               <div class="font-medium">John Doe <span class="sl-date"> 5pm</span></div>
                               <div class="desc">Call today with gohn doe </div>
                           </div>
                       </div>
                       <div class="sl-item">
                           <div class="sl-left"> <img class="img-circle" alt="user" src=""> </div>
                           <div class="sl-right">
                               <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                               <div class="desc">Contrary to popular belief</div>
                           </div>
                       </div>
                       <div class="sl-item">
                           <div class="sl-left"> <img class="img-circle" alt="user" src=""> </div>
                           <div class="sl-right">
                               <div><a href="#">Tiger Sroff</a> <span class="sl-date">5 minutes ago</span></div>
                               <div class="desc">Approve meeting with tiger
                                 <br>
                                 <a href="javascript:void(0)" class="btn m-t-10 m-r-5 btn-rounded btn-outline-success">Apporve</a>
                                 <a href="javascript:void(0)" class="btn m-t-10 btn-rounded btn-outline-danger">Refuse</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Invoice</h4>
                  <h6 class="card-subtitle">You can see the latest invoice</h6>
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
  </div>
</template>

<script>
  export default {
    data(){
      return {
        data : {}
      }
    },
    mounted(){
      this.getDataDashboard();
      const ctx = document.getElementById('planet-chart');
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ['October', 'November', 'December', 'January', 'February', 'March', 'April'],
              datasets: [{
                  label: '# Seling Prosentase',
                  data: [95, 89, 47, 85, 22, 53, 68],
                  backgroundColor: 'rgba(116, 96, 238, 0.2)',
                  borderColor: '#7460EE',
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                    stacked: true
                  }]
              }
          }
      });
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
      createChart(chartId, chartData) {
          const ctx = document.getElementById(chartId);
          const myChart = new Chart(ctx, {
            type: chartData.type,
            data: chartData.data,
            options: chartData.options,
          });
        }
    }
  }
</script>
