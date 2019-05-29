<template>
<div>
  <breadcrumb title="Unit"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <h3 class="card-header">
          Daftar Satuan
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
              <th scope="col">Nama</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(unit, index) in units.data">
              <th scope="row">{{ ++index }}</th>
              <td>{{ unit.unit }}</td>
              <td>
                <button class="btn btn-sm p-1 btn-danger float-right" @click="deleteUnit(unit.id)"><i class="icon icon-trash"></i></button>
                <router-link :to="{ name: 'unit.edit', params: {id : unit.id}}" class="btn btn-sm p-1 btn-info float-right"><i class="icon icon-pencil"></i></router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center" v-if="units.last_page > 1">
        <v-paginate
          :page-count="units.last_page"
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
       pagination(page){
        axios.get(RouteService.getUrl(route('unit.index', {'page' : page})))
          .then((response) =>{
            this.units = response.data
            console.log(this.units)
          })
          .catch((response) =>{

          })
        console.log(page)
      },
      getUnit(){
        axios.get(RouteService.getUrl(route('unit.index')))
        .then((response) =>{
          this.units = response.data
        })
        .catch((response) =>{

        })
      },
      deleteUnit(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('unit.destroy', id)))
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
