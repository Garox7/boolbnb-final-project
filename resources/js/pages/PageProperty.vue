<template>
    <div v-if="propertyArray">
        <h1>{{ propertyArray.name }}</h1>
                <div class="cont-img">
                    <div v-for="images in propertyArray.property_images" :key="images.id" >
                        <img :src="'/storage/' + images.image" :alt="images.id">
                    </div>
                 </div>
        <h2>{{ propertyArray.address }}</h2>
        <p>
            DESCRIZIONE:{{ propertyArray.description }}
        </p>
        <div>
            <p>NUMERO LETTI: {{ propertyArray.bed_count }}</p>
            <p>NUMERO STANZE DA LETTO: {{ propertyArray.bedroom_count }}</p>
            <p>NUMERO BAGNI: {{ propertyArray.bathroom_count }}</p>
            
        </div>
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
    .cont-img{
        display: flex;
        gap: 15px;
    }
    
</style>
