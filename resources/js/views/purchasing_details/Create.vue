<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form>
        <div class="form-group">
          <label for="name" class="col-form-label">Select Item</label>
          <div class="row col-md-12">
          <div class="col-md-11 col-sm-11 pl-0">
            <v-select multiple :options="itemsData" label="name" value="id" v-model="items.item"></v-select>
          </div>
          <div class="col-md-1 col-sm-1 p-0 float-right">
            <router-link :to="{ name: 'item.create' }" class="btn btn-primary btn-group-lg h-100 w-100" type="button">
              <i class="icon icon-plus"></i> <span>Item</span>
            </router-link>
          </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea class="form-control" v-model="items.description"></textarea>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button v-on:click.prevent="storePurchasingDetail()" type="submit" class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'purchase' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        items : {
          item : '',
          description : ''
        },
        itemsData : [],
        errors : []
      }
    },
    mounted(){
      this.createPurchasingDetail();
    },

    methods:{
      createPurchasingDetail(){
        let id = this.$route.params.id
        axios.get(route('purchasing_detail.create', id), {

        })
        .then((response) =>{
          this.itemsData = response.data
          console.log(this.itemsData)
        })
        .catch((response) =>{

        });
      },
      storePurchasingDetail(){
        let id = this.$route.params.id
        axios.post(route('purchasing_detail.store', id), {
          purchase_id : id,
          itemsData : this.items.item
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Purchasing Detail'
          });
           this.$router.replace('/purchase/'+id+'/purchasing_detail');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
         });
      }
    }
  }
</script>
