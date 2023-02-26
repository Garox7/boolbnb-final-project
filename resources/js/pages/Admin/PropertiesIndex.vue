<template>
    <div>
        <h1>Pagina di tutte le proprietà dentro la dashboard</h1>
        <ul>
            <li v-for="property in arrProperties" :key="property.id">
                <router-link :to="{name: 'propertyShow', params: {slug: property.slug}}">{{ property.name }}</router-link>
            </li>
        </ul>
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

</style>
