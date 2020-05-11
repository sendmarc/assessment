<template>
    <div class="card-body">
        <h4 class="card-header" placeholder="Title" v-model="title">{{ title }}</h4>
        <div class="mb-4 mt-4">
            <div class="btn btn-primary" title="TICK" @click="taskTick()"><i class="fa fa-check"></i></div>
            <div  @click="createTask()" class="btn btn-danger" title="CREATE TASK" type="submit"><i class="fa fa-plus"></i></div>
        </div>

        <table v-if="tasks.length" class="table table-striped">
            <thead>
            <tr><td>Name</td><td>Name</td><td>Priority</td><td>Due In</td><td>Action</td></tr>
            </thead>
            <tbody>

            <tr v-for="(task,index ) in tasks">
                    <td>{{index+1}}</td>
                    <td>{{ task.name}}</td>
                    <td>{{ task.priority }}</td>
                    <td>{{ task.dueIn }}</td>
                    <td>
                        <div  @click="deleteTask(task.id)" class="btn btn-danger" title="DELETE" type="submit"><i class="fa fa-trash"></i></div>
                        <div  @click="editTask(task.id)" class="btn btn-secondary" title="EDIT" type="submit"><i class="fa fa-plus"></i></div>
                    </td>
            </tr>
            </tbody>

        </table>
        <div v-else class="mb-4">
            No tasks yet<br/>
            <div  @click="createTask()" class="btn btn-primary" title="Create"><i class="fa fa-plus"></i></div>
        </div>


    </div>

</template>
<script>

    export default {

        data() {
            return {
                tasks: [],
                task:{
                    id: '',
                    name: '',
                    priority: 0,
                    dueIn: 0,
                },
                task_id: '',
                title : "Tasks",
                edit:false,
                pagination:{},

            };
        },

        methods: {
            fetchTasks() {
                axios.get('api/tasks').then((response) => {
                    this.tasks = response.data.handle_data;
                })

            },
            createTask() {
                axios.post('api/tasks', {})
                    .then((response) => {
                        this.fetchTasks();
                        $('.display-messages').html('<div class="alert alert-success">'+response.data.message+'</div>');
                        setTimeout(function(){  $('.alert').fadeOut('slow'); }, 3000);
                    })
                    .catch((err) => console.error(err));
            },
            taskTick(){
                axios.get('api/list/tick')
                    .then((response) => {
                        this.fetchTasks();
                        $('.display-messages').html('<div class="alert alert-success">'+response.data.message+'</div>');
                        setTimeout(function(){  $('.alert').fadeOut('slow'); }, 3000);
                    })
                    .catch((err) => console.error(err));
            },

            editTask(id){
                axios.get('api/task/'+id)
                    .then((response) => {
                        this.fetchTasks();
                        $('.display-messages').html('<div class="alert alert-success">'+response.data.message+'</div>');
                        setTimeout(function(){  $('.alert').fadeOut('slow'); }, 3000);
                    })
                    .catch((err) => console.error(err));
            },

            deleteTask(id) {
                $.confirm({
                    theme: 'black',
                    animationBounce: 2.5,
                    closeIcon: true,
                    cancelButton:'Cancel',
                    icon: 'fa fa fa-trash fa-2x',
                    title:'Delete A Task!!!',
                    content: 'Are you sure you want to delete a task?',
                    type: 'red',
                    draggable: false,
                    buttons: {
                        tryAgain: {
                            text:  ' Delete',
                            btnClass: 'btn-blue fa fa-trash',
                            action: function(){
                                axios.get('api/deleteTask/'+id)
                                    .then((response) => {
                                        this.fetchTasks();
                                        $('.display-messages').html('<div class="alert alert-success">'+response.data.message+'</div>');
                                        setTimeout(function(){  $('.alert').fadeOut('slow'); }, 3000);

                                    })
                                    .catch((err) => console.error(err));
                            }
                        },
                        cancel: function () {

                        }
                    }
                })
            },
        },
        updated() {
            this.fetchTasks();
        },
        mounted(){
            this.fetchTasks();
        },
    }
</script>

