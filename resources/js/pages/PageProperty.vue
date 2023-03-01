<template>
    <div v-if="propertyArray">
        <h1>{{ propertyArray.name }}</h1>
        <div v-for="images in propertyArray.property_images" :key="images.id">
            <img :src="'/storage/' + images.image" :alt="images.id">
        </div>
        <h2>{{ propertyArray.address }}</h2>
        <p>
            {{ propertyArray.description }}
        </p>
        <ul>
            <li>numero letti {{ propertyArray.bed_count }}</li>
            <li>numero stanze da letto {{ propertyArray.bedroom_count }}</li>
            <li>numero bagni {{ propertyArray.bathroom_count }}</li>
        </ul>
    </div>
</template>

<script>
// TODO: gestire la 404 dei post non esistenti
export default {
    props: [
       'slug',
    ],
    data() {
        return {
            propertyArray: null,
        }
    },
    created() {
        axios.get('/api/properties/' + this.slug)
        .then(response => {
                this.propertyArray = response.data.results
                console.log(this.propertyArray);
            });
    }
}
</script>

<style lang="scss" scoped>
    .tag {

        display: inline-block;
        margin: .3em;
        padding: .4em .6em;
        border-radius: 10em;
        background-color: red;
    }
</style>
