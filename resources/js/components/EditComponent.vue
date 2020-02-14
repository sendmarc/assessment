<template>
  <div>
    <h1>Edit Task</h1>
    <form @submit.prevent="updateTask">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Task Name:</label>
            <input type="text" class="form-control" v-model="task.name">
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Task Priority:</label>
            <input type="number" class="form-control" v-model="task.priority">
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Task Body:</label>
              <textarea class="form-control" v-model="task.dueIn" rows="2"></textarea>
            </div>
          </div>
        </div><br />
        <div class="form-group">
          <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          task: {}
        }
      },
      created() {
        let uri = `http://127.0.0.1:8000/api/task/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.Task = response.data;
        });
      },
      methods: {
        updateTask() {
          let uri = `http://127.0.0.1:8000/api/task/update/${this.$route.params.id}`;
          this.axios.post(uri, this.task).then((response) => {
            this.$router.push({name: 'tasks'});
          });
        }
      }
    }
</script>