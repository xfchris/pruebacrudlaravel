
import Vue from 'vue'
import store from './store'
import Principal from './components/Principal.vue'

import 'bootstrap-vue/dist/bootstrap-vue.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


const app = new Vue({
    el: '#app',
    store,
    render: h => h(Principal)
});
