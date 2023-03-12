<template>
    <div>
        <div v-if="loading">Caricamento...</div>

        <div v-else class="search-container">

            <div id="map" class="map" ref="map"> my map</div>

            <div class="properties">

                <!-- <h2>Proprietà a {{ city }}</h2> -->

                <ul>
                    <li v-for="property in properties" :key="property.id">
                        {{ property.name }}
                    </li>
                </ul>

            </div>

        </div>

    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";

export default {
    props: {
        searchAddress: String,
    },
    data() {
        return {
            loading: false,
            apiKey: 'pHHustjVtZP4zcljXIwtAYeEAtmslE3K',
            properties: [],
            map: null,
            city: '',
            markers: [],
        }
    },
    mounted() {

    },
    methods: {
        initializeMap() {
            this.map = tt.map({
                key: this.apiKey,
                container: 'map',
                zoom: 12,
            })
        }
    }











    // watch: {
    //     searchAddress(newVal, oldVal) {
    //         if (newVal.length > 2) {
    //             this.searchProperties();
    //         }
    //     }
    // },
    // methods: {
    //     searchProperties() {

    //         axios.post('/api/properties/search', {
    //             city: this.searchAddress
    //         })
    //             .then(response => {
    //                 this.properties = response.data.results;
    //                 console.log(this.properties);
    //             })
    //             .catch(error => {
    //                 console.log(error);
    //             });
    //     },
    //     getMap() {
    //         this.map = tt.map({
    //             key: this.apiKey,
    //             container: 'map',
    //         });
    //     }
    // },
    // mounted() {
    //     this.getMap();
    // }
}
</script>

<style>

</style>
