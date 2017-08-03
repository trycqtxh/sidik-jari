<template>
    <clock :blink="true" :displaySeconds="true" />
</template>

<script>
    import Clock from 'vue-digital-clock'

    export default {
        name: 'JamDigital',
        components: {
            Clock,
        },
    }
</script>