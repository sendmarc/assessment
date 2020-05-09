require('./bootstrap');
window.Vue = require('vue');

Vue.component( 'tasks',require('./components/tasks.vue').default);

const app = new Vue({
    el: '#app',
});
