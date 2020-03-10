<template>
    <div>
        <Navigation/>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12 mb-4 mt-4">
                    <div class="card h-100">
                        <div class="card-header text-white">
                            Tasks
                            <div class="btn-group float-right">
                                <button @click="tickTasks" class="btn btn-primary" type="button">Tick</button>
                                <button @click="toggleForm" class="btn btn-secondary" type="button">{{ !isHidden ?
                                    'Hide' : 'Show' }} Task Form
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-borderless table-hover">
                                <thead>
                                <tr class="border-bottom text-white">
                                    <td class="border-right">Name</td>
                                    <td class="text-center">Priority</td>
                                    <td class="text-center">Due In</td>
                                    <td class="task-input-half">&nbsp</td>
                                </tr>
                                <tr v-if='form.errors.length'>
                                    <td colspan="5">
                                        <div class="alert alert-danger mb-0">
                                            <p v-for="error in form.errors">
                                                {{ error }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-bottom border-top" v-if="!isHidden">
                                    <td>
                                        <input v-model="form.data.name" title="Task name" placeholder="Task Name?" name="name" type="text" class="form-control m-0">
                                    </td>
                                    <td class="task-input">
                                        <input v-model="form.data.priority" title="Task priority" name="priority" type="number" class="form-control m-0">
                                    </td>
                                    <td class="task-input">
                                        <input v-model="form.data.dueIn" title="Task due in" type="number" name="dueIn" class="form-control m-0">
                                    </td>
                                    <td class="task-input-half">
                                        <button @click="createTask" class="btn btn-block btn-outline-success">Add</button>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="task in tasks"  class="border-bottom border-white">
                                        <td>{{ task.name }}</td>
                                        <td class="text-center">{{ task.priority }}</td>
                                        <td class="text-center">{{ task.dueIn }}</td>
                                        <td>
                                            <button @click="deleteTask(task.id, index)" class="btn btn-sm btn-outline-info btn-block" type="button">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                tasks : [],
                isHidden: true,
                buttonText: !this.isHidden ? 'Show' : 'Hide',
                form: {
                    data: {
                        name: '',
                        priority: '',
                        dueIn: '',
                    },
                    errors: [],
                },
            };
        },
        methods: {
            toggleForm() {
                this.isHidden = !this.isHidden;
            },
            async deleteTask(taskId, index) {
                await axios.delete(`/api/task/${taskId}`).then(response => {

                    this.tasks.splice(index, 1);
                });
            },

            async tickTasks() {
                await axios.get('/list/tick').then(response => {

                    this.tasks = response.data.data;

                })
            },

            async getTasks(){
                await axios.get('/api/task').then(response => {
                    if(typeof response.data === 'object'){
                        this.tasks = response.data.data;
                    }
                })
            },
            async createTask(){
                this.form.errors = [];
                await axios.post('/api/task', this.form.data).then(response => {
                    this.tasks.push(response.data.data);
                    this.form.data.name = '';
                    this.form.data.priority = '';
                    this.form.data.dueIn = '';
                }).catch(errors => {
                    if(errors.response.data.errors){
                        ['name', 'priority', 'dueIn'].forEach((value) => {
                            if(errors.response.data.errors[value]){
                                this.form.errors.push(errors.response.data.errors[value][0])
                            }
                        });
                    }else{
                        this.form.success = errors.response.data.message;
                    }
                });



            }
        },
        created() {
            this.getTasks();
        }
    };
</script>
<style scoped>
    .alert-danger {
        background: #d48888;
    }
</style>
