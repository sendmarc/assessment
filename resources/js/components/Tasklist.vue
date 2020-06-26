<template>
    <div class="container">
        <div class="row mt-1">
            <b-table sticky-header :items="items" head-variant="light" @row-clicked="taskEdit"></b-table>
        </div>
        <hr class="border-light">
        <div class="row">
            <div class="align-content-center col">
                <button class="btn btn-success" v-on:click="newTask()">Add New Task</button>
                <button class="btn btn-info" v-on:click="tickTasks()">Tick</button>
            </div>
            <div class="alert alert-info small" role="alert">
                <strong>NOTE:</strong> Click on a task to edit or delete.
            </div>
        </div>
        <form @submit.prevent="isNewTask ? saveTask() : updateTask()" @keydown="form.onKeydown($event)">
            <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Priority</label>
                                <input v-model="form.priority" type="number" name="priority" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Due In</label>
                                <input v-model="form.dueIn" type="number" name="dueIn" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="alert-info">{{ messageText }}</span>
                            <br>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="submit" class="btn btn-danger" v-on:click="deleteTask()">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                isNewTask: true,
                messageText: '',
                items: [{}],
                form: new Form({
                    id: '',
                    name: '',
                    priority: '',
                    dueIn: ''
                })
            }
        },
        methods: {
            fetchTasks() {
                axios.get('/api/tasks').then(({data}) => (this.items = data));
            },
            newTask() {
                this.resetTaskFormData();
                this.isNewTask = true;
                $('#taskModal').modal('show');
            },
            saveTask() {
                this.form.post('api/tasks')
                    .then(() => {
                        $('#taskModal').modal('hide');
                        this.fetchTasks();
                    })
                    .catch(() => {
                        this.messageText = 'Error saving task.';
                    });
            },
            taskEdit(task) {
                this.resetTaskFormData();
                this.isNewTask = false;
                this.form.fill(task);
                $('#taskModal').modal('show');
            },
            updateTask() {
                this.form.put('api/tasks/' + this.form.id)
                    .then(() => {
                        $('#taskModal').modal('hide');
                        this.fetchTasks();
                    })
                    .catch(() => {
                        this.messageText = 'Error updating task.';
                    });
            },
            deleteTask() {
                this.form.delete('api/tasks/' + this.form.id)
                    .then(() => {
                        $('#taskModal').modal('hide');
                        this.fetchTasks();
                    })
                    .catch(() => {
                        this.messageText = 'Error deleting task.';
                    });
            },
            tickTasks() {
                axios.get('/api/list/tick').then(({data}) => (this.items = data));
            },
            resetTaskFormData() {
                this.messageText = '';
                this.form.reset();
            }
        },
        created() {
            this.fetchTasks();
        }
    }
</script>

<style lang="scss">
    @import '~bootstrap/scss/bootstrap.scss';
    @import '~bootstrap-vue/src/index.scss';
</style>
