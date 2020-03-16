<template>
    <mdb-container>
        <mdb-datatable
            :data="data"
            striped
            bordered
            arrows
            :display="3"
        />
    </mdb-container>
</template>
<script>
    import { mdbDatatable, mdbContainer } from 'mdbvue';
    export default {
        components: {
            mdbDatatable,
            mdbContainer
        },
        data() {
            return {
                columns: [],
                rows: []
            };
        },
        computed: {
            data() {
                return {
                    columns: this.columns,
                    rows: this.rows
                };
            },
        },
        methods: {
            filterData(dataArr, keys) {
                let data = dataArr.map(entry => {
                    let filteredEntry = {};
                    keys.forEach(key => {
                        if (key in entry) {
                            filteredEntry[key] = entry[key];
                        }
                    });
                    return filteredEntry;
                });
                return data;
            },
            fetchData() {
                fetch('api/tasks')
                    .then(res => res.json())
                    .then(json => {
                        let keys = ["id", "name", "priority", "dueIn", ""];
                        let entries = this.filterData(json, keys);
                        //columns
                        this.columns = keys.map(key => {
                            return {
                                label: key.toUpperCase(),
                                field: key,
                                sort: 'asc'
                            };
                        });
                        //rows
                        entries.map(entry => {
                            var foundIndex = this.rows.findIndex(item => item.id === entry.id);
                            if (foundIndex === -1) this.rows.push(entry);
                            else this.rows[foundIndex] = entry;
                        });
                    })
                    .catch(err => console.log(err));
            }
        },
        mounted(){
            this.fetchData();
        },
    };
</script>
