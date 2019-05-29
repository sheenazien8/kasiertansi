<template>
  <aside class="left-sidebar">
      <div class="d-flex no-block nav-text-box align-items-center">
          <span><h3 class="title-logo">KasierTansi</h3></span>
          <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)">
            <i class="icon icon-menu"></i>
          </a>
          <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)">
            <i class="ti-menu ti-close"></i>
          </a>
      </div>
      <div class="scroll-sidebar">
          <nav class="sidebar-nav" id="accordion">
              <ul id="sidebarnav">
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{name : 'dashboard'}" style="font-size: 15px;">
                      Dashboard <span><i class="bg-square icon icon-speedometer"></i></span>
                    </router-link>
                  </li>
                <li class="nav-item">
                  <a class="nav-link pembelian-menu" href="index.html" style="font-size: 15px;"
                    data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                    Pembelian <span><i class="bg-square icon icon-bag"></i></span>
                  </a>
                  <div id="submenu-1" class="collapse submenu pembelian" style="" data-parent="#accordion">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                          <router-link :to="{ name : 'purchase' }" class="nav-link" >
                            PO Pembelian <span class="bg-square float-right">PO</span>
                          </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                  <li class="nav-item active">
                    <a class="nav-link penjualan" href="index.html" style="font-size: 15px;"
                      data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
                      Penjualan <span><i class="bg-square icon icon-handbag"></i></span>
                    </a>
                    <div id="submenu-5" class="collapse submenu" style="" data-parent="#accordion">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link :to="{ name : 'cashier' }" class="nav-link" >Kasir
                              <span class="bg-square float-right">CS</span>
                            </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link data-master" href="index.html" style="font-size: 15px;"
                      data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                      Data Master <i class="bg-square icon icon-layers"></i>
                    </a>
                    <div id="submenu-3" class="collapse submenu" style="" data-parent="#accordion">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link :to="{ name: 'category' }" class="nav-link" >
                              Kategori <i class="bg-square icon icon-pie-chart"></i>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'unit' }" class="nav-link">
                              Unit <i class="bg-square icon icon-login"></i>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'item' }" class="nav-link">
                              Barang <i class="bg-square icon icon-paper-clip"></i>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'supplier' }" class="nav-link">
                              Supplier <i class="bg-square icon icon-directions"></i>
                            </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link pengguna" href="index.html" style="font-size: 15px;"
                      data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                      Pengguna <i class="bg-square icon icon-people"></i>
                    </a>
                    <div id="submenu-4" class="collapse submenu" style="" data-parent="#accordion">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <router-link :to="{ name: 'employee' }" class="nav-link">
                            Karyawan <i class="bg-square icon icon-user-follow"></i>
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link :to="{ name: 'management_permission' }" class="nav-link" >
                            Managemen Permisi <i class="bg-square icon icon-graduation"></i>
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link laporan" href="index.html" style="font-size: 15px;"
                      data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6">
                      Laporan <i class="bg-square icon icon-docs"></i>
                    </a>
                    <div id="submenu-6" class="collapse submenu" style="" data-parent="#accordion">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <router-link :to="{ name: 'spending' }" class="nav-link">
                            Laporan Pengeluaran <i class="bg-square icon icon-doc"></i>
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link :to="{ name: 'income' }" class="nav-link" >
                            Laporan Pendapatan <i class="bg-square icon icon-doc"></i>
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
</template>
<script>
export default{
  data(){
    return {
      permissions : []
    }
  },
  mounted(){
    this.getPermission();
  },
  methods:{
    getPermission(){
      axios.get(RouteService.getUrl(route('details')))
      .then((response) =>{
        this.permissions = response.data.permissions
      })
      .catch((response) =>{

      })
    },
    getPermissionRule(array){
      let self = this
      for (var i = array.length - 1; i >= 0; i--) {
        console.log(self.permissions.includes(array[i]), array[i])
      }
    }
  }
}
</script>
