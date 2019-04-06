<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h3 class="text-header">
          Expenditures On {{ spendings[0].date }}
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
            <tr v-for="(spending, index) in spendings">
              <td>{{ ++index }}</td>
              <td>{{ spending.purchase.invoice_number }}</td>
              <td>{{ spending.purchase.purchasing_details[0].total_qty }}</td>
              <td>{{ spending.purchase.purchasing_details[0].total_price_value }}</td>
              <td>
                <b-button v-b-modal.modal-1 size="sm" variant="info" @click="getPurchasingDetails(spending.purchase.id)">
                  <i class="icon icon-magnifier"></i> Show Item
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <b-modal size="lg" id="modal-1" title="Lists Item" ok-only="true">
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
          <tr v-for="(purchasing_detail, index) in purchasing_details">
            <td>{{ ++index }}</td>
            <td>{{ purchasing_detail.item.code }}</td>
            <td>{{ purchasing_detail.item.name }}</td>
            <td>{{ purchasing_detail.qty }}</td>
            <td>{{ purchasing_detail.total_price }}</td>
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
        spendings : [],
        purchasing_details : []
      }
    },

    mounted(){
      this.showPuchase(this.$route.params.date)
    },

    methods:{
      showPuchase(date){
        axios.get(route('spending.show', date),{

        })
        .then((response) =>{
          this.spendings = response.data
          console.log(this.spendings)
        })
        .catch((response) =>{

        })
      },
      getPurchasingDetails(id){
        axios.get(route('get.purchasing_detail', id))
        .then((response) => {
          this.purchasing_details = response.data.purchasing_details
          this.purchase = response.data
        })
        .catch((response) => {

        })
      }
    }
  }
</script>
