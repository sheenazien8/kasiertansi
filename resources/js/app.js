/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery-ujs');

import router from './router/router';
import Notifications from 'vue-notification';
import VSelect from 'vue-select';
import BootstrapVue from 'bootstrap-vue';
import Paginate from 'vuejs-paginate';
import RouteService from './services/RouteService';
// import Datepicker from 'vuejs-datepicker';

window.Vue = require('vue');
window.RouteService = RouteService;
Vue.prototype.$eventBus = new Vue();

Vue.use(Notifications)
Vue.use(BootstrapVue)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./views/layouts/Navbar.vue').default);
Vue.component('sidebar', require('./views/layouts/Sidebar.vue').default);
Vue.component('v-select', VSelect);
Vue.component('v-paginate', Paginate)
// Vue.component('datepicker', Datepicker)

import App from './components/Dashboard.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
