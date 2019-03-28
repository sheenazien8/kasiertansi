<template>
<div>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <h3 class="card-header">
          Unit List
        </h3>
          <router-link :to="{ name: 'unit.create' }" class="float"><i class="icon icon-plus my-float"></i></router-link>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="unit in units">
              <th scope="row">1</th>
              <td>{{ unit.unit }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right mr-2" @click="deleteUnit(unit.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'unit.edit', params: {id : unit.id}}" class="btn btn-sm p-1 btn-info float-right mr-2"><i class="icon icon-pencil"></i></router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
    data() {
      return {
        units : []
      }
    },

    mounted(){
      this.getUnit()
    },

    methods:{
      getUnit(){
        axios.get(route('unit.index'),{

        })
        .then((response) =>{
          this.units = response.data
        })
        .catch((response) =>{

        })
      },
      deleteUnit(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(route('unit.destroy', id),{

          })
          .then((response) =>{
            this.getUnit()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
