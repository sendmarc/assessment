<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>Manage Tasks</h3>
                <button v-on:click="runTicker" class="btn btn-primary">tick</button>
                <Paginator  v-if="results != null"
                v-bind:results="results"
                v-on:get-page="getPage"></Paginator>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Priority</th>
                            <th>Due In</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="results != null">
                        <tr v-for="user in results.data">
                            <td>{{user.name}}</td>
                            <td>{{user.priority}}</td>
                            <td>{{user.dueIn}}</td>
                            <td>
                                <div class="btn-group">
                                    <div class="btn btn-sm btn-warning"><i class="fas fa-trash"></i></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <Paginator v-if="results != null"
                v-bind:results="results"
                v-on:get-page="getPage"></Paginator>
            </div>
        </div>
    </div>
</template>

<script>
import Paginator from '../utlities/paginations/Paginator.vue'
export default {
    components: {
        Paginator
    },
    mounted() {
        this.getTasks();
    },
    data() {
        return{
            results: null,
            params: {
                page: 1
            }
        }
    },
    methods: {
        getTasks: function() {
            axios.get('/tasks', {params: this.params}).then(response => {
                this.results = response;
            })
        },
        runTicker: function(){
            axios.get('/tick').then(response => {
                this.results = response;
            })
        },
        getPage: function(event){
            this.params.page = event;
            this.getUsers()
        }
    }
}
</script>
