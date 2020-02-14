<template>
  <div>
      <h1>Tasks</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create' }" class="btn btn-primary">Create Task</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Priority</th>
                <th>due in</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.id }}</td>
                    <td>{{ task.name }}</td>
                    <td>{{ task.priority }}</td>
                    <td>{{ task.dueIn }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: task.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deleteTask(task.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          tasks: []
        }
      },
      created() {
      let uri = 'http://127.0.0.1:8000/api/tasks';
      this.axios.get(uri).then(response => {
        this.tasks = response.data.data;
      });
    },
    methods: {
      deleteTask(id)
      {
        let uri = `http://127.0.0.1:8000/api/task/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.tasks.splice(this.tasks.indexOf(id), 1);
        });
      }
    }
  }
</script>