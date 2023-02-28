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
                <label for="image">Foto Proprietà</label>
                <div>
                    <div v-for="(preview, index) in property.imageOldArray" :key="index" class="image-container">
                        <img :src="'/storage/' + preview.image" class="img-preview">
                        <button type="button" @click="removeOldImage(index)">Rimuovi</button>
                    </div>

                    <div v-if="property.imagePreviews > 0">
                        <div v-for="(preview, index) in property.imagePreviews" :key="index">
                            <img :src="preview" class="img-preview">
                            <button type="button" @click="removeImage(index)">Rimuovi</button>
                        </div>
                    </div>

                    <div v-if="property.imageOldArray.length < 10">
                        <button type="button" @click="addNewImageInput">Aggiungi immagine</button>
                    </div>
                </div>
            </div>

            <button type="submit">Update Property</button>
        </form>
    </div>
</template>

<script>
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
                imageOldArray: [],
                imagesArray: [],
                imagePreviews: []
            },
        }
    },
    created() {
        axios.get('/api/properties/edit/' + this.slug, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${localStorage.getItem('access_token')}`,
            }
        }).then(response => {

            // console.log(response);

            if (response.data.success) {
            const property = response.data.results;
            this.property = {
                name: property.name,
                slug: property.slug,
                description: property.description,
                address: property.address,
                bedroom_count: property.bedroom_count,
                bathroom_count: property.bathroom_count,
                bed_count: property.bed_count,
                imageOldArray: property.property_images,
            };
            } else {
                this.is404 = true;
            }
        });
    },
    methods: {
        submitForm() {
            console.log('mi hai inviato');
            const formData = new FormData();
            formData.append('name', this.property.name);
            formData.append('slug', this.property.slug);
            formData.append('description', this.property.description);
            formData.append('address', this.property.address);
            formData.append('bedroom_count', this.property.bedroom_count);
            formData.append('bed_count', this.property.bed_count);
            formData.append('bathroom_count', this.property.bathroom_count);
            if (this.property,imagesArray.length) {
                for (let i = 0; i < this.property.imagesArray.length; i++) {
                    formData.append('image[]', this.property.imagesArray[i]);
                }
            }

            axios.post('/api/properties/' + this.slug, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`,
                }
            }).then(response => {
                this.$router.push('/properties/' + response.data.slug);
            }).catch(error => {
                console.error(error.response.data.errors);
            });
        },
        onFileChange(event) {
            const files = event.target.files;
            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.readAsDataURL(files[i]);
                    reader.onload = function() {
                        this.property.imagesArray.push(files[i]);
                        this.property.imagePreviews.push(reader.result);
                        // this.createImgPreview(reader.result);
                    }
                }
            }
        },
        removeOldImage(index) {
            this.property.imageOldArray.splice(index, 1);
            // funzione di rimozione immagine vecchia dal database con richiesta axios
        },
        removeImage(index) {
            this.property.imagesArray.splice(index, 1);
            this.property.imagePreviews.splice(index, 1);
        },
        addNewImageInput() {
            console.log()
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'image[]';
            input.multiple = true;
            input.addEventListener('change', this.onFileChange);
            input.click();
        }
    }
}
</script>

<style lang="scss" scoped>
img {
    width: 100px;
    height: 100px;
}

button {
    margin-top: 15px;
}
</style>
