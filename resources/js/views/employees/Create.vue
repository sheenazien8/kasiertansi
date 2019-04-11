<template>
  <div>
    <breadcrumb title="Employee Create"></breadcrumb>
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="createEmployee()">
        <div class="form-group">
            <label for="name" class="col-form-label">Name *</label>
            <input id="name" type="text" class="form-control"  v-model="employee.name">
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Email *</label>
            <input id="name" type="email" class="form-control"  v-model="employee.email">
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Join Date *</label>
            <input id="name" type="date" class="form-control"  v-model="employee.join_date">
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">Password</label> <span style="font-size: 11px;">empty to use default password(12345678)</span>
            <input id="name" type="password" class="form-control"  v-model="employee.password">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-sm btn-rounded btn-block col-md-6 col-sm-3 btn-outline-primary">Save</button>
            </div>
            <div class="col-md-6">
              <router-link :to="{ name: 'employee' }" class="btn btn-sm float-right btn-rounded btn-block col-md-6 col-sm-3 btn-outline-info" >Cancel</router-link>
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
        employee : {
          name : '',
          email : '',
          password : '',
          join_date : ''
        }
      }
    },

    mounted(){

    },

    methods:{
      createEmployee(){
        axios.post(RouteService.getUrl(route('employee.store')), {
          name : this.employee.name,
          email : this.employee.email,
          join_date : this.employee.join_date,
          password : this.employee.password,
        })
         .then((response) => {
          this.$notify({
            type: 'success',
            text: 'Success Create Employee'
          });
           this.$router.replace('/employee');
         })
         .catch((response) =>{
           if(response.response.status == 500) alert('Something Goes Wrong');
           this.errors = response.response.data.errors;
           console.log(response);
         });
      }
    }
  }
</script>
