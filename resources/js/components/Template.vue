<template>
<div>
  <div v-if="$store.state.isLoggedIn">
      <notifications position="top center" style="padding: 20px;"></notifications>
      <div id="main-wrapper">
      <navbar></navbar>
      <sidebar></sidebar>
      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer font-italic text-muted" style="font-size: 13px">
      &copy; Kasiertansi 2019 zitech team;
    </footer>
  </div>
  <div v-else>
    <router-view></router-view>
  </div>
</div>
</template>
<script>
  export default {
      data() {
        return {

        }
      },
      mounted(){
      },
    }
</script>

