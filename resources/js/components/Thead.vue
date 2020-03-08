<template>
    <thead>
    <tr class="border-bottom text-white">
        <td class="border-right">Name</td>
        <td class="text-center">Priority</td>
        <td class="text-center">Due In</td>
        <td class="task-input-half">&nbsp</td>
    </tr>
    <tr class="border-bottom border-top" v-if="!isHidden">
        <td>
            <input v-model="form.input.name" title="Task name" placeholder="Task Name?" name="name" type="text" class="form-control m-0">
        </td>
        <td class="task-input">
            <input v-model="form.input.priority" title="Task priority" name="priority" type="number" class="form-control m-0">
        </td>
        <td class="task-input">
            <input v-model="form.input.dueIn" title="Task due in" type="number" name="dueIn" class="form-control m-0">
        </td>
        <td class="task-input-half">
            <button @click="addTask" class="btn btn-block btn-outline-success">Add</button>
        </td>
    </tr>
    </thead>
</template>
<script>
    export default {
        name : 'task-form-row',
        props: {isHidden : Boolean},
        methods : {
            async addTask(){
               await $.post('/tasks', this.form.input).then(response => {
                   alert(1);
                  /*if(response.errors){
                      ['name', 'priority', 'dueIn'].forEach((value) => {
                          if(response.errors[value]){
                              this.form.errors[value] = response.errors[value]
                          }
                      });
                  }else if(response.success.message) {
                      this.form.success = response.success.message
                  }else{
                      this.form.success = 'Task added successfully';
                  }*/
               }).fail(function() {
                    alert(2)
               })

               ;

               this.$parent.$emit('updateTasks', 1)

            }
        },
        data() {
            return {
                form : {
                    input : {
                        name : null,
                        priority : null,
                        dueIn : null
                    },
                    errors : {
                        name : null,
                        priority : null,
                        dueIn : null
                    },
                    success : null
                }
            }
        }
    }
</script>
<style>
    .task-input{
        width: 10%;
    }
    .task-input-half{
        width: 5%;
    }
</style>
