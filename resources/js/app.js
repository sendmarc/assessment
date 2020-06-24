require('./bootstrap');
window.Vue = require('vue');

new Vue({
    el: '#ticker',
    methods: {
        tick: function (event) {
            axios.get('/list/tick').then(function (data) { window.location.reload(false) })
        }
    }
})

new Vue({
    el: '#table-body',
    methods: {
        complete: function (id) {
            axios.delete('/tasks/' + id).then(function (data) { window.location.reload(false) })
        }
    }
})

new Vue({
    el: '#table-header',
    data: {
        current_sort: 'dueIn',
    },
    methods: {
        sort: function (event) {
            axios.get('/?sort').then(function (data) { window.location.reload(false) })
        }
    }
})