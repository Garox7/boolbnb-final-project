<template>
    <div>
        <h1>Proprietà dell'utente</h1>
        <div class="container">
            <div v-for="property in arrProperties" :key="property.id" class="card">
                <div>
                    <img :src="'/storage/'+ property.property_images.image" alt="">
                </div>
                <p><router-link :to="{name: 'propertyShow', params: {slug: property.slug}}">{{ property.name }}</router-link></p>
                <p><router-link :to="{name: 'propertyShow', params: {slug: property.slug}}">camere da letto: {{ property.bedroom_count }} </router-link></p>
                <p><router-link :to="{name: 'propertyShow', params: {slug: property.slug}}">bagni: {{ property.bathroom_count }} </router-link></p>
                <div class="buttons">
                    <button class="modifica">MODIFICA</button>
                    <button class="elimina">ELIMINA</button>
                </div>
            </div>
        </div>
        <button class="crea"><router-link :to="{name: 'propertyCreate'}">CREA NUOVA PROPRIETA'</router-link></button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            arrProperties: null,
        }
    },
    created() {
        axios.get('/api/properties', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('access_token')}`,
            }
        })
            .then(response => {
                this.arrProperties = response.data.results
                console.log('proprietà', this.arrProperties);
            })
            .catch(error => {
            console.error(error)
        })
    },
}
</script>

<style>
    .container{
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
        justify-content: center;
        padding: 3rem;
    }
    .card{
        flex: 0 0 30%;
        background-color: rgb(174, 207, 250);
        padding: 1rem;
        text-align: left;
    }
    button{
        padding: .3rem .5rem;
        color: white;
        margin-top: .5rem;
    }
    .modifica{
        background-color: rgb(161, 226, 156);
        border-color:rgb(161, 226, 156);
    }
    .elimina{
        background-color: rgb(226, 161, 156);
        border-color:rgb(226, 161, 156);
    }
    .crea{
        background-color: rgb(114, 150, 197);
        border-color:rgb(114, 150, 197);
    }
</style>
