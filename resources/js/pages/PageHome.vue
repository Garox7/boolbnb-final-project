<template>
    <div v-if="!searchMode" class="property-container">
        <PropertyCardComponent class="card-container"
            v-for="property in arrProperties"
            :key="property.id"
            :address="property.address"
            :bed="property.bed_count"
            :bathroom="property.bathroom_count"
            :arrImages="property.property_images"
            :slug="property.slug"
        />
    </div>
    <div v-else>
        <SearchSection
            :searchAddress="searchAddress"
        />
    </div>
</template>

<script>
import PropertyCardComponent from '../components/PropertyCardComponent';
import SearchSection from '../components/SearchSection.vue';

export default {
    props: {
        searchMode: Boolean,
        searchAddress: String
    },
    components: {
        PropertyCardComponent,
        SearchSection
    },
    data() {
        return {
            arrProperties: null,
        }
    },
    created() {
        axios.get('api/properties')
            .then(response => {
                this.arrProperties = response.data.results
                console.log(this.arrProperties);
            });
    }
}
</script>

<style lang="scss" scoped>

.property-container {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1.5rem;

    .card-container {
        flex: 1 1 auto;
        position: relative;
    }
}

@media screen and (min-width: 550px) {
    .property-container .card-container {
        flex: 1 1 calc(50% - 1.5rem);
    }
}

@media screen and (min-width: 744px) {
    .property-container .card-container {
        flex: 1 1 calc(100% / 3 - 3rem);
    }
}

@media screen and (min-width: 1128px) {
    .property-container .card-container {
        flex: 1 1 calc(25% - 6rem);
    }
}
</style>
