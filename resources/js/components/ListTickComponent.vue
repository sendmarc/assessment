<template>
  <div>
      <h1>Tasks</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'home' }" class="btn btn-primary">Tick Tasks</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Priority</th>
                <th>Due in</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.id }}</td>
                    <td>{{ task.name }}</td>
                    <td>{{ task.priority }}</td>
                    <td>{{ task.dueIn }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: task.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-info" @click.prevent="tick(task.id)">Tick</button></td>
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
      let uri = 'http://127.0.1:8000/api/tasks';
      this.axios.get(uri).then(response => {
        this.tasks = response.data.data;
      });
    },
    methods: {
     tick(id){
        let uri = `http://127.0.1:8000/list/tick/${id}`;
         this.axios.get(uri).then(response => {
        this.tasks = response.data.data;
      });
     }
    }
  }
</script>