<template>
  <div>
    <h5 class="my-4">Create a task</h5>

    <form @submit.prevent="create">
      <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" v-model="form.name" :class="{'is-invalid': errors.name}">
          <strong class="text-danger" v-if="errors.name">{{ errors.name[0] }}</strong>
      </div>

      <div class="form-group">
          <label for="">Priority</label>
          <input type="text" class="form-control" v-model="form.priority" :class="{'is-invalid': errors.priority}">
          <strong class="text-danger" v-if="errors.priority">{{ errors.priority[0] }}</strong>
      </div>

      <div class="form-group">
          <label for="">Due In</label>
          <input type="text" class="form-control" v-model="form.dueIn" :class="{'is-invalid': errors.due_in}">
          <strong class="text-danger" v-if="errors.dueIn">{{ errors.dueIn[0] }}</strong>
      </div>


      <div class="form-group">
          <button class="btn btn-primary" :disabled="processing">Save</button>
          <router-link :to="{name: 'task.list'}" class="btn btn-danger" :disabled="processing">Cancel</router-link>
      </div>

      <app-alert :message="alert.message" :type="alert.type" />
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      processing: false,
      alert: {
        message: '',
        type: ''
      },
      form: {
        name: '',
        dueIn: '',
        priority: ''
      },
      errors: {}
    }
  },

  methods: {
    showAlert(type, message) {
      this.alert = {type, message}
    },
    async create() {
      this.processing = true
      try {
        await axios.post('/tasks', this.form)
        this.showAlert('success', 'Created your task.')
        this.form = {}
      }
      catch(error) {
        if(error.response.status && error.response.status == 422 ) {
          this.errors = error.response.data.errors
        }
        
        this.showAlert('error', 'Oops! could not add your task.')
      }

      this.processing = false
    }
  }
};
</script>