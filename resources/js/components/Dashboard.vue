<template>
  <div id="main-wrapper">
    <navbar></navbar>
    <sidebar></sidebar>
    <div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Blank Page</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                    <router-link :to="{  }" type="button" class="btn btn-success d-none d-lg-block m-l-15">
                      <i class="icon icon-plus"></i> Add
                    </router-link>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
  </div>
</div>
</template>
