<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h3 class="text-header">
          Expenditures On {{ incomes[0].date }}
        </h3>
      </div>
      <div class="card-body">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Invoice Number</th>
              <th>Total Qty</th>
              <th>Total Price</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(income, index) in incomes">
              <td>{{ ++index }}</td>
              <td>{{ income.transaction.invoice_number }}</td>
              <td>{{ income.transaction.transaction_details[0].total_qty_value }}</td>
              <td>{{ income.transaction.transaction_details[0].total_price_value }}</td>
              <td>
                <b-button v-b-modal.modal-1 size="sm" variant="info" @click="getTransactionDetails(income.transaction.id)">
                  <i class="icon icon-magnifier"></i> Show Item
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <b-modal size="lg" id="modal-1" title="Lists Item" okOnly="true">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(transaction_detail, index) in transaction_details">
            <td>{{ ++index }}</td>
            <td>{{ transaction_detail.item.code }}</td>
            <td>{{ transaction_detail.item.name }}</td>
            <td>{{ transaction_detail.qty }}</td>
            <td>{{ transaction_detail.total_price }}</td>
          </tr>
        </tbody>
      </table>
    </b-modal>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        incomes : [],
        transaction_details : []
      }
    },

    mounted(){
      this.showPuchase(this.$route.params.date)
    },

    methods:{
      showPuchase(date){
        axios.get(RouteService.getUrl(route('income.show', date)))
        .then((response) =>{
          this.incomes = response.data
          console.log(this.incomes)
        })
        .catch((response) =>{

        })
      },
      getTransactionDetails(id){
        axios.get(route('get.transaction_detail', id))
        .then((response) => {
          this.transaction_details = response.data.transaction_details
          this.transaction = response.data
        })
        .catch((response) => {

        })
      }
    }
  }
</script>
