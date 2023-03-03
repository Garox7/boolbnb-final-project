<template>
    <div>
        <HeaderComponent
            @searchProperty="getSearchString"
        />

        <div class="main">
            <router-view
                :searchAddress="searchAddress"
                :searchMode="searchMode"
            />
        </div>
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
            searchAddress: '',
            searchMode: false,
        }
    },
    methods: {
        getSearchString(inputAddress) {
            this.searchAddress = inputAddress;
            if (this.searchAddress != '') {
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
