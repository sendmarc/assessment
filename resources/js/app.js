import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue';
import Home from './components/Home';
import Navigation from './components/Navigation';
import Form from './components/Form';
require('./bootstrap');
window.$ = require('jquery');

Vue.use(BootstrapVue);

Vue.component('home', Home);
Vue.component('Form', Form);
Vue.component('navigation', Navigation);
const app = new Vue({
    el: '#app',
    template : '' ,
});

