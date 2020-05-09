<template>
    <div class="card-body">
        <h4 class="card-header" placeholder="Title" v-model="title">{{ title }}</h4>
        <div class="mb-4">
            <div class="btn btn-primary" title="TICK" @click="taskTick()"><i class="fa fa-check"></i></div>
        </div>

        <table v-if="tasks.length" class="table table-striped">
            <thead>
            <tr><td>Name</td><td>Priority</td><td>Due In</td><td>Action</td></tr>
            </thead>
            <tbody>

            <tr v-for="task in tasks">
                    <td>{{ task.name}}</td>
                    <td>{{ task.priority }}</td>
                    <td>{{ task.dueIn }}</td>
                    <td>
                        <div  @click="deleteTask(task.id)" class="btn btn-danger" title="DELETE" type="submit"><i class="fa fa-trash"></i></div>
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
                axios.get('tasks', {}).then((response) => {
                    this.tasks = response.data.message;
                })

            },
            createTask() {
                axios.post('tasks', {})
                    .then((res) => {
                        this.fetchTasks();
                    })
                    .catch((err) => console.error(err));
            },
            taskTick(){
                axios.get('/list/tick')
                    .then((res) => {
                        this.fetchTasks();
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
                    title:'Delete A Campaign!!!',
                    content: 'Are you sure you want to delete a campaign?',
                    type: 'red',
                    draggable: false,
                    buttons: {
                        tryAgain: {
                            text:  ' Delete',
                            btnClass: 'btn-blue fa fa-plus',
                            action: function(){
                                axios.get('tasks/'+id).then((response) => {
                                    this.fetchTasks();
                                    //proper message
                                    alert(response.data.message)
                                    })
                                    .catch(error => {
                                    console.log(error);
                                })
                            }
                        },
                        cancel: function () {

                        }
                    }
                })
            },
        },
        mounted(){
            this.fetchTasks();
        },
    }
</script>

