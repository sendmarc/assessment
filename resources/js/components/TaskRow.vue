<template>
    <tr :key="task.id" class="border-bottom border-white">
        <td>{{ task.name }}</td>
        <td class="text-center">{{ task.priority }}</td>
        <td class="text-center">{{ task.dueIn }}</td>
        <td>
            <button class="btn btn-sm btn-outline-info btn-block" type="button">
                Delete
            </button>
        </td>
    </tr>

</template>
<script>
    export default {
        name: 'task-row',
        props: ['task'],
        data: function() {
            return {
                task: {
                    id: null,
                    name: null,
                    priority: null,
                    dueIn: null,
                },
            };
        },
    };
</script>
