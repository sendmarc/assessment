<template>

</template>
<script>
    export default {
        name : 'Form',
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
