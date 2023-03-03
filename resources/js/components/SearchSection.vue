<template>
    <div>
        <h1>Sto Cercando</h1>
        <ul>
            <li v-for="property in properties" :key="property.id">
                {{ property.name }}
            </li>
        </ul>
        <p>{{ properties.name }}</p>
    </div>
</template>

<script>
export default {
    props: {
        searchAddress: String,
    },
    data() {
        return {
            properties: null,
        }
    },
    watch: {
        searchAddress(newVal, oldVal) {
            if (newVal.length > 4) {
                this.searchProperties();
            }
        }
    },
    methods: {
        searchProperties() {
            axios.post('/api/properties/search', {
                address: this.searchAddress
            })
                .then(response => {
                    this.properties = response.data.results;
                    console.log(this.properties);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        }
    }
}
</script>

<style>

</style>
