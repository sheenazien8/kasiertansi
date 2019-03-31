<template>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Puchasing Detail</h3>
        </div>
      </div>
      <div class="col-md-12 col-xl-12 mt-1">
        <div class="row mb-1">
          <div class="col">
          <b-button v-b-modal.modal-1 variant="primary"><i class="icon icon-plus"></i> Add New Item</b-button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <v-select :options="items" label="name" value="id" v-model="changeItem" @change="getDetailPriceItems()"></v-select>
          </div>
          <div class="col-md-6 p-0">
            <input type="text" readonly v-model="itemReadonly.name" class="form-control col-md-3 h-100">
            <input type="number" placeholder="Stock" v-model="itemReadonly.qty" class="form-control col-md-3 h-100"
            @keyup="calculatePrice()">
            <input type="number" placeholder="Price" min="1" readonly v-model="itemReadonly.price"
            class="form-control col-md-3 h-100">
            <b-button v-b-modal.modal-2 variant="primary" class="h-100"
            :class="!itemReadonly.id ? 'cursor-disabled disabled' : ''"
            v-model="itemReadonly.id">$ Set Price</b-button>
          </div>
          <div class="col-md-3">
            <input type="number" placeholder="Total Price" min="1" readonly v-model="itemReadonly.total_price"
            class="form-control col-md-10 h-100">
            <button class="btn btn-primary h-100 float-right" @click="storePurchasingDetail()">
              <i class="icon icon-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-2">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total Price</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="purchasing in purchasingData">
              <td>1</td>
              <td>{{ purchasing.item.code }}</td>
              <td>{{ purchasing.item.name }}</td>
              <td>{{ purchasing.qty }}</td>
              <td>{{ purchasing.item.price.initial_price }}</td>
              <td>{{ purchasing.total_price }}</td>
              <td class="text-right">
                <button class="btn btn-danger btn-sm" title="Cancel">
                  <i class="icon icon-close"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td><b>Total :</b></td>
              <td colspan="2"><b>20</b></td>
              <td><b>220000</b></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button class="btn btn-primary btn-sm float-right"
          :class="purchase.is_paid ? 'disabled cursor-disabled' : ''"
          @click="!purchase.is_paid ? paidPurchasing(purchase.id) : ''">
            {{ purchase.is_paid ? '$ Paid' : '$ Pay' }}
          </button>
          <button class="btn btn-danger btn-sm float-right mr-2">
            <i class="icon icon-trash"></i> Trash
          </button>
        </div>
      </div>
    </div>
    <b-modal id="modal-1" title="Create New Item" @ok="createItems()">
      <form>
        <div class="form-group">
            <label for="name" class="col-form-label">Category</label>
            <v-select :options="categoriesData" label="name" :class="errors.category_id ? 'is-invalid' : ''" value="id" v-model="item.category_id"/>
            <div v-if="errors.name">
              <span class="text-danger">{{ errors.category_id[0] }}</span>
            </div>
        </div>
        <div class="form-group">
         <label for="name" class="col-form-label">Unit</label>
            <v-select :options="unitsData" label="unit" value="id" selected="name" v-model="item.unit_id"/>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Code</label>
            <input id="name" type="text" class="form-control" :class="errors.code ? 'is-invalid' : ''" v-model="item.code">
        </div>
        <div v-if="errors.code">
          <span class="text-danger">{{ errors.code[0] }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="item.name">
        </div>
        <div v-if="errors.name">
          <span class="text-danger">{{ errors.name[0] }}</span>
        </div>
      </form>
    </b-modal>
    <b-modal :id="this.itemReadonly.id ? 'modal-2' : ''" title="Set Price" @ok="setPrice()">
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
</template>
<script>
  export default {
    data(){
      return{
        purchase :{
          id : this.$route.params.id,
          is_paid : ''
        },
        changeItem : '',
        items : [],
        purchasingData : [],
        itemReadonly : {
          name : '',
          qty : '',
          price : '',
          total_price : '',
          id : '',
        },
        item : {
          name : '',
          code : '',
          category_id : '',
          unit_id : ''
        },
        price : {
          initial_price : '',
          selling_price : ''
        },
        categoriesData : [],
        unitsData : [],
        errors : []
      }
    },
    mounted(){
      this.getItemsData();
      this.getCreateDataItems();
      this.getPurchasingDetails(this.purchase.id);
    },
    methods :{
      paidPurchasing(id){
        axios.put(route('paid_purchase', id),{

        })
        .then((response) =>{
          this.getPurchasingDetails(id);
          this.$notify({
            type: 'success',
            text: 'Success Paid Purchasing'
          });
        })
        .catch((response) =>{

        })
      },
      storePurchasingDetail(){
        let id = this.$route.params.id
        axios.post(route('purchasing_detail.store', id), {
          purchase_id : id,
          item_id : this.itemReadonly.id,
          qty : this.itemReadonly.qty,
          total_price : this.itemReadonly.total_price,
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Purchasing Detail'
          });
          this.getPurchasingDetails(this.purchase.id);
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
         });
      },

      setPrice(){
        axios.post(route('price.store', this.itemReadonly.id),{
          initial_price : this.price.initial_price,
          selling_price : this.price.selling_price
        })
        .then((response) =>{
          this.itemReadonly.price = this.price.initial_price;
          this.calculatePrice();
          this.$notify({
            type: 'success',
            text: 'Success Set Price'
          });
          this.price.initial_price = ''
          this.price.selling_price = ''
        })
        .catch((response) =>{

        })
      },

      getCreateDataItems(){
        axios.get(route('item.create'),{

        })
        .then((response) =>{
          this.categoriesData = response.data.categories
          this.unitsData = response.data.units
        })
        .catch((response) =>{

        })
      },

      createItems(){
        axios.post(route('item.store'), {
          name : this.item.name,
          code : this.item.code,
          category_id : this.item.category_id.id,
          unit_id : this.item.unit_id.id
        })
         .then((response) => {
          this.getItemsData();
          this.item.name = '';
          this.item.code = '';
          this.item.category_id = '';
          this.item.unit_id.id = '';
          this.$notify({
            type: 'success',
            text: 'Success Create Items'
          });
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
        },

        calculatePrice(){
          this.itemReadonly.total_price = this.itemReadonly.qty * this.itemReadonly.price;
        },

        getDetailPriceItems(){
          this.itemReadonly.name = this.changeItem.name
          this.itemReadonly.id = this.changeItem.id
          axios.get(route('get.price', this.changeItem.id),{

          })
          .then((response) =>{
            this.itemReadonly.price = response.data.initial_price
          })
          .catch((response) =>{

          })
      },

      getItemsData(){
        axios.get(route('item.index'), {

        })
        .then((response) =>{
          this.items = response.data
        })
        .catch((response) =>{

        })
      },

      getPurchasingDetails(id){
        axios.get(route('purchasing_detail.index', this.purchase.id),{

        })
        .then((response) =>{
          this.purchasingData = response.data
          this.purchase.is_paid = response.data[0].purchase.is_paid
        })
        .catch((response) =>{

        });
      }
    }
  }
</script>
