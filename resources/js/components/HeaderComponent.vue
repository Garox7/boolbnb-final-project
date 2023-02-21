<template>
    <!-- barra di ricerca in modalità mobile, nascosta su desktop max: 744px -->
    <header class="header-mobile" >
            <div class="mobile-search">
                <span class="search-icon">
                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;">
                        <path d="M13 0c7.18 0 13 5.82 13 13 0 2.868-.929 5.519-2.502 7.669l7.916 7.917-2.828 2.828-7.917-7.916A12.942 12.942 0 0 1 13 26C5.82 26 0 20.18 0 13S5.82 0 13 0zm0 4a9 9 0 1 0 0 18 9 9 0 0 0 0-18z" opacity=".8"></path>
                    </svg>
                </span>
                <span class="search-input">
                    <input type="search" name="search" id="search" placeholder="Dove vuoi andare?">
                </span>

                <span class="search-filter">
                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: rgb(34, 34, 34);"><path d="M5 8c1.306 0 2.418.835 2.83 2H14v2H7.829A3.001 3.001 0 1 1 5 8zm0 2a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6-8a3 3 0 1 1-2.829 4H2V4h6.17A3.001 3.001 0 0 1 11 2zm0 2a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path></svg>
                </span>
            </div>
        </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
};
</script>

<style lang="scss" scoped>
header.header-mobile{
    height: 70px;
    padding: 14px 24px 0;
}

.mobile-search {
    width: 100%;
    height: 100%;
    border-radius: 35px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 10%);
    display: flex;
    align-items: center;

    .search-icon {
        width: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-input {
        flex: 1 1 auto;

        input {
            border: none;
            outline: none;

            &::placeholder {
                color: var(--text-color);
                font-weight: 600;
            }
        }
    }

    .search-filter {
        width: 55px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>
