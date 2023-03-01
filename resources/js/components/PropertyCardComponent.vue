<template>
    <!-- TODO: INSTALLARE VUE-TOUCH PER IL SUPPORTO PER IOS E ANDROID -->
    <div>
        <router-link :to="{name: 'pageProperty',  params: {slug: slug}}" class="property-link"></router-link>
        <div class="wrap-container">
            <div class="images-container"
                v-for="(images, i) in arrImages"
                :key="images.id"
                :class="i == indexImage ? 'active' : ''"
            >
                <img
                    v-if="i == indexImage"
                    :src="'/storage/' + images.image"
                    :alt="address"
                />

                <div class="slide-left"
                    @click="changeSlide(-1)"
                    :class="indexImage == 0 ? '' : 'active'"
                >&#60;</div>
                <div class="slide-right"
                    @click="changeSlide(1)"
                    :class="indexImage == arrImages.length - 1 ? '' : 'active'"
                >&#62;</div>
            </div>

            <div class="slide-dots">
                <div class="dot"
                    v-for="i in arrImages.length"
                    :key="i"
                    :class="i - 1 == indexImage ? 'active' : ''"
                ></div>
            </div>
        </div>

        <div class="property-details">
            <span>{{ address }}</span>
            <span>{{ services }}</span>
            <span>{{ bed }}</span>
            <span>{{ bathroom }}</span>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        address: String,
        bed: String,
        bathroom: String,
        arrImages: Array,
        slug: String
    },
    data() {
        return {
            indexImage: 0,
        }
    },
    methods: {
        changeSlide(direction) {
            if(direction > 0) {
                this.indexImage++;
                if (this.indexImage === this.arrImages.length) {
                    this.indexImage = 0;
                }
            } else {
                if (this.indexImage == 0) {
                    this.indexImage = this.arrImages.length;
                }
                this.indexImage--;
            }
        }
    }
}
</script>

<style lang="scss" scoped>

.property-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.wrap-container {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 0;

    .images-container {
        display: none;
        width: 100%;
        padding-bottom: 100%;
        position: relative;

        img {
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 10px;
        }

        .slide-left, .slide-right {
            visibility: hidden;
            position: absolute;
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .slide-left {
            display: none;
            top: 50%;
            left: 0;
            margin-left: 8px;
            transform: translateY(-50%);

            &.active {
                display: inline-flex;
            }
        }

        .slide-right {
            display: none;
            top: 50%;
            right: 0;
            margin-right: 8px;
            transform: translateY(-50%);

            &.active {
                display: inline-flex;
            }
        }

        &:hover .slide-left,
        &:hover .slide-right {
            visibility: visible;
        }

        &.active {
            display: block;
        }
    }
}

.slide-dots {
    position: absolute;
    bottom: 15px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 4px;
    z-index: 1;

    .dot {
        background: rgba(255, 255, 255, 0.5);
        width: 5px;
        height: 5px;
        border-radius: 50%;
        transition: all .5s ease;

        &.active {
            background: white;
            transform: scale(1.5);
        }
    }
}
</style>
