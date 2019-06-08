
require('./bootstrap');
require('jquery-ujs');
require('print-js');
// require('tempusdominus-bootstrap-4');
import Notifications from 'vue-notification';
import VSelect from 'vue-select';
import BootstrapVue from 'bootstrap-vue';
import Paginate from 'vuejs-paginate';
import RouteService from './services/RouteService';
import TitleService from './services/TitleService';
import Chart from 'chart.js';
import JsonCSV from 'vue-json-csv'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import {routes} from './router/routes'
import StoreData from './store'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

window.RouteService = RouteService;
window.TitleService = TitleService;
Vue.prototype.$eventBus = new Vue();

Vue.use(Notifications)
Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(Loading);

Vue.component('downloadCsv', JsonCSV)
Vue.component('navbar', require('./components/layouts/Navbar.vue').default);
Vue.component('sidebar', require('./components/layouts/Sidebar.vue').default);
Vue.component('breadcrumb', require('./components/layouts/Breadcumb.vue').default);
Vue.component('can', require('./components/Permission.vue').default);
Vue.component('v-select', VSelect);
Vue.component('v-paginate', Paginate)

const store = new Vuex.Store(StoreData)
if (store.state.currentUser) {
  window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ store.state.currentUser.token;
}
window.axios.defaults.headers.post['Content-Type'] = 'application/json';

const router = new VueRouter({
    routes,
    mode: 'history'
});

const eachFnId = router.beforeEach(function(to, from, next){
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const currentUser = store.state.currentUser;

  if (requiresAuth && !currentUser) {
    return next({path:'/register'});
  }else if (to.path == '/login' && currentUser){
    return next({path:'/dashboard'});
  }else if (to.path == '/' && currentUser || to.path == '/' && !currentUser) {
    return next({path:'/dashboard'});
  }else {
    next()
  }
});


import App from './components/Template.vue'

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      App
    }
});
