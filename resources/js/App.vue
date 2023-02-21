<template>
    <div>
        <HeaderComponent />

        <router-view />

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
/* Scegliere il font */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

:root {
    /********** colors ***********/
    --body-color: #FFF;
    --text-color: #222;
    // boolean ispiration
    --button-color: #3535ec;
    // airbnb original
    // --button-color: #ff395c;
}

body {
    height: 100%;
    background: var(--body-color);
}
</style>
