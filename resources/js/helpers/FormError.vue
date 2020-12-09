<template>
    <span class="invalid-feedback text-center font-weight-bold text-danger" role="alert">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['errors']
    }
</script>