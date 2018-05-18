
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//VUEX

const store = new Vuex.Store({
    state: {
        item:{}
    },
    mutations: {
        setItem(state, obj) {
            state.item = obj;
        }
    }
});

//Admin
Vue.component('page', require('./components/admin/Page.vue'));
Vue.component('menudefault', require('./components/admin/Menu.vue'));
Vue.component('box', require('./components/admin/index/Box.vue'));
Vue.component('panel', require('./components/admin/Panel.vue'));
Vue.component('pagetitlebox', require('./components/admin/PageTitleBox.vue'));
Vue.component('table-list', require('./components/admin/TableList.vue'));

Vue.component('calert', require('./components/Alert.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('modal-bootstrap', require('./components/ModalBootstrap.vue'));
Vue.component('modal-link', require('./components/ModalLink.vue'));
Vue.component('title-box', require('./components/TitleBox.vue'));

//Blog Components
//Vue.component('topblog', require('./components/blog/Top.vue'));

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
       document.getElementById('app').style.display = "block";     
    }
});
