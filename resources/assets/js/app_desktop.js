require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$lang = document.documentElement.getAttribute('lang');
Vue.prototype.$currency = document.documentElement.getAttribute('currency');
Vue.prototype.$currencyRate = document.documentElement.getAttribute('currency-rate');
Vue.prototype.$mainCurrency = document.documentElement.getAttribute('main-currency');
Vue.prototype.$device = document.documentElement.getAttribute('device');
Vue.prototype.trans = trans;

export const bus = new Vue();
import VeeValidate from 'vee-validate';
import BootstrapVue from 'bootstrap-vue';
import VueNestable from 'vue-nestable';
import Fragment from 'vue-fragment';

import Slick from 'vue-slick';

Vue.component('google-events', require('./components/desktop/GoogleComponent.vue'));

// home components
Vue.component('home-sliders',           require('./components/desktop/home/HomeSliders.vue'));
Vue.component('home-slider-category',   require('./components/desktop/home/HomeSliderCategory.vue'));
Vue.component('home-slider-collection', require('./components/desktop/home/HomeSliderCollection.vue'));
// product/sets components
Vue.component('category',           require('./components/desktop/CategoryComponent.vue'));
Vue.component('parameters-filter',  require('./components/desktop/ParametersFilterComponent.vue'));
Vue.component('new',                require('./components/desktop/NewComponent.vue'));
Vue.component('sale',               require('./components/desktop/SaleComponent.vue'));
Vue.component('view-recently',      require('./components/desktop/ViewRecently.vue'));
Vue.component('set',                require('./components/desktop/SetComponent.vue'));
// cart components
Vue.component('cart',               require('./components/desktop/cart/CartComponent.vue'));
Vue.component('cart-summary',       require('./components/desktop/cart/CartSummaryComponent.vue'));
Vue.component('cart-counter',       require('./components/desktop/cart/CartCounterComponent.vue'));
Vue.component('add-to-cart-button', require('./components/desktop/cart/AddToCartButtonComponent.vue'));
Vue.component('add-to-cart-set-product',    require('./components/desktop/cart/AddToCartSetProduct.vue'));
Vue.component('add-to-cart-wish-product',   require('./components/desktop/cart/AddToCartWishProduct.vue'));
// wish components
Vue.component('wish-counter',   require('./components/desktop/wishlist/WishCounterComponent.vue'));
Vue.component('wish-block',     require('./components/desktop/wishlist/WishBlockComponent.vue'));
Vue.component('wish-button',    require('./components/desktop/wishlist/WishButtonComponent.vue'));
// auth components
Vue.component('reset-password', require('./components/desktop/auth/ResetPasswordComponent.vue'));
Vue.component('auth',           require('./components/desktop/auth/Auth.vue'));
// order components
Vue.component('order',          require('./components/desktop/OrderShippingComponent.vue'));
Vue.component('order-payment',  require('./components/desktop/OrderPaymentComponent.vue'));
Vue.component('search',  require('./components/desktop/SearchComponent.vue'));


const app = new Vue({
    el: '#cover'
});
