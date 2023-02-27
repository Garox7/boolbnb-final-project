<template>
     <div>
        <h1>Aggiorna i dati della proprietà</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="name" v-model="property.name">
            </div>
            <div>
                <label for="slug">Slug:</label>
                <input type="text" name="slug" v-model="property.slug">
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
                <input type="file" name="image[]" @change="onFileChange" multiple>
                <div>
                    <div v-for="(preview, index) in property.imagePreviews" :key="index">
                        <img :src="'/storage/' + preview.image" class="img-preview">
                        <button @click="removeImage(index)">Remove</button>
                    </div>

                    <div v-if="property.imagesArray.length < 10 && property.imagesArray.length">
                        <button @click="addNewImageInput">Add new image</button>
                    </div>
                </div>
            </div>
            <button type="submit">Update Property</button>
        </form>
    </div>
</template>

<script>
// TODO: creare un componente separato che gestisca le immagini

export default {
    props: [
        'slug',
    ],
    data() {
        return {
            objProperty: null,
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
    mounted() {
        axios.get('/api/properties/update/' + this.slug , {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${localStorage.getItem('access_token')}`,
            }
        }).then(response => {
            if (response.data.success) {
            const property = response.data.results;
            console.log(property);
            this.property = {
                name: property.name,
                slug: property.slug,
                description: property.description,
                address: property.address,
                bedroom_count: property.bedroom_count,
                bathroom_count: property.bathroom_count,
                bed_count: property.bed_count,
                imagesArray: property.property_images,
                imagePreviews: property.property_images,
            };
            console.log(this.property.imagePreviews)
            } else {
                this.is404 = true;
            }
        });
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

            axios.put('/api/properties/' + this.slug, formData, {
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

<style>
img {
    width: 100px;
    height: 100px;
}

</style>
