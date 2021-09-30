@extends('front.desktop.app')
@section('content')
@include('front.desktop.partials.header')
<main class="cartContent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ trans('vars.Orders.checkout') }}</h3>
            </div>
            <div class="col-12">
                <div class="stepContainer">
                    <div class="step">
                        <span>1</span>
                    </div>
                    <div class="arrow"></div>
                    <div class="step opac">
                        <span>2</span>
                    </div>
                    <div class="arrow"></div>
                    <div class="step opac">
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <order
                    :items="{{ $cartProducts }}"
                    :countrydelivery="{{ @$_COOKIE['country_id'] }}"
                    :delivery="{{ @$_COOKIE['delivery_id'] }}"
                    :mode="'{{ Auth::guard('persons')->user() ? "auth" : "guest" }}'"
                    :prods="{{ $carts['products'] }}"
                    :subprods="{{ $carts['subproducts'] }}"
                    site="{{ $site }}"
                ></order>

                <div class="col-12 titleCeck">
                    <p>{{ trans('vars.Orders.orderReview') }}</p>
                </div>

                <cart
                    :items="{{ $cartProducts }}"
                    mode="order-shipping"
                    site="{{ $site }}"
                ></cart>

            </div>

            <cart-summary
                :prods="{{ $carts['products'] }}"
                :subprods="{{ $carts['subproducts'] }}"
                mode="order-shipping"
                site="{{ $site }}"
            ></cart-summary>
            <div class="footerOrder">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="title">
                        {{ trans('vars.Cart.weAccept') }}
                      </div>
                      <ul class="paymentMethodsFooter">
                        <li class="mastercard">
                          <img src="/fronts/img/icons/mastercard-logo.png" alt="">
                        </li>
                        <li class="visa">
                          <img src="/fronts/img/icons/visasecure.png" alt="">
                        </li>
                        
                      </ul>
                      <div class="title">
                        {{ trans('vars.Contacts.needHelp') }}
                      </div>
                      <p>
                        {{ trans('vars.Contacts.contactUsBy') }} <a href="{{ url('/'.$lang->lang. '/' . $site . '/contacts') }}">{{ trans('vars.Contacts.contactsTitle') }}</a>
                        . {{ trans('vars.Contacts.readMore') }} <a href="{{ url('/'.$lang->lang. '/' . $site . '/livrare-achitare-retur') }}">{{ trans('vars.Contacts.here') }}</a>
                      </p>
                      @if (@$_COOKIE['country_id'] == 140)
                          <div class="title">
                            {{ trans('vars.Orders.billingDescriptor') }}
                          </div>
                          <p>
                              {{ trans('vars.Orders.billingDescriptorText1MD') }}
                          </p>
                          <div class="title">
                              {{ trans('vars.Contacts.addressSiteShop2') }}
                          </div>
                          <p>
                              {{ trans('vars.Contacts.brandCompany') }}
                          </p>
                      @else
                          <div class="title">
                            {{ trans('vars.Orders.billingDescriptor') }}
                          </div>
                          <p>
                              {{ trans('vars.Orders.billingDescriptorText1') }}
                          </p>
                          <div class="title">
                              {{ trans('vars.Contacts.contactsCompany') }}
                          </div>
                          <p>
                              {{ trans('vars.Contacts.queriesPaymentShippingReturnsAddressWarehouse') }}
                          </p>
                      @endif
                    </div>
                  </div>
                </div>
        </div>
    </div>
</main>
@include('front.desktop.partials.footer')
@stop
