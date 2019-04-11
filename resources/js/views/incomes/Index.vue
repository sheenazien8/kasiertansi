<template>
<div>
  <breadcrumb title="Income"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Income List per Tanggal</h3>
        </div>
      </div>
    </div>
    <div class="card-body" >
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Total Price</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(income, index) in incomes">
              <th scope="row">{{ ++index }}</th>
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
