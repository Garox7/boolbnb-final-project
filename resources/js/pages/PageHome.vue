<template>
    <div>
        <div v-for="property in arrProperties" :key="property.id" class="property-container">
            <div v-for="image in property.property_images">
                <img :src="'/storage/' + image.image" class="property-image">
            </div>
            <p>{{ property.name }}</p>
        </div>
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
        axios.get('api/properties')
            .then(response => this.arrProperties = response.data.results);
    }
}
</script>

<style lang="scss" scoped>

.property-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.property-image {
    width: 100px;
    height: 100px;
}
</style>
