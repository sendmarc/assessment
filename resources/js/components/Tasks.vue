<template>
  <div>
    <div class="w-100 text-right mb-4" style="margin-top:-60px;">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTaskModal">
        Add Task
      </button>
      <button type="button" class="btn btn-primary" @click="runTick">
        Run Tick
      </button>
    </div>

    <div class="table-responsive table-hover">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">NAME</th>
          <th scope="col">PRIORITY</th>
          <th scope="col">NUMBER OF DAYS UNTIL DUE</th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(task, index) in tasks" v-if="(tasks.length > 0)" class="table-card">
          <td>{{ task.name }}</td>
          <td>{{ task.priority }}</td>
          <td>{{ task.dueIn }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-danger color-white" @click="removeTask(task, index)">
              Remove
            </button>
          </td>
        </tr>
        <tr v-else>
          <td>There is currently is no data to show here.</td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- USERS ADD MODAL -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:50%;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTaskModalLabel">Add tasks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name"><strong>Name</strong><br><small>The name of the task</small></label>
              <input id="name"
                     type="text"
                     placeholder="Task name"
                     class="form-control"
                     :class="{ 'is-invalid': errors['name'] }"
                     v-model="taskToAdd.name">
              <form-error v-if="errors['name']" :errors="errors">
                {{ errors['name'].toString() }}
              </form-error>
            </div>

            <div class="form-group">
              <label for="priority"><strong>Priority</strong><br><small>The priority of the task</small></label>
              <select
                id="priority"
                class="form-control"
                :class="{ 'is-invalid': errors['priority'] }"
                v-model="taskToAdd.priority">
                <option selected value> -- select an option --</option>
                <option v-for="value in priorities"
                        :value="value">{{ value }}
                </option>
              </select>
              <form-error v-if="errors['priority']" :errors="errors">
                {{ errors['priority'].toString() }}
              </form-error>
            </div>

            <div class="form-group">
              <label for="dueIn"><strong>Due Date</strong><br><small>The date the task is due by</small></label>
              <datetime id="dueIn"
                        type="date"
                        placeholder="Task due date"
                        format="yyyy-MM-dd"
                        input-class="form-control"
                        :class="{ 'is-invalid': errors['dueIn'] }"
                        :min-datetime="now"
                        v-model="taskToAdd.dueDate">
              </datetime>
              <form-error v-if="errors['dueIn']" :errors="errors">
                {{ errors['dueIn'].toString() }}
              </form-error>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" @click="addTask">Add Task</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
//IMPORTS
import {Datetime} from "vue-datetime";
import moment from 'moment';
import FormError from '../helpers/FormError.vue';
//MAIN
export default {
  inheritAttrs: false,
  data: function () {
    return {
      tasks: JSON.parse(this.$attrs.tasks),

      taskToAdd: {
        name: '',
        priority: '',
        dueIn: '',
        dueDate: '',
      },

      priorities: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100],

      errors: []
    }
  },
  methods: {
    removeTask(task, index) {
      if (confirm('Are you sure you would like to remove ' + task.name + ' ?')) {

        this.loader(true);

        axios.delete('/tasks/' + task.id).then(response => {
          //Success
          this.loader(false);
          alert(response.data.message);
          location.reload();
        }).catch(error => {
          //Fail
          this.loader(false);
          alert(JSON.stringify(error.response.data.message));
        });
      }
    },
    addTask() {
      this.loader(true);

      axios.post('/tasks', {
        name: this.taskToAdd.name,
        priority: this.taskToAdd.priority,
        dueIn: this.taskToAdd.dueIn,
      }).then(response => {
        //Success
        this.loader(false);
        alert(response.data.message);
        location.reload();
      }).catch(error => {
        //Fail
        this.loader(false);
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else {
          alert(JSON.stringify(error.response.data.message));
        }
      });
    },
    runTick() {
      if (confirm('Are you sure that you would like to run the tick command?')) {
        this.loader(true);

        axios.patch('/tasks/tick').then(response => {
          //Success
          this.loader(false);
          alert(response.data.message);
          location.reload();
        }).catch(error => {
          //Fail
          this.loader(false);
          alert(JSON.stringify(error.response.data.message));
        });
      }
    },
    loader(switchOn) {
      if (switchOn) {
        $('body').addClass('modal-open');
        $('.overlay').css('display', 'block');
      } else {
        $('body').removeClass('modal-open');
        $('.overlay').css('display', '');
      }
    },
  },
  computed: {
    now() {
      return moment().format('YYYY-MM-DD');
    },
  },
  mounted() {},
  watch: {
    'taskToAdd.dueDate': function () {
      if(this.taskToAdd.dueDate !== ''){
        let today = moment();
        let dueDate = moment(this.taskToAdd.dueDate);
        this.taskToAdd.dueIn = dueDate.diff(today, 'days') + 1;
      }
    },
  },
  components: {
    Datetime,
    FormError
  },
};
</script>