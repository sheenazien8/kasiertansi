<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="updateUnit()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" type="text" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="unit.unit">
            <div v-if="errors.name">
              <span class="text-danger">{{ errors.name[0] }}</span>
            </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'unit' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        unit : {
          unit : ''
        },
        unitsData : [],
        errors : []
      }
    },

    mounted(){
      this.editUnit(this.$route.params.id)
    },

    methods:{
      updateUnit(){
        axios.put(route('unit.update', this.$route.params.id), {unit : this.unit.unit})
         .then((response) => {
           this.$router.replace('/unit');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      },
      editUnit(id){
        axios.get(route('unit.edit', id))
        .then((response)=>{
          this.unitsData = response.data
          this.unit.unit = this.unitsData.unit
        })
        .catch((response) =>{

        })
      }
    }
  }
</script>
