<template>
    <div class="alert" :class="alertClass">{{ message }}</div>
</template>

<script>
    export default {
        props: {
            message: {
                type: String,
                required: true
            },
            type: {
                type: String,
                require: true
            }
        },
        computed: {
            alertClass() {
                let classObject = {}
                let alertClass = this.types[this.type]
                classObject[alertClass] = typeof alertClass != 'undefined'
                return classObject
            }
        },
        data() {
            return {
                types: {
                    error: 'alert-danger',
                    success: 'alert-success',
                    info: 'alert-info',
                    warning: 'alert-warning'
                }
            }
        }
    }
</script>
