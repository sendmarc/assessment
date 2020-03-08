<template>
    <div>
        <navigation></navigation>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" v-if="form.errors.length">
                                        <div v-for="error in form.errors">{{ error }}</div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-borderless table-hover">
                                <table-head :is-hidden="isHidden"></table-head>
                                <tbody>
                                <task-row :key="task.id" :task="task" v-for="task in tasks"></task-row>
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
        props: {tasks: Array},
        data: function() {
            return {
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
            async deleteTask(taskId) {
                await axios.delete(`/tasks/${taskId}`);
            },
            tickTasks() {
                axios.all([this._tick(), this._getTasks()]).then(
                    axios.spread((...response) => {
                        this.tasks = response[1]['data'];
                    }),
                );
            },
            async _tick() {
                return await axios.get('/list/tick');
            },
            async _getTasks() {
                return await axios.get('/tasks');
            },


        },
        created() {
            this.$on('updateTasks', () => {
                    this._getTasks().then(response => {
                       this.tasks = JSON.parse(response);
                   });
                }
            )
        }
    };
</script>
