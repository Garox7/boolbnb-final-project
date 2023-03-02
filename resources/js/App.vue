<template>
    <div>
        <HeaderComponent
            @searchProperty="getProperty"
        />

        <div class="main">
            <router-view
                :serchString="serchString"
                :searchMode="searchMode"
            />
        </div>

        <!-- footer -->
    </div>
</template>

<script>
import HeaderComponent from './components/HeaderComponent.vue';

export default {
    name: 'App',
    components: {
        HeaderComponent,
    },
    data() {
        return {
            serchString: '',
            searchMode: false,
        }
    },
    methods: {
        getProperty(data) {
            this.serchString = data;
            if (this.serchString != '') {
                this.searchMode = true;
            } else {
                this.searchMode = false;
            }
        }
    }
}
</script>

<style lang="scss">
// TODO: creare un file di reset
@import './scss/reset';

.main {
    padding: 1.5rem;
}

</style>
