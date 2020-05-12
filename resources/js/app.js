require('./bootstrap');
window.Vue = require('vue');

Vue.component( 'tasks',require('./components/tasks.vue').default);
Vue.component( 'taskAdd',require('./components/taskAdd.vue').default);

const app = new Vue({
    el: '#app',
});
