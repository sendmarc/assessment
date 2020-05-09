<template>
    <div class="card-body">
        <h4 class="card-header" placeholder="Title" v-model="title">{{ title }}</h4>
        <div class="mb-4">
<!--            <a class="btn btn-primary" title="TICK" href="{{ URL::to('list/tick/') }}"><i class="fa fa-check"></i></a>-->
        </div>
        <div v-if="tasks.length" class="mb-4">
            No tasks yet
        </div>
        <table class="table table-striped">
            <thead>
            <tr><td>Name</td><td>Priority</td><td>Due In</td><td>Action</td></tr>
            </thead>
            <tbody>

            <tr v-for="task in tasks">
                    <td>{{ task.name}}</td>
                    <td>{{ task.priority }}</td>
                    <td>{{ task.dueIn }}</td>
                    <td>
                        <div onclick="deleteTask(1)" class="btn btn-danger" data-toggle="delete-task" title="DELETE" type="submit"><i class="fa fa-trash"></i></div>
                    </td>
            </tr>
            </tbody>

        </table>





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
            // createTask() {
            //     axios.post('api/tasks', {})
            //         .then((res) => {
            //             this.task.body = '';
            //             this.task.user_id = '';        ///added by me
            //             this.edit = false;
            //             this.fetchTaskList();
            //         })
            //         .catch((err) => console.error(err));
            // },
            //
            deleteTask(id) {
                axios.post('tasks/' + id)
                    .then((res) => {
                        this.fetchTasks()
                    })
                    .catch((err) => console.error(err));
            },
        },
        mounted(){
            this.fetchTasks();

        },
    }
</script>

