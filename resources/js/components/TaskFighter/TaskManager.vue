<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>Manage Tasks</h3>
                <button v-on:click="runTicker" class="btn btn-primary">Tick</button>
                <b-button @click="modalShow = !modalShow">Create Task</b-button>
                 <b-button href="/logout" variant="outline-info">
                <b-icon icon="power" aria-hidden="true"></b-icon> Logout
                </b-button>
                <div>
                <b-modal v-model="modalShow" title="Create Task" hide-footer>
                    <div class="d-block text-center">
                    <b-form-input class="mb-2" v-model="task_name" placeholder="Task Name"></b-form-input>
                    <b-form-select class="mb-2" v-model="task_type" :options="options"></b-form-select>
                    <b-form-input class="mb-2" v-model="task_priority" type="number" placeholder="Priority"></b-form-input>
                    <b-form-input class="mb-2" v-model="task_due" type="number" placeholder="Due In"></b-form-input>
                    </div>
                    <b-button class="mt-2" variant="outline-primary" block v-on:click="CreateTask">Submit</b-button>
                    <b-button class="mt-3" block v-on:click="hideModal">Close Me</b-button>

                </b-modal>
                </div>
                <Paginator  v-if="results != null"
                v-bind:results="results"
                v-on:get-page="getPage"></Paginator>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Due In</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="results != null">
                        <tr v-for="user in results.data">
                            <td>{{user.name}}</td>
                            <td>{{user.type}}</td>
                            <td>{{user.priority}}</td>
                            <td>{{user.dueIn}}</td>
                            <td>
                                <div class="btn-group">
                                    <div @click="deleteTask(user.id)" class="btn btn-sm btn-warning"><i class="fas fa-trash"></i></div>
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
            modalShow: false,
            params: {
                page: 1
            },
            task_priority: '',
            task_name: '',
            task_due: '',
            task_type: '',
            options: [
                { value: null, text: 'Please select an option' },
                { value: 'Get Older', text: 'Get Older' },
                { value: 'Breathe', text: 'Breathe' },
                { value: 'Complete Assessment', text: 'Complete Assessment' },
                ]
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
        },
        deleteTask: function(event){
            let _this = this
            axios.delete('/tasks/delete/'+event).then(response => {
                    if(response.data.results){
                    _this.getTasks()
                    }else{

                    }

                })
        },
        CreateTask: function(event){
            let _this = this
            axios.post('/tasks/create',{
                    name:this.task_name,
                    dueIn:this.task_due,
                    priority:this.task_priority,
                    type: this.task_type
                }).then(response => {
                    if(response.data.results){
                    this.modalShow = false
                    _this.getTasks()
                    }else{

                    }

                })
        },
        hideModal() {
            this.modalShow = false
        },
    }
}
</script>
