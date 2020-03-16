<template>
    <div>
        <div id="header">
            <h3>Task Fighter</h3>
            <task-tick @ticked="onTick"></task-tick>
        </div>
        <hr>
        <task-table ref="table"></task-table>
    </div>
</template>
<script>
    export default {
        methods: {
            onTick: function () {
                this.$refs.table.fetchData()
            }
        }
    };
</script>
