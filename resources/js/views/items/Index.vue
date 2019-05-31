<template>
<div>
  <breadcrumb title="Barang"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <h3 class="card-header">
          Daftar Barang
          <router-link :to="{ name: 'item.create' }" class="btn btn-sm btn-success float-right">
            <i class="icon icon-plus my-float"></i>
          </router-link>
          <button @click="triggerUpload()" class="btn btn-sm btn-primary float-right">
            <i class="icon icon-doc"></i>  Import Excel
          </button>
          <input ref="importFile" type="file" style="opacity: 0" v-on:change="importExcel">
          <download-csv class="btn btn-sm btn-primary float-right"
              :data = "json_data"
              name = "template-barang.csv">
                <i class="icon icon-cloud-download"></i> Unduh Template
          </download-csv>
        </h3>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Kategori</th>
              <th scope="col">Kode</th>
              <th scope="col">Stock Terakhir</th>
              <th scope="col">Harga Beli</th>
              <th scope="col">Harga Jual</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items.data">
              <th scope="row">{{ ++index }}</th>
              <td>{{ item.name }}</td>
              <td>{{ item.category.name }}</td>
              <td>{{ item.code }}</td>
              <td :class="item.current_stock <= 0 ? 'bg-danger': ''">
                {{ item.current_stock != 0 && item.current_stock ? item.current_stock : 'OUT OF STOCK!'}}
            </td>
              <td>
                  {{ item.price ? formatPrice(item.price.initial_price) : '' }}
              </td>
              <td>
                  {{ item.price ? formatPrice(item.price.selling_price) : '' }}
              </td>
              <td>
                <button title="Delete Item" class="btn btn-sm p-1 btn-danger float-right"
                  @click="deleteItem(item.id)">
                  <i class="icon icon-trash"></i>
                </button>
                <router-link title="Edit Item" :to="{ name: 'item.edit', params: {id : item.id}}"
                  class="btn btn-sm p-1 btn-info float-right">
                  <i class="icon icon-pencil"></i>
                </router-link>
                <b-button v-b-modal.modal-1 variant="warning" size="sm" class="float-right"
                  @click="getId(item.id)">
                  $ Ubah Harga
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
     </div>
     <div class="d-flex justify-content-center" v-if="items.last_page > 1">
        <v-paginate
          :page-count="items.last_page"
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
  <div>
    <b-modal id="modal-1" title="BootstrapVue" @ok="setPrice()">
      <form>
        <div class="form-group">
            <label>Initial Price</label>
            <input type="number" class="form-control" v-model="price.initial_price">
        </div>
        <div class="form-group">
            <label>Selling Price</label>
            <input type="number" class="form-control" v-model="price.selling_price">
        </div>
      </form>
    </b-modal>
  </div>
</div>
</template>
<script>
import NumberMixins from './../../services/NumberMixins.js';

export default {
    mixins : [NumberMixins],
    data() {
      return {
        items : [],
        price : {
          initial_price : '',
          selling_price : ''
        },
        item_id : '',
        json_data: [
                    {
                        '<b>Nama Barang</b>': '',
                        '<b>Kategori</b>': '',
                        '<b>unit</b>': '',
                        '<b>Stok Terakhir</b>': '',
                        '<b>Harga Beli</b>': '',
                        '<b>Harga Jual</b>': '',
                    }
                ]
      }
    },

    mounted(){
      this.getItem()
    },

    methods:{
       pagination(page){
        axios.get(RouteService.getUrl(route('item.index', {'page' : page})))
          .then((response) =>{
            this.items = response.data
          })
          .catch((response) =>{

          })
      },
      getId(id){
        this.item_id = id
      },
      setPrice(){
        axios.post(RouteService.getUrl(route('price.store', this.item_id)),{
          initial_price : this.price.initial_price,
          selling_price : this.price.selling_price
        })
        .then((response) =>{
          this.$notify({
            type: 'success',
            text: 'Success Set Price'
          });
          this.price.initial_price = ''
          this.price.selling_price = ''
          this.getItem();
        })
        .catch((response) =>{

        })
      },
      getItem(){
        axios.get(RouteService.getUrl(route('item.index')),{

        })
        .then((response) =>{
          this.items = response.data
        })
        .catch((response) =>{

        })
      },
      deleteItem(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('item.destroy', id)),{

          })
          .then((response) =>{
            this.$notify({
              type: 'success',
              text: 'Success delete Items'
            });
            this.getItem()
          })
          .catch((response) =>{

          })
        }
      },
      importExcel(e){
        let formData = new FormData()
        formData.append('file', e.target.files[0]);
        axios.post(RouteService.getUrl(route('item.import')),formData,{
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) =>{
          this.$notify({
            type: 'success',
            text: 'Success Import Items'
          });
          this.getItem()
        })
        .catch((response) => {

        })
      },
      triggerUpload(){
        this.$refs.importFile.click();
      },
    }
}
</script>
