import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue';
import TasksList from './components/TasksList';
import TaskRow from './components/TaskRow';
import Navigation from './components/Navigation';
import Thead from './components/Thead';
require('./bootstrap');
window.$ = require('jquery');

Vue.use(BootstrapVue);

Vue.component('tasks-list', TasksList);
Vue.component('task-row', TaskRow);
Vue.component('table-head', Thead);
Vue.component('navigation', Navigation);
const app = new Vue({
    el: '#app',
    template : '' ,
});

