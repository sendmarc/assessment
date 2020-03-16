<template>
    <mdb-btn color="default" @click="doTick" :disabled="disabled" class="tick-button">Tick</mdb-btn>
</template>
<script>
    import { mdbBtn } from 'mdbvue';
    export default {
        components: {
            mdbBtn
        },
        data () {
            return {disabled: false}
        },
        methods: {
            doTick: function(event) {
                if (this.disabled) return;
                this.disabled = true;
                axios.get('api/list/tick').then(() => {
                    this.$emit('ticked', null);
                }).finally(() => this.disabled = false);
            }
        }
    }
</script>
