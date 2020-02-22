<template>
    <div id="app">
        <div class="heading">
            <h1>Task Fighter</h1>
        </div>
        <task-component
			v-for="task in tasks"
			v-bind="task"
			:key="task.id"
			@ticker="tick"
			@delete="del"
        ></task-component>
        <div>
            <button class="add-btn" @click="create">Add Task</button>
        </div>
    </div>
</template>

<script>
  function Task({ id, name, priority, dueIn}) {
    this.id = id;
    this.name = name;
    this.priority = priority;
    this.dueIn = dueIn;
  }

  import TaskComponent from './components/Tasks.vue';

  export default {
    data() {
      return {
        tasks: [],
        mute: false
      }
    },
    methods: {
      async create() {
        this.mute = true;
        const { data } = await window.axios.get('/api/tasks/create');
        this.tasks.push(new Task(data));
        this.mute = false;
      },
      async read() {
        this.mute = true;
        const { data } = await window.axios.get('/api/tasks');
        data.forEach(task => this.tasks.push(new Task(task)));
        this.mute = false;
      },
      async tick(id) {
        this.mute = true;
        await window.axios.put(`/api/tasks/${id}`);
        this.tasks.find(task => task.id === id);
        this.mute = false;
      },
      async del(id) {
        this.mute = true;
        await window.axios.delete(`/api/tasks/${id}`);
        let index = this.tasks.findIndex(task => task.id === id);
        this.tasks.splice(index, 1);
        this.mute = false;
      }
    },
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    },
    components: {
      TaskComponent
    },
    created() {
      this.read();
    }
  }
</script>
<style>
    #app {
		height: 100%;
		overflow: auto;
        margin-left: 1em;
    }

    .heading h1 {
        margin-bottom: 0;
    }
	.add-btn {
	    color: #1a76c7;
	}
</style>
