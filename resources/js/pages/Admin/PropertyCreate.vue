<template>
    <div class="main">
        <h1>Crea la tua proprietà</h1>
        <form @submit.prevent="submitForm" class="form">
            <div class="form-type">
                <label for="name" class="input-form">Nome:</label>
                <input type="text" name="name" class="input-form" v-model="property.name">
            </div>
            <div class="form-type">
                <label for="slug" class="input-form">Slug:</label>
                <input type="text" name="slug" class="input-form" v-model="property.slug">
            </div>
            <div class="form-type">
                <label for="description" class="input-form">Description:</label>
                <textarea name="description" class="input-form" v-model="property.description"></textarea>
            </div>
            <div class="form-type">
                <label for="address" class="input-form">Address:</label>
                <input type="text" name="address" class="input-form" v-model="property.address">
            </div>
            <div class="form-type">
                <label for="bedroom_count" class="input-form">Rooms:</label>
                <input type="number" name="bedroom_count" class="input-form" v-model="property.bedroom_count">
            </div>
            <div class="form-type">
                <label for="bathroom_count" class="input-form">Bathroom_count:</label>
                <input type="number" name="bathroom_count" class="input-form" v-model="property.bathroom_count">
            </div>
            <div class="form-type">
                <label for="bed_count" class="input-form">Bed_count:</label>
                <input type="number" name="bed_count" class="input-form" v-model="property.bed_count">
            </div>
            <div class="form-type">
                <label for="image" class="input-form">Image:</label>
                <input type="file" name="image[]" class="input-form" @change="onFileChange" multiple>
            </div>
            <div>
                    <div v-for="(preview, index) in property.imagePreviews" :key="index">
                        <img :src="preview" class="img-preview">
                        <button @click="removeImage(index)">Remove</button>
                    </div>

                    <div v-if="property.imagesArray.length < 10">
                        <button @click="addNewImageInput">Add new image</button>
                    </div>
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
                slug: '',
                description: '',
                address: '',
                bedroom_count: 0,
                bathroom_count: 0,
                bed_count: 0,
                imagesArray: [],
                imagePreviews: []
            }
        }
    },
    methods: {
        submitForm() {
            const formData = new FormData();
            formData.append('name', this.property.name);
            formData.append('slug', this.property.slug);
            formData.append('description', this.property.description);
            formData.append('address', this.property.address);
            formData.append('bedroom_count', this.property.bedroom_count);
            formData.append('bathroom_count', this.property.bathroom_count);
            formData.append('bed_count', this.property.bed_count);
            for (let i = 0; i < this.property.imagesArray.length; i++) {
                formData.append('image[]', this.property.imagesArray[i]);
            }

            axios.post('/api/properties', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`,
                }
            }).then(response => {
                this.$router.push('/properties/' + response.data.slug);
            }).catch(error => {
                console.error(error.response);
            });
        },
        onFileChange(event) {
            const files = event.target.files;
            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.readAsDataURL(files[i]);
                    reader.onload = () => {
                        this.property.imagesArray.push(files[i]);
                        this.property.imagePreviews.push(reader.result);
                    }
                }
            }
        },
        removeImage(index) {
            this.property.imagePreviews.splice(index, 1);
            this.property.imagesArray.splice(index, 1);
        },
        addNewImageInput() {
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'image[]';
            input.addEventListener('change', this.onFileChange);
            input.click();
        }
    }
}
</script>

<style lang="scss" scoped>
.main{
    background-color: rgb(174, 207, 250);
}
h1{
    text-align: center;
}
.form{
    max-width: 500px;
    margin: 0 auto;
    padding: 4rem;
}
label{
    padding-right: .5rem;
}
.form-type{
    margin-bottom: .5rem;
    display: flex;
    flex-direction: row;
    gap: 1rem;
}
.input-form{
    flex: 0 0 50%;
}

.img-preview {
    width: 150px;
    height: 150px;
}
button{
    padding: .3rem .5rem;
    background-color: rgb(114, 150, 197);
    border-color:rgb(114, 150, 197);
    color: white;
}
</style>
