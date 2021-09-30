<template>
    <section class="collection">
        <h4>{{ category.translation.name }}</h4>
        <div class="sliderCollectionHome">

            <hooper :style="'height:' + imageHeight + 'px'" :itemsToShow="1.09" :infiniteScroll="true">
                <slide>
                    <a :href="'/' + $lang + '/' + site + '/catalog/' + category.alias" class="item">
                        <img :src="'/images/categories/og/' + category.banner_mobile" alt="" v-if="category.banner_mobile" />
                        <img src="/images/no-image-ap.jpg" alt="" v-else />
                        <div class="innerContent">
                            <div class="butt">
                                {{ trans.vars.General.shopCategory }}
                            </div>
                        </div>
                    </a>
                </slide>

                <slide v-for="product in category.products">
                    <a :href="'/' + $lang + '/' + site + '/catalog/' + category.alias + '/' + product.alias" class="item" :data-productid="product.code" @click="viewProductGA(product)">
                        <img v-if="product.main_image" :src="'/images/products/sm/' + product.main_image.src" alt="product" />
                        <img v-else src="/images/no-image-ap.jpg" alt="product" />
                    </a>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>

        </div>
    </section>
</template>

<script>
    import { Hooper, Slide, Navigation as HooperNavigation } from "hooper";
    import { bus } from '../../../app_mobile';

    export default {
        components: { Hooper, Slide, HooperNavigation },
        props: ["category", "site"],
        data() {
            return {
                imageHeight: 0,
            };
        },
        mounted() {
            this.imageHeight = window.innerWidth / 0.75 - 10;
        },
        methods: {
            viewProductGA(product) {
                bus.$emit("ga-event-viewProduct", { product: product, actionField: "HP " + this.category.translation.nam });
            },
            setImage(banner) {
                return "/images/categories/og/" + banner;
            },
        },
    };
</script>

<style media="screen">
    .collection .item{
        width: auto !important;
    }
</style>
