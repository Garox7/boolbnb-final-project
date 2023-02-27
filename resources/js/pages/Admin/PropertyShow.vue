<template>
        <Page404 v-if="is404" />
        <div v-else-if="objProperty">
            <h1>Pagina di proprietà singola dell'admin</h1>
            <h4>{{ objProperty.name }}</h4>
            <img
            v-for="image in objProperty.property_images"
            :key="image.id"
            :src="'/storage/' + image.image" alt="">
        </div>
        <div v-else>Loading...</div>
</template>

<script>
import Page404 from '../Page404.vue';

export default {
    components: {
        Page404,
    },
    props: [
        'slug',
    ],
    data() {
        return {
            objProperty: null,
            is404: null,
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
