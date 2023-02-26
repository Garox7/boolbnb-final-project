<template>
    <div>
        <h1>Crea la tua proprietà</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="name" v-model="property.name">
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" v-model="property.description"></textarea>
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" name="address" v-model="property.address">
            </div>
            <div>
                <label for="bedroom_count">Rooms:</label>
                <input type="number" name="bedroom_count" v-model="property.bedroom_count">
            </div>
            <div>
                <label for="bathroom_count">Bathroom_count:</label>
                <input type="number" name="bathroom_count" v-model="property.bathroom_count">
            </div>
            <div>
                <label for="bed_count">Bed_count:</label>
                <input type="number" name="bed_count" v-model="property.bed_count">
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" name="image" v-on:change="onFileChange">
            </div>
            <button type="submit">Create Property</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            property: {
                name: '',
                description: '',
                address: '',
                bedroom_count: 0,
                bathroom_count: 0,
                bed_count: 0,
                image: ''
            }
        }
    },
    methods: {
        submitForm() {
            let formData = new FormData();
            formData.append('name', this.property.name);
            formData.append('description', this.property.description);
            formData.append('address', this.property.address);
            formData.append('bedroom_count', this.property.bedroom_count);
            formData.append('bathroom_count', this.property.bathroom_count);
            formData.append('bed_count', this.property.bed_count);
            formData.append('image', this.property.image);

            axios.post('/api/properties', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`,
                }
            }).then(response => {
                this.$router.push('/properties/' + response.data.id);
            }).catch(error => {
                console.error(error.response);
            });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.property.image = file;
        }
    }
}
</script>

<style>

</style>
