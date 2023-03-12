<template>
    <div>
        <div v-if="loading">Caricamento...</div>

        <div v-else class="search-container">

            <div class="properties">

                <h2>Proprietà a {{ city }}</h2>

                <ul>
                    <li v-for="property in properties" :key="property.id">
                        {{ property.name }}
                    </li>
                </ul>

            </div>

            <div id="map" class="map" ref="map"></div>
        </div>

    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";

export default {
    props: {
        searchAddress: String,
        searchMode: Boolean,
    },
    data() {
        return {
            apiKey: 'pHHustjVtZP4zcljXIwtAYeEAtmslE3K',
            loading: false,
            map: null,
            city: '',
            latitude: 0,
            longitude: 0,
            properties: [],
        }
    },
    watch: {
        searchAddress(newVal, oldVal) {
            if (newVal.length > 2 && this.searchMode) {
                this.searchProperties();
                this.getPointOfMap(newVal);
                this.getMap(this.latitude, this.longitude)
                console.log(newVal, this.searchMode)
            }
        }
    },
    methods: {
        searchProperties() {
            axios.post('/api/properties/search', {
                city: this.searchAddress
            })
                .then(response => {
                    this.properties = response.data.results;
                    console.log('risultati della ricerca', this.properties); // DEBUG
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getPointOfMap(query) {
            const url = `https://api.tomtom.com/search/2/geocode/${query}.json?key=${this.apiKey}&countrySet=IT&limit=1&language=it-IT`;
            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    console.log('cerco la città', data.results[0]); // DEBUG

                    this.city = data.results[0].address.freeformAddress;
                    this.latitude = data.results[0].position.lat;
                    this.longitude = data.results[0].position.lon;
                })
        },
        getMap(latitude, longitude) {
            this.map = tt.map({
                key: this.apiKey,
                container: 'map',
                center: [latitude, longitude],
                zoom: 14
            });

            this.map.addControl(new tt.FullscreenControl({
                container: document.querySelector('.map-container')
            }));
        }
    },
    // mounted() {
    //     this.getMap();
    // }
}
</script>

<style lang="scss" scoped>
.search-container {
    width: 100%;
    height: calc(100vh - 88px);
    display: flex;

    .properties {
        flex: 1 1 55%;
        padding: 1.5rem;
        overflow: auto;
    }

    .map {
        flex: 1 1 45%;
        height: calc(100% - 43px);
    }
}
</style>
