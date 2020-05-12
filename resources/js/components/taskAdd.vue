<template>
    <div class="card-body">
        <h4 class="card-header" placeholder="Title" v-model="title">{{ title }}</h4>

        <form>

        </form>
        <div  @click="createTask()" class="btn btn-primary" title="Create"><i class="fa fa-plus"></i></div>

    </div>

</template>
<script>

    export default {

        data() {
            return {

                task_id: '',
                title : "Create Task",

            };
        },

        methods: {

            createTask() {
                axios.post('api/tasks/create', {})
                    .then((response) => {
                        $('.display-messages').html('<div class="alert alert-success">'+response.data.message+'</div>');
                        setTimeout(function(){  $('.alert').fadeOut('slow'); }, 3000);
                    })
                    .catch((err) => console.error(err));
            },



        },

    }
</script>

