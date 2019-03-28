<template>
  <aside class="left-sidebar">
      <div class="d-flex no-block nav-text-box align-items-center">
          <span><img src="#" alt="elegant admin template"></span>
          <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="icon icon-menu"></i></a>
          <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
      </div>
      <div class="scroll-sidebar">
          <nav class="sidebar-nav">
              <ul id="sidebarnav">
                <li class="nav-item active">
                  <a class="nav-link" href="index.html" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                    Purchasing <i style="font-size: 11px;" class="icon icon-cloud-download"></i>
                  </a>
                  <div id="submenu-1" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                          <router-link :to="{ name : 'purchase' }" class="nav-link" >Purhcase Order <i class="icon icon-handbag"></i></router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.html" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                      Master <i style="font-size: 11px;" class="icon icon-layers"></i>
                    </a>
                    <div id="submenu-3" class="collapse submenu" style="">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link :to="{ name: 'category' }" class="nav-link" >Catergory <i class="icon icon-pie-chart"></i></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'unit' }" class="nav-link">Unit <i class="icon icon-login"></i></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'item' }" class="nav-link">Item <i class="icon icon-paper-clip"></i></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'supplier' }" class="nav-link">Supplier <i class="icon icon-directions"></i></router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.html" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                      User <i style="font-size: 11px;" class="icon icon-people"></i>
                    </a>
                    <div id="submenu-4" class="collapse submenu" style="">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <router-link :to="{ name: 'employee' }" class="nav-link">Employee <i class="icon icon-user-follow"></i></router-link>
                        </li>
                        <li class="nav-item">
                          <router-link :to="{ name: 'role_permission' }" class="nav-link" >Management Pemission <i class="icon icon-graduation"></i></router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
</template>
