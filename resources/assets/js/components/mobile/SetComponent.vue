<template>
    <div class="row">
        <div class="col-6" v-for="product in set.products" :data-productid="product.code">
            <a :href="'/' + $lang + '/' + site + '/catalog/' + product.category.alias + '/' + product.alias" @click="viewProductGA(product)">
                <img :src="'/images/products/sm/' + product.set_image.src" v-if="product.set_image" />
                <img src="/images/no-image-ap.jpg" v-else />
            </a>
            <a :href="'/' + $lang + '/' + site + '/catalog/' + product.category.alias + '/' + product.alias" class="nameProduct">
                {{ product.translation.name }}
            </a>
            <a :href="'/' + $lang + '/' + site + '/catalog/' + product.category.alias + '/' + product.alias">{{ trans.vars.DetailsProductSet.viewProduct }}</a>
            <div class="price">
                <span>
                    {{ product.personal_price.price }}
                    <span v-if="product.personal_price.old_price == product.personal_price.price">{{ $currency }}</span>
                </span>
                <span  class="currency" v-if="product.personal_price.old_price !== product.personal_price.price">
                    {{ product.personal_price.old_price }}
                </span>
                <span class="currency" v-if="product.personal_price.old_price !== product.personal_price.price">
                    {{ $currency }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import { bus } from "../../app_mobile";
    import { Hooper, Slide, Pagination as HooperPagination } from "hooper";
    import "hooper/dist/hooper.css";

    export default {
        components: { Hooper, Slide, HooperPagination },
        props: ["set", "site"],
        data() {
            return {
                subproducts: [],
                chooseProducts: false,
                ammount: 0,
                notInStock: false,
                product: [],
                subproduct: [],
                addTocartBtn: false,
                subproductsSizeDrop: [],
            };
        },
        mounted() {},
        methods: {
            openSizesDropDown() {
                let vm = this;
                this.set.products.forEach(function (entry) {
                    if (!vm.subproductsSizeDrop.includes(entry.id)) {
                        bus.$emit("openSizesDropDown" + vm.set.id + entry.id);
                        vm.subproductsSizeDrop.push(entry.id);
                        return true;
                    }
                });
            },
            viewProductGA(product) {
                bus.$emit("ga-event-viewProduct", { product: product, actionField: 'set/Collection'});
            },
            getSetImage(product, setId) {
                return true;
                let ret = false;
                product.set_images.forEach(function (entry) {
                    if (setId == entry.set_id) {
                        ret = entry.image;
                        return ret;
                    }
                });
                return ret;
            },
        },
    };
</script>

<style media="screen">
    .check.selectedRadio {
        background-image: url(/fronts_mobile/img/backgrounds/collSize.jpg) !important;
        color: #fff !important;
    }
    .products {
        margin-top: 50px;
    }
    .products .hooper-pagination.is-vertical {
        top: -19px;
    }
    .descriptionInner .price {
        font-size: 15px !important;
    }
</style>
