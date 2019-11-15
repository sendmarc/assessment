<template>
  <div>
    <h5 class="my-4">List</h5>

    <table class="table table-striped">
      <thead>
        <tr>
          <th class="cursor-pointer" @click="sortBy('id')">Id</th>
          <th class="cursor-pointer" @click="sortBy('name')">Name</th>
          <th class="cursor-pointer" @click="sortBy('priority')">Priority</th>
          <th class="cursor-pointer" @click="sortBy('dueIn')">Due In</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="task in sortedTasks" :key="task.id">
          <td>{{ task.id }}</td>
          <td>{{ task.name }}</td>
          <td>{{ task.priority }}</td>
          <td>{{ task.dueIn }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {

  computed: {
      sortedTasks() {
          let tasks = this.tasks
          if(this.sort.column) {
              tasks =_.orderBy(tasks, (task) => {
                  return task[this.sort.column]
              }, this.sort.order)
          }

          return tasks
      }
  },
  data() {
    return {
      sort: {
        column: "id",
        order: "asc"
      },
      tasks: []
    };
  },

  methods: {
    sortBy(column) {
        this.sort.column = column
        this.sort.order = this.sort.order === 'asc' ? 'desc': 'asc';
    }
  },

  async mounted() {
    try {
      const {
        data: { data }
      } = await axios.get("/tasks");
      this.tasks = data;
    } catch (e) {}
  }
};
</script>

<style scoped>
    .cursor-pointer { cursor: pointer; }
</style>