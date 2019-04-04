<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h3 class="text-header">
          Expenditures On {{ spendings.date }}
        </h3>
      </div>
      <div class="card-body">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Total Qty</th>
              <th>Total Price</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(spending, index) in spendings">
              <td>{{ ++index }}</td>
              <td>{{ spending }}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
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
    }
  }
</script>
