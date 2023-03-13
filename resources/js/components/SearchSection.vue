<template>
    <div>
        <div v-if="loading">Caricamento...</div>

        <div v-else class="search-container">

            <div class="properties">

                <!-- <h2>Proprietà a {{ city }}</h2> -->

                <ul>
                    <li v-for="property in properties" :key="property.id">
                        {{ property.name }}
                    </li>
                </ul>

            </div>

            <div id="map" class="map" ref="map"> my map</div>

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
            positionDefault: [12.4964, 41.9028], // ROME
            mapInizialized: false,
        }
    },
    mounted() {
        this.initializeMap();
        this.getProperties();
    },
    methods: {
        initializeMap() {
            if (this.mapInizialized) {
                return;
            }

            this.map = tt.map({
                key: this.apiKey,
                container: 'map',
                zoom: 5,
                center: this.positionDefault,
            });

            this.mapInizialized = true;
        },
        getProperties() {
            axios.post('/api/properties/search', {
                city: this.searchAddress
            })
            .then(response => {
                this.properties = response.data.results;
                console.log('risultati della ricerca', this.properties); // DEBUG

                    const bounds = new tt.LngLatBounds();
                    this.properties.forEach((property) => {
                        const marker = new tt.Marker({
                            color: "#006699",
                        })
                            .setLngLat([property.longitude, property.latitude])
                            .addTo(this.map);

                            this.markers.push(marker);
                            bounds.extend(marker.getLngLat());
                    });
                    // this.markers.forEach((marker) => bounds.extend(marker.getLngLat()));
                    this.map.fitBounds(bounds, { padding: 50 });
                });
                // .catch(error => {
                //     console.log(error);
                // });

        },
    },
    watch: {
        searchAddress(newVal, oldVal) {
            if (newVal) {
                this.marker = [];
                this.initializeMap();
                this.getProperties();
            }
        }
    },
};
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
        height: 100%;
    }
}
</style>
