<template>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <h3>Puchasing Detail</h3>
        </div>
      </div>
      <div class="col-md-12 col-xl-12">
        <div class="">
          <div class="col mt-2">
            <b-button v-b-modal.modal-1 variant="primary"><i class="icon icon-plus"></i> Add New Item</b-button>
          </div>
        </div>
        <div class="row p-2">
          <div class="col-md-3">
            <v-select :onSearch="getItemsData" :options="items" label="name" value="id" placeholder="Type 2 Character"
            v-model="changeItem" @change="getDetailPriceItems()"></v-select>
          </div>
          <div class="col-md-6">
            <input type="text" readonly v-model="itemReadonly.name" class="form-control col-md-3 ">
            <input type="number" placeholder="Stock" v-model="itemReadonly.qty" class="form-control col-md-3 "
            @keyup="calculatePrice()">
            <input type="text" placeholder="Price" min="1" readonly v-model="itemReadonly.price"
            class="form-control col-md-3 ">
            <b-button v-b-modal.modal-2 variant="primary" class=""
            :class="!itemReadonly.id ? 'cursor-disabled disabled' : ''"
            v-model="itemReadonly.id">$ Set Price</b-button>
          </div>
          <div class="col-md-3">
            <input type="text" placeholder="Total Price" min="1" readonly v-model="itemReadonly.total_price"
            class="form-control col-md-10 ">
            <button class="btn btn-primary  float-right"
              :class="!itemReadonly.id ? 'disabled cursor-disabled' : ''"
              @click="storePurchasingDetail()">
              <i class="icon icon-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
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
            <tr v-for="(purchasing, index) in purchasingData">
              <td>{{ ++index }}</td>
              <td>{{ purchasing.item.code }}</td>
              <td>{{ purchasing.item.name }}</td>
              <td>{{ purchasing.qty }}</td>
              <td>{{ purchasing.item.price.initial_price }}</td>
              <td>{{ purchasing.total_price }}</td>
              <td class="text-right pr-0">
                <button @click="!purchase.is_paid ? deletePuchase(purchasing.id) : ''"
                class="btn btn-danger btn-sm" title="Cancel"
                :class="purchase.is_paid ? 'disabled cursor-disabled' : ''">
                  <i class="icon icon-close"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td><b>Total :</b></td>
              <td colspan="2"><b>{{ purchasingData.length > 0 ? purchasingData[0].total_qty : 0 }}</b></td>
              <td><b>{{ purchasingData.length > 0 ? purchasingData[0].total_price_value : 0 }}</b></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12 p-0">
          <button class="btn btn-primary btn-sm float-right"
          :class="purchase.is_paid ? 'disabled cursor-disabled' : ''"
          @click="!purchase.is_paid ? paidPurchasing(purchase.id) : ''">
            {{ purchase.is_paid ? '$ Paid' : '$ Pay' }}
          </button>
          <button class="btn btn-danger btn-sm float-right mr-2">
            <i class="icon icon-trash"></i> Trash
          </button>
          <button class="btn btn-info btn-sm float-right mr-2"
          :class="!purchase.is_paid ? 'disabled cursor-disabled' : ''"
          @click="purchase.is_paid ? paidPurchasing(purchase.id) : ''">
            <i class="icon icon-pencil"></i> Update
          </button>
        </div>
      </div>
    </div>
    <b-modal id="modal-1" size="lg" title="Create New Item" @ok="createItems()">
        <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <form>
              <div class="form-group">
                <label for="name" class="col-form-label">Category</label>
                <v-select :onSearch="getCreateDataItems" :options="categoriesData" label="name" placeholder="Type 2 Character"
                :class="errors.category_id ? 'is-invalid' : ''" value="id" v-model="item.category_id"/>
                <div v-if="errors.name">
                  <span class="text-danger">{{ errors.category_id[0] }}</span>
                </div>
              </div>
              <div class="form-group">
               <label for="name" class="col-form-label">Unit</label>
                <v-select :onSearch="getCreateDataItems" :options="unitsData" label="unit" value="id" selected="name"
                placeholder="Type 2 Character"
                v-model="item.unit_id"/>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Code</label>
                <input id="name" type="text" class="form-control" :class="errors.code ? 'is-invalid' : ''"
                v-model="item.code">
                <div v-if="errors.code">
                  <span class="text-danger">{{ errors.code[0] }}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="item.name">
                <div v-if="errors.name">
                  <span class="text-danger">{{ errors.name[0] }}</span>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="col-form-label">Qty</label>
              <input id="name" type="text" class="form-control" :class="errors.qty ? 'is-invalid' : ''" v-model="item.qty">
              <div v-if="errors.qty">
                <span class="text-danger">{{ errors.qty[0] }}</span>
              </div>
            </div>
            <div class="form-group">
              <label>Initial Price</label>
              <input type="number" class="form-control" v-model="price.initial_price">
            </div>
            <div class="form-group">
              <label>Selling Price</label>
              <input type="number" class="form-control" v-model="price.selling_price">
            </div>
          </div>
        </div>
      </div>
    </b-modal>
    <b-modal :id="this.itemReadonly.id ? 'modal-2' : ''" title="Set Price per Stock" @ok="setPrice()">
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
          unit_id : '',
          qty : ''
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
      this.getPurchasingDetails(this.purchase.id);
    },
    methods :{
      paidPurchasing(id){
        if (this.purchasingData.length == 0) {
          this.$notify({
            type: 'warning',
            text: 'Add Your item before pay!'
          });
        }else {
          axios.put(RouteService.getUrl(route('paid_purchase', id)))
          .then((response) =>{
            if (!this.purchase.is_paid) {
              console.log('ok')
              this.$notify({
                type: 'success',
                text: 'Success Paid Purchasing Order'
              });
            }
            this.getPurchasingDetails(id);
          })
          .catch((response) =>{

          })
        }
      },
      storePurchasingDetail(){
        let id = this.$route.params.id
        if (this.purchase.is_paid || !this.itemReadonly.id) {
          this.$notify({
            type: 'warning',
            text: "You can't add item!"
          });
        }else {
          axios.post(RouteService.getUrl(route('purchasing_detail.store', id)), {
            purchase_id : id,
            item_id : this.itemReadonly.id,
            qty : this.itemReadonly.qty,
            total_price : this.itemReadonly.total_price,
          })
           .then((response) => {
            this.getPurchasingDetails(this.purchase.id);
            this.$notify({
              type: 'success',
              text: 'Success Create Purchasing Detail'
            });
            this.changeItem = '';
            this.itemReadonly.id = '';
            this.itemReadonly.qty = '';
            this.itemReadonly.total_price = '';
            this.itemReadonly.price = '';
           })
           .catch((response) =>{
             if(response.response.status == 500) alert('Something Goes Wrong');
             this.errors = response.response.data.errors;
           });
        }
      },

      setPrice(){
        axios.post(RouteService.getUrl(route('price.store', this.itemReadonly.id)),{
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

      getCreateDataItems(query){
        axios.get(RouteService.getUrl(route('item.create')+ '?query='+query))
        .then((response) =>{
          this.categoriesData = response.data.categories
          this.unitsData = response.data.units
        })
        .catch((response) =>{

        })
      },

      createItems(){
        axios.post(RouteService.getUrl(route('item.store')), {
          name : this.item.name,
          code : this.item.code,
          category_id : this.item.category_id.id,
          unit_id : this.item.unit_id.id,
          current_stock : this.item.qty
        })
         .then((response) => {
            this.$notify({
              type: 'success',
              text: 'Success Create Items'
            });
            this.itemReadonly.id = response.data.id;
            this.itemReadonly.qty = this.item.qty;
            this.itemReadonly.total_price = this.item.qty * this.price.initial_price;
            this.setPrice();
            this.storePurchasingDetail();
            this.item.name = '';
            this.item.code = '';
            this.item.qty = '';
            this.item.category_id = '';
            this.item.unit_id.id = '';
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
          axios.get(RouteService.getUrl(route('get.price', this.changeItem.id)),{

          })
          .then((response) =>{
            this.itemReadonly.price = response.data.initial_price
          })
          .catch((response) =>{

          })
      },

      getItemsData(search){
        if (search.length >= 1) {
          axios.get(RouteService.getUrl(route('item.search', search)))
          .then((response) =>{
            this.items = response.data
          })
          .catch((response) =>{

          })
        }else{
          this.items = null
        }
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
      },

      deletePuchase(id){
        var bool = confirm('You Wanna Cancel this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('purchasing_detail.destroy', [this.purchase.id, id])))
          .then((response) =>{
            this.getPurchasingDetails(this.purchase.id)
            this.$notify({
              type: 'success',
              text: 'Deleted!'
            });
          })
          .catch((response) =>{

          })
        }
      },
    }
  }
</script>
