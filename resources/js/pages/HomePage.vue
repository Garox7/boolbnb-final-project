<template>
    <div class="property-container">
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
</template>

<script>
import PropertyCardComponent from '../components/PropertyCardComponent';

export default {
    components: {
        PropertyCardComponent,
    },
    data() {
        return {
            arrProperties: null,
        }
    },
    created() {
        axios.get('api/guest/properties')
            .then(response => {
                this.arrProperties = response.data.results
                console.log('proprietà', this.arrProperties);
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
