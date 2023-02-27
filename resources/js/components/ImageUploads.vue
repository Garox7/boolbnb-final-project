<template>
    <div>
      <div v-if="property.images.length > 0">
        <div v-for="(image, index) in property.images" :key="index" class="mb-4">
          <img :src="'/storage/' + image.image" alt="" class="w-48 h-auto mr-4 inline-block">
          <button @click="deleteImage(image.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Elimina
          </button>
        </div>
      </div>
      <div>
        <div v-for="(preview, index) in imagePreviews" :key="index" class="mb-4">
          <img :src="preview" alt="" class="w-48 h-auto mr-4 inline-block">
          <button @click="removePreview(index)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Rimuovi
          </button>
        </div>
        <div class="mb-4">
          <input type="file" @change="handleFileUpload" multiple>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
        imagePreviews: Array,
    },
    data() {
      return {
        imagesArray: [],
        imagePreviews: []
      };
    },
    methods: {
      handleFileUpload(event) {
        this.imagesArray = [];
        this.imagePreviews = [];
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
          this.imagesArray.push(files[i]);
          const reader = new FileReader();
          reader.onload = e => {
            this.imagePreviews.push(e.target.result);
          };
          reader.readAsDataURL(files[i]);
        }
      },
      removePreview(index) {
        this.imagesArray.splice(index, 1);
        this.imagePreviews.splice(index, 1);
      },
      deleteImage(id) {
        // TODO: Implement delete image functionality
      }
    }
  };
  </script>
