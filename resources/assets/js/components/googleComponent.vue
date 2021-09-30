<template>
    <div>
        <!-- <div class="sniper-load" v-if="!ready">
            <div class="loader"></div>
        </div> -->
    </div>
</template>

<script>
import { bus } from '../app_mobile';

export default {
    props: ['products', 'list'],
    data(){
        return {
            ready: true,
            fbqHomewear: '583132129069944',
            fbqBijoux: '273958797023426',
        }
    },
    mounted(){
        // if (this.$device == 'sm') {
        //     this.ready = false;
        //     let vm = this;
        //     setTimeout(function(){
        //         vm.ready = true;
        //         $('main').css({'visibility' : 'visible'})
        //         $('footer').css({'visibility' : 'visible'})
        //     }, 1300);
        // }
        //
        // if (this.products.length > 0) {
        //     this.createImpressions()
        // }
        // if (this.products == 'purchase') {
        //     this.purchase()
        // }
        //
        // bus.$on('ga-event-clickImpresions', data => {
        //     this.clickImpresions(data.product, data.list);
        // });
        //
        // bus.$on('ga-event-viewProduct', data => {
        //     this.viewProduct(data.product, data.actionField);
        // });
        //
        // bus.$on('ga-event-addToCart', data => {
        //     this.addToCart(data);
        // });
        //
        // bus.$on('ga-event-removeFromCart', data => {
        //     this.removeFromCart(data);
        // });
        //
        // bus.$on('ga-event-addToFavorites', data => {
        //     // this.addTofavorites(data);
        // });
        //
        // bus.$on('ga-event-viewCart', data => {
        //     this.viewCart(data.products, data.subproducts);
        // });
        //
        // bus.$on('ga-event-initiateCheckout', data => {
        //     this.initiateCheckout(data.promo, data.products, data.amount);
        // });
        //
        // bus.$on('ga-event-addShippingInfo', data => {
        //     this.addShippingInfo(data.country, data.products, data.subproducts);
        // });
        //
        // bus.$on('ga-event-addPAymentInfo', data => {
        //     this.addPAymentInfo(data.payment,  data.products, data.subproducts);
        // });
    },
    methods: {
        // View Content Event
        viewProduct(product, actionField){
            let aditionall = JSON.parse(product.translation.aditionall);
            window.dataLayer.push({
                event: 'eec.prod_view',
                ecommerce: {
                    detail: {
                        actionField: {
                            list: actionField
                        },
                        products: [{
                            id          : product.code,
                            name        : product.translation.name,
                            category    : aditionall ? aditionall.category : '',
                            dimension1  : aditionall ? aditionall.color : '',
                            dimension2  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                            price       : product.main_price.price,
                            brand:       'Anne Popova',
                        }]
                    }
                }
            });
            window.fbq('track', 'ViewContent', {
                content_ids: [product.code],
                content_type: 'product',
                value: product.main_price.price,
                currency: 'EUR'
            });
        },
        // Add To Cart Event
        addToCart(data){
            let product = data.product;
            let actionField = data.actionField;
            let aditionall = JSON.parse(product.translation.aditionall);

            window.dataLayer.push({
                'event': 'eec.add_to_cart',
                'ecommerce': {
                    'currencyCode': this.$mainCurrency,
                    'add': {
                        'actionField': {
                            'list': actionField,
                        },
                        'products': [{
                            'id':           product.code,
                            'name':         product.translation.name,
                            'category':     aditionall ? aditionall.category : '',
                            'dimension1':   aditionall ? aditionall.color : '',
                            'dimension2':   aditionall ? aditionall.collection+'&'+aditionall.set : '',
                            'price':        product.main_price.price,
                            'brand': '      Anne Popova',
                            'quantity':     1
                        }]
                    }
                }
            });
            window.fbq('track', 'AddToCart', {
                content_ids: [product.code],
                content_type: 'product',
                value: product.main_price.price,
                currency: 'EUR',
            });
        },
        // Add To Cart Event
        removeFromCart(product){
            if (product.subproduct) {
                product = product.subproduct.product
            }else{
                product = product.product
            }
            window.dataLayer.push({
                'event': 'eec.remove_from_cart',
                'ecommerce': {
                    'currencyCode': this.$mainCurrency,
                    'add': {
                        'actionField': {
                            'list': 'Product-one',
                        },
                        'products': [{
                            'id':       product.code,
                            'name':     product.translation.name,
                            'price':    product.main_price.price,
                            'brand':    'Anne Popova',
                            'quantity': 1
                        }]
                    }
                }
            });
        },
        // Add to Favorites Event
        addTofavorites(product){
            window.dataLayer.push({
                 'event': 'eec.add_to_wish',
                 'ecommerce': {
                     'add': {
                         'actionField': {
                             'list': 'Product-one'
                         },
                         'products': [{
                             'id': product.code,
                             'name': product.translation.name,
                             'price': product.main_price.price,
                             'brand': 'Anne Popova',
                             'category':  product.category.translation.name,
                             'quantity': 1
                         }]
                     }
                 }
             });
             window.fbq('track', 'AddToWishlist', {
                content_ids: [product.code],
                content_type: 'product',
                value: product.main_price.price,
                currency: 'EUR',
            });
        },
        // View Cart Event
        viewCart(products, subproducts){
            console.log('vmdf');
            let entities = [];
            for (var i = 0; i < products.length; i++) {
                let aditionall = JSON.parse(products[i].product.translation.aditionall);
                entities.push({
                    'id': products[i].product.code,
                    'name': products[i].product.translation.name,
                    'category'    : aditionall ? aditionall.category : '',
                    'dimension1'  : aditionall ? aditionall.color : '',
                    'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                    'brand': 'Anne Popova',
                    'quantity': products[i].qty,
                    'price': products[i].product.main_price.price,
               });
            }

            for (var i = 0; i < subproducts.length; i++) {
                let aditionall = JSON.parse(subproducts[i].subproduct.product.translation.aditionall);
                entities.push({
                  'id': subproducts[i].subproduct.product.code,
                  'name': subproducts[i].subproduct.product.translation.name,
                  'category'    : aditionall ? aditionall.category : '',
                  'dimension1'  : aditionall ? aditionall.color : '',
                  'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                  'brand': 'Anne Popova',
                  'quantity': subproducts[i].qty,
                  'price': subproducts[i].subproduct.product.main_price.price,
               });
            }

            window.dataLayer.push({
                'event': 'eec.checkout',
                'ecommerce': {
                    'checkout': {
                        'actionField': {'step': 1},
                        'products': entities,
                    }
                },
            });
        },
        // Initiate Checkout Event
        initiateCheckout(promoAdded, products, amount){
            let contents = [];
            let contentsHomewear = [];
            let contentsBijoux = [];
            let amountHomewear = 0;
            let amountBijoux = 0;
            let subproducts = products.subprods;

            products.prods.forEach(function(entry){
                if (entry.product.homewear == 1) {
                    contentsHomewear.push({id: entry.product.code, quantity: entry.qty});
                    amountHomewear += entry.product.personal_price.price;
                }else{
                    contentsBijoux.push({id: entry.product.code, quantity: entry.qty});
                    amountBijoux += entry.product.personal_price.price;
                }
            });

            products.subprods.forEach(function(entry){
                if (entry.subproduct.product.homewear == 1) {
                    contentsHomewear.push({id: entry.subproduct.product.code, quantity: entry.qty});
                    amountHomewear += entry.product.personal_price.price;
                }else{
                    contentsBijoux.push({id: entry.subproduct.product.code, quantity: entry.qty});
                    amountBijoux += entry.product.personal_price.price;
                }
            });

            let entities = [];
            for (var i = 0; i < products.length; i++) {
                let aditionall = JSON.parse(products[i].product.translation.aditionall);
                entities.push({
                    'id'          : products[i].product.code,
                    'name'        : products[i].product.translation.name,
                    'category'    : aditionall ? aditionall.category : '',
                    'dimension1'  : aditionall ? aditionall.color : '',
                    'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                    'brand'       : 'Anne Popova',
                    'quantity'    : products[i].qty,
                    'price'       : products[i].product.main_price.price,
               });
            }

            for (var i = 0; i < subproducts.length; i++) {
                let aditionall = JSON.parse(subproducts[i].subproduct.product.translation.aditionall);
                entities.push({
                  'id'          : subproducts[i].subproduct.product.code,
                  'name'        : subproducts[i].subproduct.product.translation.name,
                  'category'    : aditionall ? aditionall.category : '',
                  'dimension1'  : aditionall ? aditionall.color : '',
                  'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                  'brand'       : 'Anne Popova',
                  'quantity'    : subproducts[i].qty,
                  'price'       : subproducts[i].subproduct.product.main_price.price,
               });
            }

            window.dataLayer.push({
                'event': 'eec.checkout',
                'ecommerce': {
                    'checkout': {
                        'actionField': {'step': 2, 'option': promoAdded},
                        'products'      : entities,

                    }
                },
            });

            if (contentsHomewear.length > 0) {
                window.fbq('trackSingle', '583132129069944', 'InitiateCheckout', {
                    contents: contentsHomewear,
                    content_type: 'product',
                    value: amountHomewear,
                    currency: $currency,
                });
            }

            if (contentsBijoux.length > 0) {
                window.fbq('trackSingle', '273958797023426', 'InitiateCheckout', {
                    contents: contentsBijoux,
                    content_type: 'product',
                    value: amountBijoux,
                    currency: $currency,
                });
            }
        },
        // Add Shipping Info
        onCheckout(product) {
            let products = [];
            for (var i = 0; i < product.length; i++) {
                products.push({
                  'id': product[i].code,
                  'name': product[i].translation.name,
                  'brand': 'Anne Popova',
                  'quantity': product[i].qty,
                  'category': product[i].category.translation.ame,
                  'price': product[i].main_price.price,
               });
            }
            window.dataLayer.push({
                'event': 'eec.checkout',
                'ecommerce': {
                    'checkout': {
                        'actionField': {'step': 1},
                        'products': products,
                    }
                },
            });
        },
        // Add Shipping Info
        addShippingInfo(country, products, subproducts){
            let entities = [];
            for (var i = 0; i < products.length; i++) {
                let aditionall = JSON.parse(products[i].product.translation.aditionall);
                entities.push({
                    'id'          : products[i].product.code,
                    'name'        : products[i].product.translation.name,
                    'category'    : aditionall ? aditionall.category : '',
                    'dimension1'  : aditionall ? aditionall.color : '',
                    'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                    'brand'       : 'Anne Popova',
                    'quantity'    : products[i].qty,
                    'price'       : products[i].product.main_price.price,
               });
            }

            for (var i = 0; i < subproducts.length; i++) {
                let aditionall = JSON.parse(subproducts[i].subproduct.product.translation.aditionall);
                entities.push({
                  'id'          : subproducts[i].subproduct.product.code,
                  'name'        : subproducts[i].subproduct.product.translation.name,
                  'category'    : aditionall ? aditionall.category : '',
                  'dimension1'  : aditionall ? aditionall.color : '',
                  'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                  'brand'       : 'Anne Popova',
                  'quantity'    : subproducts[i].qty,
                  'price'       : subproducts[i].subproduct.product.main_price.price,
               });
            }

            window.dataLayer.push({
                'event': 'eec.checkout',
                'ecommerce': {
                    'checkout': {
                        'actionField'   : {'step': 3, 'option': country.translation.name},
                        'products'      : entities,
                    }
                },
            });
        },
        // Add Payment Info
        addPAymentInfo(payment, products, subproducts){
            let entities = [];
            let contentsHomewear = [];
            let contentsBijoux = [];
            let amountHomewear = 0;
            let amountBijoux = 0;

            for (var i = 0; i < products.length; i++) {
                let aditionall = JSON.parse(products[i].product.translation.aditionall);
                entities.push({
                    'id'          : products[i].product.code,
                    'name'        : products[i].product.translation.name,
                    'category'    : aditionall ? aditionall.category : '',
                    'dimension1'  : aditionall ? aditionall.color : '',
                    'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                    'brand'       : 'Anne Popova',
                    'quantity'    : products[i].qty,
                    'price'       : products[i].product.main_price.price,
               });

               if (products[i].product.homewear == 1) {
                   contentsHomewear.push({id: products[i].product.code, quantity: products[i].qty});
                   amountHomewear += products[i].product.personal_price.price;
               }else{
                   contentsBijoux.push({id: products[i].product.code, quantity: products[i].qty});
                   amountBijoux += products[i].product.personal_price.price;
               }
            }

            for (var i = 0; i < subproducts.length; i++) {
                let aditionall = JSON.parse(subproducts[i].subproduct.product.translation.aditionall);
                entities.push({
                  'id'          : subproducts[i].subproduct.product.code,
                  'name'        : subproducts[i].subproduct.product.translation.name,
                  'category'    : aditionall ? aditionall.category : '',
                  'dimension1'  : aditionall ? aditionall.color : '',
                  'dimension2'  : aditionall ? aditionall.collection+'&'+aditionall.set : '',
                  'brand'       : 'Anne Popova',
                  'quantity'    : subproducts[i].qty,
                  'price'       : subproducts[i].subproduct.product.main_price.price,
               });

               if (subproducts[i].subproduct.product.homewear == 1) {
                   contentsHomewear.push({id: subproducts[i].subproduct.product.code, quantity: subproducts[i].qty});
                   amountHomewear += subproducts[i].subproduct.product.personal_price.price;
               }else{
                   contentsBijoux.push({id: subproducts[i].subproduct.product.code, quantity: subproducts[i].qty});
                   amountBijoux += subproducts[i].subproduct.product.personal_price.price;
               }
            }

            window.fbq('trackSingle', this.fbqHomewear, 'AddPaymentInfo', {
                contents: contentsHomewear,
                content_type: 'product',
                value: amountHomewear,
                currency: $currency,
            });

            window.fbq('trackSingle', this.fbqBijoux, 'AddPaymentInfo', {
                contents: contentsBijoux,
                content_type: 'product',
                value: amountBijoux,
                currency: $currency,
            });

            // window.dataLayer.push({
            //     'event': 'eec.checkout',
            //     'ecommerce': {
            //         'checkout': {
            //             'actionField': {'step': 4, 'option': payment},
            //             'products'   : entities,
            //         }
            //     },
            // });
        },
        // Purchase Event
        purchase(){

        },
        createImpressions(){
            let impressions = [];
            let vm = this;
            this.products.forEach(function(entry){
                impressions.push({id: entry.code, name: entry.translation.name, price: entry.main_price.price, list: vm.list});
            });
            window.dataLayer.push({
                ecommerce: {
                    event: 'ec.impressions',
                    impressions: impressions,
                }
            });
        },
        clickImpresions(product, list){
            window.dataLayer.push({
                event: 'eec.prod_view',
                ecommerce: {
                    detail: {
                        actionField: {
                            list: list
                        },
                        products: [{
                            id: product.code,
                            name: product.translation.name,
                            price: product.main_price.price,
                            brand: 'Anne Popova',
                        }]
                    }
                }
            });
        },
    },
}
</script>

<style>
.sniper-load{
    position: fixed;
    width: 100%;
    height: 100vh;
    top: 94px;
    left: 0;
    background-color: #FFF;
    z-index: 9;
}
.sniper-load .loader{
    position: absolute;
    top: calc(50% - 94px);
    left: 50%;
    margin-left: -5em;
    margin-top: -5em;
}

.loader,
.loader:after {
  border-radius: 50%;
  width: 10em;
  height: 10em;
}
.loader {
  margin: 60px auto;
  font-size: 6px;
  position: relative;
  text-indent: -9999em;
  border-top: 1.1em solid rgba(237,220,213, 0.2);
  border-right: 1.1em solid rgba(237,220,213, 0.2);
  border-bottom: 1.1em solid rgba(237,220,213, 0.2);
  border-left: 1.1em solid #eddcd5;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load8 .9s infinite linear;
  animation: load8 .9s infinite linear;
}
@-webkit-keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
