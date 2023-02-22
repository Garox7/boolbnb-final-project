<template>
    <div>
        <HeaderComponent />

        <div class="main">
            <router-view />
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
    }
}
</script>

<style lang="scss">
// TODO: creare un file di reset
@import './scss/reset';

.main {
    padding: 1rem;
}

</style>
