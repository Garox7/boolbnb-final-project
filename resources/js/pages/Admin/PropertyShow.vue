<template>
    <div>
        <h1>Pagina di proprietà singola dell'admin</h1>
        <h4>{{ objProperty.name }}</h4>
        <img
            v-for="image in objProperty.property_images"
            :key="image.id"
            :src="'/storage/' + image.image" alt="">
    </div>
</template>

<script>
export default {
    props: [
        'slug',
    ],
    data() {
        return {
            objProperty: [],
        }
    },
    created() {
        axios.get('/api/properties/' + this.slug)
            .then(response => {
                if (response.data.success) {
                    this.objProperty = response.data.results;
                    console.log('Properietà:', this.objProperty);
                } else {
                    this.is404 = true;
                }
            });
    }
}
</script>

<style>

</style>
