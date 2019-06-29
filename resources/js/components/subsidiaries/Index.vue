<template>
<div>
  <breadcrumb title="Cabang"></breadcrumb>
  <div class="card">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header">
          <router-link :to="{ name: 'subsidiary.create' }" class="btn btn-sm btn-success float-right">
            <i class="icon icon-plus my-float"></i>
          </router-link>
          <h3>Daftar Cabang</h3>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Dibangun Pada</th>
                <th scope="col">Ditutup Pada</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(subsidiary, index) in subsidiaries.data">
                <th scope="row">{{ ++index }}</th>
                <td>{{ subsidiary.name }}</td>
                <td>{{ subsidiary.address }}</td>
                <td>{{ subsidiary.built_at }}</td>
                <div class="row">
                  <input type="date" class="form-control-sm col" :id="++index" :value="subsidiary.closed_at"
                  @change="changeStatusSubsidiary($event, subsidiary.id)">
                  <span :class="subsidiary.status ? 'badge-success' : 'badge-danger'" class="col btn-sm">
                    {{ subsidiary.status ? 'Aktif' : 'Tidak Aktif' }}
                  </span>
                </div>
                <td>
                  <button class="btn btn-sm p-1 btn-danger float-right" @click="deleteSubsidiary(subsidiary.id)"><i class="icon icon-trash"></i></button>
                  <router-link :to="{ name: 'subsidiary.edit', params: {id : subsidiary.id}}" class="btn btn-sm p-1 btn-info float-right"><i class="icon icon-pencil"></i></router-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
    </div>
        <div class="d-flex justify-content-center" v-if="subsidiaries.last_page > 1">
          <v-paginate
            :page-count="subsidiaries.last_page"
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
        subsidiaries : []
      }
    },

    mounted(){
      this.getSubsidiary();
    },

    methods:{
      pagination(page){
        axios.get(RouteService.getUrl(route('subsidiary.index', {'page' : page})))
          .then((response) =>{
            this.subsidiaries = response.data
          })
          .catch((response) =>{

          })
      },
      changeStatusSubsidiary(event, subsidiary_id){
        axios.put(RouteService.getUrl(route('subsidiary.update.status', subsidiary_id)),{
          closed_at : event.target.value
        })
        .then((response) =>{
          this.$notify({
            type: 'success',
            text: 'Success Update Status Subsidiary'
          });
          this.getSubsidiary();
        })
        .catch((response) =>{

        })
      },
      getSubsidiary(){
        axios.get(RouteService.getUrl(route('subsidiary.index')))
        .then((response) =>{
          this.subsidiaries = response.data
        })
        .catch((response) =>{

        })
      },
      deleteSubsidiary(id){
        var bool = confirm('You Want to Delete this?');
        if (bool) {
          axios.delete(RouteService.getUrl(route('subsidiary.destroy', id)),{

          })
          .then((response) =>{
            this.getSubsidiary()
          })
          .catch((response) =>{

          })
        }
      },
    }
}
</script>
