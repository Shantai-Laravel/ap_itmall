<template>
    <div class="search-wrapp">
        <h5>Search</h5>
        <div class="search-block">
            <input type="text" name="search" v-model="search" @keyup="findProduct" autocomplete="nope">
        </div>

        <ul>
            <li v-for="product in products">
                <a :href=" '/' + $lang + '/' + product.type + '/catalog/' + product.category.alias + '/' + product.alias ">
                    <img :src="'/images/products/sm/' + product.main_image.src" alt="">
                    <span>{{ product.translation.name }}</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import { bus } from "../../app_desktop";

    export default {
        data() {
            return {
                lodaing: false,
                search: "",
                products: []
            };
        },
        mounted() {
        },
        methods: {
            findProduct(){
                if (this.search.length == 0) {
                    this.products = []
                }
                if (this.search.length > 2) {
                    this.loading = true;
                    axios.post('/'+ this.$lang + '/homewear/search', {
                            search: this.search
                        })
                        .then(response => {
                            this.products = response.data
                            this.loading = false;
                        })
                        .catch(e => {
                          this.loading = false;
                          console.log('loading search error.');
                        })
                }
            }
        }
    };
</script>


<style>
    .search-wrapp{
        /* min-height: 200px; */
    }
    .search-wrapp li{
        padding: 15px 0;
    }
    .search-wrapp li a{
        display: block;
    }
    .search-wrapp li a img{
        width: 60px !important;
        display: inline-block !important;
    }

    .search-wrapp ul {
      margin-top: 20px;
    }
</style>
