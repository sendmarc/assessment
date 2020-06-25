require('./bootstrap');
window.Vue = require('vue');

new Vue({
    el: '#app',
    data: {
        tasks: [],
        currentSort: 'dueIn',
        currentDir: 'asc'
    },
    created: function () {
        this.fetch();
    },
    methods: {
        complete: function (event) {
            del_id = event.target.id.replace('complete-', '')
            axios.delete('/tasks/' + del_id).then(resp => { this.tasks = this.tasks.filter(task => task.id != del_id); })
        },
        sort: function (sortParam) {
            if (sortParam == this.currentSort) {
                this.currentDir = this.currentDir == 'asc' ? 'desc' : 'asc';
            } else {
                this.currentSort = sortParam;
            }
        },
        tick: function () {
            axios.get('/list/tick').then(resp => this.fetch());
        },
        fetch: function () {
            axios.get('/tasks?sort=' + this.currentSort + "&" + this.currentDir).then(resp => {
                this.tasks = Object.values(resp.data);
                this.tasks.map(task => {
                    task['dueIn'] = parseInt(task['dueIn']);
                    task['priority'] = parseInt(task['priority']);
                });
            });
        }
    },
    computed: {
        sortedTasks: function () {
            return this.tasks.sort((a, b) => {
                let modifier = 1;
                if (this.currentDir === 'desc')
                    modifier = -1;
                if (a[this.currentSort] < b[this.currentSort])
                    return -1 * modifier;
                if (a[this.currentSort] > b[this.currentSort])
                    return 1 * modifier;
                return 0;
            });
        }
    }
})

