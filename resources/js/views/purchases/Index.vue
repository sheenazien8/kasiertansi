<template>
<div>
  <breadcrumb title="Pembelian"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <router-link :to="{ name: 'purchase.create' }" class="btn btn-sm btn-success float-right">
            <i class="icon icon-plus my-float"></i>
          </router-link>
          <h3>Daftar Pembelian</h3>
        </div>
      </div>
    </div>
    <div class="card-body" >
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Supplier</th>
              <th scope="col">Nomor Faktur</th>
              <th scope="col">Metode Pembayaran</th>
              <th scope="col">Tanggal Pembayaran</th>
              <th scope="col">Catatan</th>
              <th scope="col">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(purchase, index) in purchases.data">
              <th scope="row">{{ ++index }}</th>
              <td>{{ purchase.supplier.name }}</td>
              <td>{{ purchase.invoice_number }}</td>
              <td>{{ purchase.payment_method }}</td>
              <td>{{ purchase.purchase_date }}</td>
              <td>{{ purchase.note }}</td>
              <td>
                <span class="btn-sm" :class="purchase.is_paid ? 'badge-success' : 'badge-info'">
                  {{ purchase.is_paid ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                </span>
              </td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right" title="delete?" @click="deletePuchase(purchase.id)">
                  <i class="icon icon-trash"></i>
                </button>
                <router-link :to="{ name: 'purchase.edit', params: {id : purchase.id}}" title="edit?"
                class="btn btn-sm p-1 btn-info float-right">
                  <i class="icon icon-pencil"></i>
                </router-link>
                <router-link :to="{ name: 'purchasing_detail.index', params: {id : purchase.id}}"
                title="add purchasing details!" class="btn btn-sm p-1 btn-primary float-right">
                <i class="icon icon-handbag"></i> Detail Pembelian
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <hr>
    </div>
    <div class="d-flex justify-content-center" v-if="purchases.last_page > 1">
      <v-paginate
        :page-count="purchases.last_page"
        :click-handler="pagination"
        :prev-text="'&laquo;'"
        :next-text="'&raquo;'"
        :prev-link-class="'page-link'"
        :next-link-class="'page-link'"
        :container-class="'pagination'"
        :page-class="'page-item'"
        :page-link-class="'page-link'">
      </v-paginate>
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
        pagination(page){
        axios.get(RouteService.getUrl(route('purchase.index', {'page' : page})))
          .then((response) =>{
            this.purchases = response.data
          })
          .catch((response) =>{

          })
      },
      getPuchase(){
        axios.get(RouteService.getUrl(route('purchase.index')))
        .then((response) =>{
          this.purchases = response.data
        })
        .catch((response) =>{

        })
      },
      deletePuchase(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('purchase.destroy', id)),{

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
