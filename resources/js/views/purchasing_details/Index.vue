<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Puchasing List</h3>
          <router-link :to="{ name: 'purchase.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
        </div>
      </div>
    </div>
    <div class="card-body" >
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Supplier Name</th>
              <th scope="col">Invoice Number</th>
              <th scope="col">Payment Method</th>
              <th scope="col">Date</th>
              <th scope="col">Note</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="purchase in purchases">
              <th scope="row">1</th>
              <td>{{ purchase.supplier.name }}</td>
              <td>{{ purchase.invoice_number }}</td>
              <td>{{ purchase.payment_method }}</td>
              <td>{{ purchase.purchase_date }}</td>
              <td>{{ purchase.note }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right mr-2" title="delete?" @click="deletePuchase(purchase.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'purchase.edit', params: {id : purchase.id}}" title="edit?" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
                <router-link :to="{ name: 'purchase.add_detail_purchasing', params: {id : purchase.id}}" title="add purchasing details!" class="btn btn-sm p-1 btn-primary float-right mr-2"><i class="icon icon-handbag"></i></router-link>
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
        purchases : []
      }
    },

    mounted(){
      this.getPuchase()
    },

    methods:{
      getPuchase(){
        axios.get(route('purchase.index'),{

        })
        .then((response) =>{
          this.purchases = response.data
        })
        .catch((response) =>{

        })
      },
      deletePuchase(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('purchase.destroy', id),{

          })
          .then((response) =>{
            this.getPuchase()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
