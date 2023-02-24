<template>
    <div v-if="objProp">
        <h1>{{ objProp.name }}</h1>
        <img :src="'/storage/' + objPost.uploaded_img" :alt="objPost.title">
        <h2>{{ objProp.address }}</h2>
        <p>
            {{ objProp.description }}
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
            objProp: null,
        }
    },
    created() {
        axios.get('/api/posts/' + this.slug)
            .then(response => this.objProp = response.data.results);
    }
}
</script>

<style lang="scss" scoped>
    .tag {
        display: inline-block;
        margin: .3em;
        padding: .4em .6em;
        border-radius: 10em;
        background-color: salmon;
    }
</style>
