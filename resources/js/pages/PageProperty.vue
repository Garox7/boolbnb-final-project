<template>
    <div v-if="property">
        <h1>{{ property.name }}</h1>
        <img :src="'/storage/' + objPost.uploaded_img" :alt="objPost.title">
        <h2>{{ property.address }}</h2>
        <p>
            {{ property.description }}
        </p>

    </div>
</template>

<script>
// TODO: gestire la 404 dei post non esistenti
export default {
    //props: [
    //    'slug',
    //],
    data() {
        return {
            property: null,
        }
    },
    created() {
        axios.get('/api/posts/' + this.slug)
            .then(response => this.property = response.data.results);
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
