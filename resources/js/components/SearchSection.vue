<template>
    <div>
        <h1>Sto Cercando</h1>
        <p>{{ serchString }}</p>
    </div>
</template>

<script>
export default {
    props: {
        serchString: String,
    },
    created: {
        getProperty() {
            // richiesta axios
        }
    }
}
</script>

<style>

</style>
