<template>
  <div class="nav-left-sidebar sidebar-dark">
      <div class="menu-list">
          <nav class="navbar navbar-expand-lg navbar-light">
              <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav flex-column">
                      <li class="nav-divider">
                        <router-link :to="{ name: 'home' }" class="nav-link pl-0"><i class="icon icon-drawer"></i>Dashboard</router-link>
                      </li>
                      <li class="nav-divider">
                          Menu
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>
                            <i class="icon icon-list "></i> Master</a>
                          <div id="submenu-2" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <router-link :to="{ name: 'category' }" class="nav-link">Category</router-link>
                                  </li>
                                  <li class="nav-item">
                                      <router-link :to="{ name: 'unit' }" class="nav-link">Unit</router-link>
                                  </li>
                                  <li class="nav-item">
                                      <router-link :to="{ name: 'item' }" class="nav-link">Item</router-link>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-divider">
                          Features
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6">
                            <i class="fas fa-fw fa-file"></i>Pages</a>
                          <div id="submenu-6" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Invoice</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Blank Page</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Blank Page Header</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Login</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">404 page</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Sign up Page</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Forgot Password</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Pricing Tables</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Timeline</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Calendar</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Sortable/Nestable List</a>
                                  </li>
                                 <li class="nav-item">
                                      <a class="nav-link" href="#">Widgets</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Media Objects</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Cropper</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Color Picker</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-inbox"></i>Apps <span class="badge badge-secondary">New</span></a>
                          <div id="submenu-7" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Inbox</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Email Detail</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Email Compose</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Message Chat</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Icons</a>
                          <div id="submenu-8" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">FontAwesome Icons</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Material Icons</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Simpleline Icon</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Themify Icon</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Flag Icons</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Weather Icon</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-map-marker-alt"></i>Maps</a>
                          <div id="submenu-9" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Google Maps</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Vector Maps</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu Level</a>
                          <div id="submenu-10" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Level 1</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
                                      <div id="submenu-11" class="collapse submenu" style="">
                                          <ul class="nav flex-column">
                                              <li class="nav-item">
                                                  <a class="nav-link" href="#">Level 1</a>
                                              </li>
                                              <li class="nav-item">
                                                  <a class="nav-link" href="#">Level 2</a>
                                              </li>
                                          </ul>
                                      </div>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Level 3</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                  </ul>
              </div>
          </nav>
      </div>
  </div>
</template>
