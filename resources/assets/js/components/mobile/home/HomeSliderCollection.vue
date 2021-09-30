<template>
    <section class="collection">
        <h4>{{ colection.translation.name }} {{ trans.vars.General.collection }}</h4>
        <div class="sliderCollectionHome">

            <hooper :style="'height:' + imageHeight + 'px'" :itemsToShow="1.09" :infiniteScroll="true">
                <slide>
                    <a :href="'/' + $lang + '/' + site + '/collection/' + colection.alias" class="item">
                        <img :src="'/images/collections/' + colection.banner_mob" alt="" v-if="colection.banner_mob" />
                        <img src="/images/no-image-ap.jpg" alt="" v-else />
                        <div class="innerContent">
                            <div class="butt">
                                {{ trans.vars.General.shopCollection }}
                            </div>
                        </div>
                    </a>
                </slide>
                <slide  v-for="set in colection.sets">
                    <a :href="'/' + $lang + '/' + site + '/collection/' + colection.alias + '?order=' + set.id" class="item">
                        <img v-if="set.main_photo" :src="'/images/sets/sm/' + set.main_photo.src" alt="" />
                        <img v-else src="/images/no-image-ap.jpg" alt="" />
                    </a>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>

        </div>
    </section>
</template>

<script>
    import { Hooper, Slide, Navigation as HooperNavigation } from "hooper";
    // import "hooper/dist/hooper.css";

    export default {
        components: { Hooper, Slide, HooperNavigation },
        props: ["colection", "site"],
        data() {
            return {
                imageHeight: 0,
            };
        },
        mounted() {
            this.imageHeight = window.innerWidth / 0.75 - 10;
        },
        methods: {
            setImage(banner) {
                return "/images/collections/" + banner;
            },
        },
    };
</script>

<style media="screen">
    .collection .item{
        width: auto !important;
    }

</style>
