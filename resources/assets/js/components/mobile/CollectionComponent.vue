<template>
    <div class="productInner">
        <div class="h1container">
            <h1>{{ collection.translation.name }}</h1>
        </div>

        <div class="collectionBlock" v-if="main_set !== 'empty'">
            <p class="name collectionName">{{ main_set.translation.name }}</p>

            <hooper :infiniteScroll="true" v-if="imageHeight > 0" :style="'height:' + imageHeight + 'px'" :autoPlay="true" :playSpeed="2000">
                <slide v-if="main_set.photos.length > 0" v-for="image in main_set.photos">
                    <div class="slider-one-product">
                        <img :src="'/images/sets/md/' + image.src" />
                    </div>
                </slide>
                <hooper-pagination slot="hooper-addons"></hooper-pagination>
            </hooper>

            <div :class="['description']">
                <div class="countSet">
                    {{ trans.vars.DetailsProductSet.have }} {{ main_set.products.length }} {{ trans.vars.DetailsProductSet.productsFromSet }}
                </div>
                <div class="innerContainer collectionInner" :id="'collectionInner' + main_set.id">
                    <div class="descriptionInner">
                        <set-mobile :set="main_set" :site="site"></set-mobile>
                    </div>
                </div>
            </div>
        </div>

        <div class="collectionBlock" v-for="set in other_sets">
            <p class="name collectionName">{{ set.translation.name }}</p>

            <hooper :infiniteScroll="true" v-if="imageHeight > 0" :style="'height:' + imageHeight + 'px'" :autoPlay="true" :playSpeed="2000">
                <slide v-if="set.photos.length > 0" v-for="image in set.photos">
                    <div class="slider-one-product">
                        <img :src="'/images/sets/md/' + image.src" />
                    </div>
                </slide>
                <hooper-pagination slot="hooper-addons"></hooper-pagination>
            </hooper>

            <div :class="['description']">
                <div class="countSet">
                    {{ trans.vars.DetailsProductSet.have }} {{ set.products.length }} {{ trans.vars.DetailsProductSet.productsFromSet }}
                </div>
                <div class="innerContainer collectionInner" :id="'collectionInner' + set.id">
                    <div class="descriptionInner">
                        <set-mobile :set="set" :site="site"></set-mobile>
                    </div>
                </div>
            </div>
        </div>

        <div class="similarsBlock">
            <h3>{{ trans.vars.DetailsProductSet.youMightLikeAlso }}</h3>
            <hooper v-if="imageHeight > 0" :style="'height:' + imageHeight + 'px'">
                <slide v-if="similars.length > 0" v-for="similarSet in similars">
                    <div class="slider-one-product">
                        <a :href="'/' + $lang + '/' + site + '/collection/' + collection.alias + '?order=' + similarSet.id ">
                            <img :src="'/images/sets/md/' + similarSet.main_photo.src" />
                        </a>
                    </div>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
        </div>
    </div>
</template>

<script>
    import { VueHammer } from "vue2-hammer";
    import { Hooper, Slide, Pagination as HooperPagination, Navigation as HooperNavigation } from "hooper";
    import "hooper/dist/hooper.css";
    Vue.use(VueHammer);

    export default {
        components: { Hooper, Slide, HooperPagination, HooperNavigation },
        props: ["main_set", "other_sets", "collection", "similars", "site"],
        data() {
            return {
                imageHeight: 0,
            };
        },
        mounted() {
            console.log(this.similars);
            this.imageHeight = window.innerWidth / 0.75 + 30;
        },
        methods: {},
    };
</script>

<style lang="css" scoped>
    .hooper {
        height: auto;
    }
    .oneProductContent .description:after {
        display: none;
    }
    .oneProductContent .description {
        height: auto;
    }
    .innerContainer.collectionInner {
        height: auto;
    }
    .sizeContainerProduct {
        bottom: 0;
    }
</style>
