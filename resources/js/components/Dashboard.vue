<template>
  <div class="dashboard-main-wrapper">
    <navbar></navbar>
    <sidebar></sidebar>
    <div class="dashboard-wrapper">
      <div class="container-fluid dashboard-content">
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <router-view></router-view>
              </div>
          </div>
      </div>
    </div>
  </div>
</template>
